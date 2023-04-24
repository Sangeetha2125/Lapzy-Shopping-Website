<?php 

include('includes/connect.php');

if(!isset($_SESSION)){
    session_start();
} 

if(isset($_GET['logout'])){
    session_unset();
    session_destroy();
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapzy for you!</title>
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="main.css">
    <style>
        header li{
            font-size: 1.05em;
        }
        .table{
            border-radius: 12px;
            border:3px solid;
            margin: 3em auto;
            width: 100%;
            max-width: 85%;
            padding-top: 2em;
            position: relative;
        }
        .table .order-heading{
            font-size: 1.9em;
            color: rgb(2, 2, 74);
            display: inline-block;
            border: 6px solid rgb(2, 2, 74);
            padding: 4px 12px;
            border-radius: 36px;
        }
        table {
            border: 2px solid;
            border-collapse: collapse;
            width: 95%;
            margin: 2em auto;
            margin-bottom: 2.5em;
        }
        td, th {
            border: 2px solid ;
            text-align: center;
            padding: 8px;
            font-size: 1.2em;
        }
        th{
            font-size: 1.3em;
        }
        tr:nth-child(even) {
            background-color: rgba(2,2,74,0.2);
        }
        #pname{
            text-align: justify;
        }
        .order-date{
            white-space: nowrap;
        }
        i{
            letter-spacing: 4px;
        }
    </style>
</head>
<body>
    <?php 
    
    if(isset($_SESSION['user-id'])){
        echo "
        <header>
            <div class='header-content'>
                <div class='logo'>
                    <a href='index.php'><img src='images/logo.png'></a>
                </div>
                <ul>
                    <li><button><a href='index.php'>Home</a></button></li>
                    <li><button><a href='index.php#products-section'>Products</a></button></li>
                    <li><button><a href='cart.php'>Cart</a></button></li>
                    <li><button><a href='orders.php'>Orders</a></button></li>
                    <li><button><a href='index.php?logout'>Logout</a></button></li>
                </ul>
            </div>
        </header>
        <div class='table'>
        <center>
            <h2 class='order-heading'>Order History</h2>
        </center>
        <table>
            <tr>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Quantity Bought</th>
                <th>Amount Paid</th>
                <th>Order Date</th>
            </tr>";

        $select_orders="select * from orders where user_id={$_SESSION['user-id']}";
        $result=mysqli_query($conn,$select_orders);
        while($row=mysqli_fetch_assoc($result)){
            $product_id=$row['product_id'];
            $quantity=$row['quantity'];
            $order_date=$row['order_date'];

            $select_product="select * from products where id=$product_id";
            $result_product=mysqli_query($conn,$select_product);
            $product=mysqli_fetch_assoc($result_product);

            $product_image=$product['image'];
            $product_name=$product['name'];
            $price=$product['price'];
            $amount_paid=$price*$quantity;

            echo "
            <tr>
                <td>
                    <center>
                        <img src='admin/product-images/$product_image' width='150px'>
                    </center>
                </td>
                <td id='pname'>$product_name</td>
                <td>$quantity</td>
                <td>₹$amount_paid/-</td>
                <td class='order-date'><i class='fa-regular fa-calendar'></i>  $order_date</td>
            </tr>";
        }


    }
    ?>
            
                 
    </div>
    <script>
        if (window.history.replaceState) {
        window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>