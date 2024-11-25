<?php
require './database/db.php';
require './base/header.php';

// Busca todos os produtos do banco de dados
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Reorganiza os produtos em um array associativo com base no ID
$products_by_id = [];
foreach ($products as $product) {
    $products_by_id[$product['id']] = $product; // Use o campo 'id' real do banco
}

// Verifica se o cookie 'cart' está definido
$cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

// Se o carrinho estiver vazio, mostra uma mensagem
if (empty($cart)) {
    echo "Seu carrinho está vazio.";
} else {
    $product_counts = array_count_values($cart);

    // Exibe os produtos do carrinho
    foreach ($product_counts as $product_id => $quantity) {
        if (isset($products_by_id[$product_id])) {
            $product = $products_by_id[$product_id];
            $name = $product['name'];
            $price = $product['price'];
            echo "$name: $quantity (R$" . number_format($price * $quantity, 2, ',', '.') . ")<hr>";
        } else {
            echo "Produto com ID $product_id não encontrado.<hr>";
        }
    }
}
?>
