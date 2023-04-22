<?php
include('includes/connect.php'); 

if(!isset($_SESSION)){
    session_start();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="product_page.css">
    <link rel="stylesheet" href="main.css">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <title>Lapzy for you!</title>
    <style>
        .header-nav-border{
            position: relative;
        }
        .display-product{
            background: aliceblue;
        }
        .cart-add{
            background-color: darkblue;
            border: none;
            color: white;
            padding: 10px 12px;
            font-size: 1.15em;
            border-radius: 8px;
            margin-top: 1em;
        }
        .cart-add:hover{
            cursor: pointer;
        }
        .cart-add a{
            color: white;
        }
        .description button::after{
            content: "";
            display: block;
            height: 2px;
            background-color: white;
            transform: scaleX(0);
            transition: transform 300ms ease;
        }
        .description button:hover::after{
            transform: scaleX(1);
        }
    </style>
</head>
<body>
    <header class="header-nav-border">
        <div class="header-content">
            <div class="logo">
                <a href="index.php"><img src="images/logo.png" alt=""></a>
            </div>
            <ul>
                <li><button><a href="index.php">Home</a></button></li>
                <li><button><a href="index.php#products-section">Products</a></button></li>
                
                <?php 

                if(isset($_SESSION['user-id'])){
                    if($_SESSION['user-id']!=1){
                        echo "<li><button><a href='cart.php'>Cart</a></button></li>
                        <li><button><a href='orders.php'>Orders</a></button></li>";
                    }
                }
                ?>
        </div>
    </header>
    <div class="display-product">
        <div class="product-info">
            <?php 
            if(isset($_GET['laptop'])){
                $product="select * from products where id={$_GET['laptop']}";
            }
            else if(isset($_GET['accessory'])){
                $product="select * from products where id={$_GET['accessory']}";
                echo "<style>
                .display-product{
                    background:honeydew;
                }
                .cart-add{
                    background-color:darkgreen;
                }
                </style>";
            }
            $result=mysqli_query($conn,$product);
            $item=mysqli_fetch_assoc($result);

            $product_id=$item['id'];
            $product_name=$item['name'];
            $product_price=$item['price'];
            $product_image=$item['image'];
            $product_description=$item['description'];
            
            echo "
            <img src='./admin/product-images/$product_image' width='450px'><br>
            <h2>$product_name</h2>
            <h2 class='price'>₹$product_price/-</h2>
            </div>
            <div class='description'>
            <h3>Product Description</h3>
            <pre>
            <code>
$product_description</code></pre>
            <button class='cart-add'><a href='cart.php?pid=$product_id'>Add to Cart</a></button>
            ";
            ?>
        </div>
    </div>
    <script>
        if (window.history.replaceState) {
        window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>