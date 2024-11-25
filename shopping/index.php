<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Esportivo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-4">
</div>
<?php

session_start();

require './database/db.php';
require 'add_to_cart.php';
require './base/header.php';
// unset($_SESSION['cart']);
if (!isset($_COOKIE['cart'])){
    $_COOKIE['cart'] = [];
}


// Busca produtos no banco de dados
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<h1>Produtos Esportivos</h1>
<div class="row">
    <?php 
    // Obtém o número total de produtos
    $totalProducts = count($products); 
    

    if(array_key_exists("add_to_cart", $_POST)){
        add_to_cart(intval($_POST['product_id']));
 
      //Repetição demonstração produtos
    }
    for ($i = 0; $i < $totalProducts; $i++):
        $product = $products[$i];
    ?>
        <div class="col-md-4" id="<?php echo $i  ?>">
            <div class="card">
            <img src="images/<?php echo $product['image']; ?>" 
     class="card-img-top mx-auto d-block" 
     style="height: 200px; width: 100%; object-fit: contain; background-color: #f8f9fa;" 
     alt="<?php echo $product['name']; ?>">


                <div class="card-body">
                    <h5 class="card-title"><?php echo $product['name']; ?></h5>
                    <p class="card-text">R$ <?php echo number_format($product['price'], 2, ',', '.'); ?></p>
                   <form method='post' action='#<?php echo $i  ?>'>
                  
           
                     <button type="submit" class="btn btn-primary" name="add_to_cart">Adicionar ao Carrinho</button>
                     <input  type='text' value="<?php echo $i?>" name="product_id" style="visibility: hidden; width:0;"></input>
               

                   </form>
                </div>
            </div>
        </div>
    <?php endfor; ?>
</div>


<?php 
require './base/footer.php';
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</body>
</html>