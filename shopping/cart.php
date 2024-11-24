<?php 
session_start();
require './database/db.php';
require './base/header.php';

$stmt = $pdo->query("SELECT * FROM products"); //Consulta BD
$products = $stmt->fetchAll(PDO::FETCH_ASSOC); //Obtém Dados


// Decodifica o valor do cookie 'cart' como um array
$cart = json_decode($_COOKIE['cart'], true);

// Verifica se a decodificação foi bem-sucedida e se $cart é um array
if (is_array($cart)) {
    foreach (array_unique($cart) as $product_id) {
        if (isset($products[$product_id])) {
            $name = $products[$product_id]['name'];
            $price = $products[$product_id]['price'];
            $product_count = array_count_values($cart)[$product_id];
            echo $name . ": " . $product_count . " (R$" . number_format($price * $product_count, 2) . ")" . "<hr>";
        }
    }
} else {
    echo "O carrinho está vazio ou há um problema com os dados do cookie.";
}

require './base/footer.php';
?>