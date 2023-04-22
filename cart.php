<?php 
include('includes/connect.php');
use PHPMailer\PHPMailer\PHPMailer;
if(!isset($_SESSION)){
    session_start();
} 
if(isset($_GET['logout'])){
    session_unset();
    session_destroy();
    header('location:index.php');
}

function sendMail($mail_product_name){
    $subject='Lapzy - Out of Stock';
    $body="<div style='font-size:1.35em;color:black;text-align:justify'>Respected Sir,<br><div style='text-indent:55px'>The customers are truly satisfied by the products in our website and the demand is increasing day by day sir. The stock for the product <b style= 'color:darkblue' >$mail_product_name</b> has decreased sir. I request that we increase the stock for this product, making sure that our customer's needs will be satisfied in future.</div><br>Regards<br>Sangeetha G<br><b><div style='color:green'>Lapzy Admin</div></b></div>";

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    $mail=new PHPMailer();
    $mail->isSMTP();
    $mail->Host="smtp.gmail.com";
    $mail->SMTPAuth=true;
    $mail->Username="lapzymanager@gmail.com";
    $mail->Password="yzgjgjnxejnzwpjh";
    $mail->Port=465;
    $mail->SMTPSecure="ssl";

    $mail->isHTML(true);
    $mail->setFrom("lapzymanager@gmail.com","Lapzy Admin");
    $mail->addAddress("dealershoplap@gmail.com","Dealer");
    $mail->Subject=("$subject");
    $mail->Body=$body;

    if($mail->send()){
        echo "";
    }
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        import Swal from 'sweetalert2';
        const Swal=require('sweetalert2');      
    </script>
    <style>
        .table{
            border-radius: 12px;
            border:3px solid;
            margin: 3em auto;
            width: 100%;
            max-width: 85%;
            padding-top: 2em;
            position: relative;
        }
        .table .cart-heading{
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
            margin-bottom: 5em;
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
        td form{
            display: flex;
            flex-direction: row;
        }
        td input[type=number]{
            width:50%;
            font-size: 1em;
            border: 2px solid;
            border-radius: 5px;
            margin-right: 15px;
            padding: 5px;
        }
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button {  
        opacity: 1;
        }
        td input[type=submit]{
            font-size: 0.9em;
            border: none;
            border-radius: 5px;
            padding: 8px;
            color: white;
            background-color: rgb(2, 2, 140);
            transition: 0.5s ease;
        }
        td input[type=submit]:hover{
            cursor: pointer;
        }
        td i{
            font-size: 1.35em;
            transition: 0.5s ease;
        }
        td i:hover{
            cursor: pointer;
            color: darkred;
        }
        .cart-total{
            margin: 0.5em;
            margin-left: 1.2em;
            display: inline-block;
            color: rgb(2, 2, 95);
            font-size: 1.35em;
        }
        .cart-row{
            text-align: right;
            background-color: white;
        }
        .empty-cart{
            background-color: white;
        }
        .empty-cart p{
            margin: 0.7em;
            color:rgba(0,0,0,0.55);
            font-weight: bold;
        }
        .delete-btn{
            border:none;
            font-size: 1em;
            background-color: inherit;
        }
        .hidden-id{
            display: none;
        }
        .checkout-btn{
            position:absolute;
            right: 1.7em;
            bottom:1em;
            font-size: 1.2em;
            border: none;
            border-radius: 6px;
            padding: 10px 12px;
            background-color: rgb(2, 2, 140);
            transition: 0.5s ease-in-out;
        }
        .checkout-btn:hover{
            cursor:pointer;
        }
        .checkout-btn  a{
            color: white;
        }
    </style>
</head>
<body>
    <?php  
    if(!isset($_SESSION['user-id']) or $_SESSION['user-id']==1){
        echo "
        <script>
        Swal.fire({
            title: 'Please Login to Continue',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Proceed',
            icon: 'info',
            width:450,
            allowOutsideClick:false,
            allowEscapeKey:false
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href='index.php';
            }
            else if(result.isDenied){
                window.location.href='index.php';
            }
            })  
        </script>
        ";
    }
    else if(isset($_SESSION['user-id'])){
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
            <h2 class='cart-heading'>Shopping Cart</h2>
        </center>
        <table>
            <tr>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Quantity</th>
                <th>Stocks Available</th>
                <th>Sub Total</th>
                <th>Delete</th>
            </tr>";
    }
    
    if(isset($_POST['delete_item'])){
        $select_quantity="select quantity from cart where product_id={$_POST['delete_item']} and user_id={$_SESSION['user-id']}";
        $result=mysqli_query($conn,$select_quantity);
        
        $reset_quantity=mysqli_fetch_assoc($result)['quantity'];
        $update_stock="update products set stock=stock+$reset_quantity where id={$_POST['delete_item']}";
        $result_stock=mysqli_query($conn,$update_stock);

        $delete_product="delete from cart where user_id={$_SESSION['user-id']} and product_id={$_POST['delete_item']}";
        $result_delete=mysqli_query($conn,$delete_product);
    }
    if(isset($_POST['update_cart'])){

        $select_stock="select * from products where id={$_POST['product_no']}";
        $result=mysqli_query($conn,$select_stock);
        $selected_product=mysqli_fetch_assoc($result);
        $available_stock=$selected_product['stock'];

        $select_quantity="select quantity from cart where product_id={$_POST['product_no']} and user_id={$_SESSION['user-id']}";
        $result=mysqli_query($conn,$select_quantity);
        $old_quantity=mysqli_fetch_assoc($result)['quantity'];

        $old_stock=$available_stock+$old_quantity;

        if($old_stock>=$_POST['quantity']){
            if($old_quantity>$_POST['quantity']){
                $quantity_difference=$old_quantity-$_POST['quantity'];
                $update_stock="update products set stock=stock+$quantity_difference where id={$_POST['product_no']}";
                $result_stock=mysqli_query($conn,$update_stock);
            }
            else if($old_quantity<$_POST['quantity']){
                $quantity_difference=$_POST['quantity']-$old_quantity;
                $update_stock="update products set stock=stock-$quantity_difference where id={$_POST['product_no']}";
                $result_stock=mysqli_query($conn,$update_stock);
            }
            $update_product="update cart set quantity={$_POST['quantity']} where user_id={$_SESSION['user-id']} and product_id={$_POST['product_no']}";
            $result_update=mysqli_query($conn,$update_product);

            $select_stock="select * from products where id={$_POST['product_no']}";
            $result=mysqli_query($conn,$select_stock);
            $mail_product=mysqli_fetch_assoc($result);
            $mail_product_name=$mail_product['name'];
            $mail_product_stock=$mail_product['stock'];

            if($mail_product_stock<5){
                sendMail($mail_product_name);
            }
        }
        else if($available_stock==0){
            echo "
                <script>
                Swal.fire({
                    title: 'No Stock Available',
                    text: 'No stock available for this product right now!',
                    icon: 'error',
                    confirmButtonText:'View Cart',
                    showDenyButton: true,
                    denyButtonText: 'Go to Home',
                    allowOutsideClick:false,
                    allowEscapeKey:false
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href='cart.php';
                    }
                    else if(result.isDenied){
                        window.location.href='index.php';
                    }
                    })  
                </script>
                ";
        }
        else{
            echo "
            <script>
            Swal.fire({
                title: 'Requirement Exceeded!',
                text: 'Requirement is greater than the available stock',
                icon: 'error',
                denyButtonText:'OK',
                showConfirmButton:false,
                showDenyButton:true,
                width:450,
                allowOutsideClick:false,
                allowEscapeKey:false
                })
            </script>";
        }
    }
    ?>
            <?php 
            if(isset($_GET['pid']) and isset($_SESSION['user-id'])){
                $select_cart="select * from cart where user_id={$_SESSION['user-id']} and product_id={$_GET['pid']}";
                $result=mysqli_query($conn,$select_cart);

                $select_product_quantity="select stock from products where id={$_GET['pid']}";
                $result_quantity=mysqli_query($conn,$select_product_quantity);
                $available_old_stock=mysqli_fetch_assoc($result_quantity)['stock'];

                if(mysqli_num_rows($result)>0){
                    echo "
                    <script>
                    Swal.fire({
                        title: 'Already Inserted',
                        text: 'Product is already inserted in cart',
                        icon: 'success',
                        confirmButtonText:'View Cart',
                        showDenyButton: true,
                        denyButtonText: 'Go to Home',
                        allowOutsideClick:false,
                        allowEscapeKey:false
                        }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href='cart.php';
                        }
                        else if(result.isDenied){
                            window.location.href='index.php';
                        }
                        })  
                    </script>
                    ";
                }
                else if($available_old_stock==0){
                    echo "
                    <script>
                    Swal.fire({
                        title: 'No Stock Available',
                        text: 'No stock available for this product right now!',
                        icon: 'error',
                        confirmButtonText:'View Cart',
                        showDenyButton: true,
                        denyButtonText: 'Go to Home',
                        allowOutsideClick:false,
                        allowEscapeKey:false
                        }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href='cart.php';
                        }
                        else if(result.isDenied){
                            window.location.href='index.php';
                        }
                        })  
                    </script>
                    ";
                }
                else{
                    $insert_cart="insert into cart(user_id,product_id,quantity) values({$_SESSION['user-id']},{$_GET['pid']},1)";
                    $result_cart=mysqli_query($conn,$insert_cart);
                    $update_stock="update products set stock=stock-1 where id={$_GET['pid']}";
                    $result_stock=mysqli_query($conn,$update_stock);

                    $select_query="select * from products where id={$_GET['pid']}";
                    $execute_query=mysqli_query($conn,$select_query);
                    $updated_product=mysqli_fetch_assoc($execute_query);
                    $pname=$updated_product['name'];
                    $updated_stock=$updated_product['stock'];
                    if($updated_stock<5){
                        sendMail($pname);
                    }

                    echo "<script>window.location.href='cart.php';</script>";    
                }
                
            }
            ?>
            <?php 
            if(isset($_SESSION['user-id'])){
            $total_price=0;
            $select_cart="select * from cart where user_id={$_SESSION['user-id']}";
            $result=mysqli_query($conn,$select_cart);
            if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
                    $product_id=$row['product_id'];
                    $product_quantity=$row['quantity'];
                    $select_products="select * from products where id=$product_id";
                    $result_products=mysqli_query($conn,$select_products);
                    while($product=mysqli_fetch_array($result_products)){
                        $product_id=$product['id'];
                        $product_image=$product['image'];
                        $product_name=$product['name'];
                        $product_price=$product['price'];
                        $product_stock=$product['stock'];
                        $product_subtotal=$product_quantity*$product_price;
                        $total_price+=$product_quantity*$product_price;
    
                        echo "
                        <tr>
                            <td>
                                <center>
                                    <img src='admin/product-images/$product_image' width='150px'>
                                </center>
                            </td>
                            <td id='pname'>$product_name</td>
                            <td>₹$product_price/-</td>
                            <td>
                                <form method='post'>
                                    <input type='text' class='hidden-id' name='product_no' value=$product_id>
                                    <input type='number' name='quantity' value=$product_quantity min='1'>
                                    <input type='submit' name='update_cart' value='Update'>
                                </form>
                            </td>
                            <td>$product_stock</td>
                            <td>₹$product_subtotal/-</td>
                            <form method='post'>
                                <td><button class='delete-btn' name='delete_item' value='$product_id'><i class='fa-sharp fa-solid fa-trash'></i></button></td> 
                            </form>
                        </tr>";
                    }
                }     
            }
            else{
                echo "<tr>
                <td colspan='9' class='empty-cart'><p>No products have been added to cart yet</p></td>
                </tr>";
            }
            echo "<tr>
                <td colspan='9' class='cart-row'><h2 class='cart-total'>Total Price: ₹$total_price/-</h2></td>
                </tr>
                </table>";

            if($total_price!=0){
                echo "
                <button class='checkout-btn'><a href='checkout.php?amount=$total_price'>Checkout</a></button>";
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