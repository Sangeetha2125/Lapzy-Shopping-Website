<?php
    if(!isset($_SESSION)){
        session_start();
    }
    if(isset($_GET['logout'])){
        session_unset();
        session_destroy();
        header('location:../index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../main.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin Dashboard</title>
    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        import Swal from 'sweetalert2';
        const Swal=require('sweetalert2');      
    </script>
    <style>
        .add-products{
            margin-bottom: 3em;
        }
        .view-products,.view-orders,.view-users{
            border-radius: 12px;
            border:3px solid;
            margin: 3em auto;
            width: 100%;
            max-width: 80%;
            padding: 2em 1em;
            padding-bottom: 1em;
        }
        .view-users{
            max-width: 70%;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 2em auto;
            margin-bottom: 0.8em;
        }
        td, th {
            border: 1px solid ;
            text-align: center;
            padding: 8px;
            font-size: 1em;
        }
        th{
            font-size: 1.2em;
        }
        #pname{
            text-align: justify;
        }
        tr:nth-child(even) {
            background-color: rgba(2,65,2,0.2);
        }
        .view-products h2,.view-users h2,.view-orders h2{
            font-size: 1.7em;
            color: rgb(2,65,2);
            display: inline;
            font-weight: bold;
            border: 6px solid;
            padding: 4px 12px;
            border-radius: 36px;
        }
        .view-orders i{
            letter-spacing: 4px;
        }
        .order-date{
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo">
                <a href="../index.php"><img src="../images/logo.png" alt=""></a>
            </div>
            <ul>
                <li><button><a href="index.php?add_categories">Add Categories</a></button></li>
                <li><button><a href="index.php?add_brands">Add Brands</a></button></li>
                <li><button><a href="index.php?add_products">Add Products</a></button></li>
                <li><button><a href="index.php?view_products">View Products</a></button></li>
                <li><button><a href="index.php?view_users">View Users</a></button></li>
                <li><button><a href="index.php?view_orders">View Orders</a></button></li>
                <li class="icons" title="Logout"><button><a href="index.php?logout"><i class="fa-sharp fa-solid fa-right-from-bracket"></i></a></button></li>
            </ul>
        </div>
    </header>
    <?php 
    // Using get variable
    if(isset($_GET['add_products'])){
        include('add_products.php');
    }
    else if(isset($_GET['add_categories'])){
        include('add_categories.php');
    }
    else if(isset($_GET['add_brands'])){
        include('add_brands.php');
    }
    else if(isset($_GET['view_products'])){
        include('view_products.php');
    }
    else if(isset($_GET['view_users'])){
        include('view_users.php');
    }
    else if(isset($_GET['view_orders'])){
        include('view_orders.php');
    }
    else{
        include('add_products.php');
    }
    ?>
    <script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>