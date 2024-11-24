<?php

function add_to_cart($product_id) {
    
    // Decodifica o cookie para um array
    $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
    
    // Verifica se a decodificação foi bem-sucedida
    if (!is_array($cart)) {
        $cart = [];
    }

    // Adiciona o novo produto ao array
    $cart[] = $product_id;

    // Salva o array atualizado de volta no cookie
    setcookie('cart', json_encode($cart), time() + 3600, '/');
}