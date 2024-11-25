<?php
function add_to_cart($product_id) {
    // Inicializa o carrinho como array vazio
    $cart = [];

    // Verifica se o cookie existe e contém uma string válida
    if (isset($_COOKIE['cart']) && is_string($_COOKIE['cart'])) {
        $decoded_cart = json_decode($_COOKIE['cart'], true);
        if (is_array($decoded_cart)) {
            $cart = $decoded_cart;
        }
    }

    $cart[] = intval($product_id); // Garante que seja um valor int

    // Redefine o cookie com o carrinho atualizado
    setcookie('cart', json_encode($cart), time() + (86400 * 30), "/");
}
?>
