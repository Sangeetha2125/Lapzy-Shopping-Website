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
    <title>Lapzy for you!</title>
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="main.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        import Swal from 'sweetalert2';
        const Swal=require('sweetalert2');
        var text='';
    </script>
</head>
<style>
    .checkout-div{
        width:100%;
        max-width: 65%;
        margin: 2em auto;
        margin-bottom: 1em;
    }
    .checkout-form{
        border:2px solid black;
        border-radius:10px;
        padding: 0.5em;
        padding-left:2em;
        padding-bottom: 0;
        position: relative;
    }
    .checkout-form label{
        font-size: 1.2em;
        font-weight: bold;
    }
    .checkout-form h2{
        font-size: 1.6em;
    }
    .cart-summary{
        border:2px solid black;
        border-radius:10px;
        padding: 1em;
    }
    .checkout-form div{
        margin: 13px auto;
    }
    .checkout-form input,.checkout-form select{
        margin: 6px 0;
        width: 55%;
        border: 2px solid;
        border-radius: 5px;
        padding: 8px;
        font-size: 1.1em;
    }
    .checkout-form select{
        width:57%;
    }
    .payment-img1{
        position: absolute;
        top:6em;
        right:4em;
    }
    .payment-img2{
        position: absolute;
        top:20em;
        right:4em;
    }
    .payment-img3{
        position: absolute;
        top:29em;
        right:4em;
    }
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button {  
        opacity: 1;
    }
    .checkout-form input[type=submit]{
        width:16%;
        background-color:rgba(2, 2, 74,0.87);
        color: white;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 1.2em;
        margin-bottom: 0;
        margin-right: 1.7em;
        border:none;
    }
    .checkout-form input[type=submit]:hover{
        cursor:pointer;
    }
    .cart-summary-items{
        margin-top: 1.5em;
    }
    .cart-summary-items li{
        display: grid;
        grid-template-columns: 40% 60%;
        justify-content: center;
        align-items: center;
    }
    .cart-summary-items li span{
        color: darkred;
        font-weight: bold;
    }
    .item-price{
        margin-top:1em;
    }
    .price-input{
        position: relative;
    }
    .price-input input{
        padding-left: 25px;
        width:53%;
    }
    .price-input::before{
        position: absolute;
        top:-3px;
        content: "₹";
        left:10px;
        font-size: 1.35em;
    }
    input[name=amount] {
        pointer-events: none;
    }
    .go-back{
        width:16%;
        background-color:#048104;
        border-radius: 8px;
        padding: 10px 13px;
        font-size: 1.2em;
        margin-bottom: 0;
        border: none;
    }
    .go-back:hover{
        cursor:pointer;
    }
    .go-back a{
        color: white;
        text-decoration: none;
    }
    #review-div{  
        display: none;   
        position: fixed;
        z-index: 1;
        top:0;
        left:0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.7);
    }
    #review-form{
        width: 31%;
        background-color: #ffffff;
        margin:15.2em auto;
        padding: 1em 1.5em;
        border:2px solid;
        border-radius: 7px;
    }
    #review-form label{
        font-size: 1.4em;
        font-weight: bold;
    }
    #review-form textarea{
        border: 2px solid;
        border-radius: 4px;
        margin: 1em auto;
        font-size: 1.3em;
        padding: 8px;
    }
    #review-form input[type=submit]{
        padding: 8px 18px;
        border:none;
        border-radius: 5px;
        background-color:#048104;
        color: white;
        font-size: 1.2em;
        margin-bottom: 0.2em;
        transition: 0.5s ease;
    }
    #review-form input[type=submit]:hover{
        cursor: pointer;
    }
    .animate {
        -webkit-animation: animatezoom 0.5s;
        animation: animatezoom 0.5s
    }
    input[name=amount]::-webkit-inner-spin-button, 
    input[name=amount]::-webkit-outer-spin-button {  
        opacity: 0;
    }
</style>
<body>
    <?php 
    if(isset($_SESSION['user-id'])){
        $select_info="select * from users where id={$_SESSION['user-id']}";
        $result=mysqli_query($conn,$select_info);
        $old_info=mysqli_fetch_assoc($result);

        $old_country=$old_info['country'];
        $old_city=$old_info['city'];
        $old_address=$old_info['address'];
        $old_pin_code=$old_info['pin_code'];
        $old_payment_mode=$old_info['payment_mode'];
        $old_phone=$old_info['phone_number'];
        
        if(is_null($old_country) and is_null($old_city) and is_null($old_address) and is_null($old_pin_code) and is_null($old_payment_mode) and is_null($old_phone)){
            $old_country='';
            $old_city='';
            $old_address='';
            $old_pin_code='';
            $old_payment_mode='';
            $old_phone='';
        }

        if(isset($_POST['payment-submit'])){
            $country=$_POST['country'];
            $city=$_POST['city'];
            $address=$_POST['address'];
            $pin_code=$_POST['pin_code'];
            $payment_mode=$_POST['payment-mode'];
            $phone_number=$_POST['phone_number'];
    
            $update_query="update users set country='$country',city='$city',address='$address',pin_code=$pin_code,phone_number='$phone_number',payment_mode='$payment_mode' where id={$_SESSION['user-id']}";
            $execute_query=mysqli_query($conn,$update_query);
            

            echo "
            <script> 
            Swal.fire({
                title: 'Payment Successful',
                text: 'Your order is placed successfully',
                icon: 'success',
                confirmButtonText:'Leave Review',
                allowOutsideClick:false,
                allowEscapeKey:false
                }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('review-div').style.display='block';
                }
                })  

            </script>
            ";
        }

        if(isset($_POST['review-btn'])){

            $review_text=mysqli_real_escape_string($conn,$_POST['review']);
            $select_cart="select * from cart where user_id={$_SESSION['user-id']}";
            $result_cart=mysqli_query($conn,$select_cart);

            while($row=mysqli_fetch_assoc($result_cart)){
                $product_id=$row['product_id'];
                $quantity=$row['quantity'];

                $insert_order="insert into orders(user_id,product_id,quantity,order_date) values({$_SESSION['user-id']},$product_id,$quantity,curdate())";
                $result_order=mysqli_query($conn,$insert_order);
            }

            $insert_review="insert into review(user_id,review_text,order_date) values({$_SESSION['user-id']},'$review_text',curdate())";
            $execute_review=mysqli_query($conn,$insert_review);

            $delete_cart="delete from cart where user_id={$_SESSION['user-id']}";
            $execute_query=mysqli_query($conn,$delete_cart);

            echo "
            <script> 
            Swal.fire({
                title: 'Review Saved',
                text: 'Thanks for Ordering',
                icon: 'success',
                confirmButtonText:'Go to Home',
                allowOutsideClick:false,
                allowEscapeKey:false
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href='index.php';
                }
                })  

            </script>
            ";
        }

    echo "
    <div class='checkout-div'>
        <div class='checkout-form'>
            <form method='post'>
                <center>
                    <h2 style='font-size: 1.8em;'>Billing Details</h2>
                </center>
                <div>
                    <label for='country'>Country Name:</label><br>
                    <input type='text' name='country' id='country' value='$old_country' autocomplete='off' spellcheck='false' required>
                </div>
                <div>
                    <label for='city'>City Name:</label><br>
                    <input type='text' name='city' id='city' value='$old_city' autocomplete='off' spellcheck='false' required>
                </div>
                <div>
                    <label for='address'>Shipping Address: </label><br>
                    <input type='text' name='address' id='address' value='$old_address' autocomplete='off' spellcheck='false' required>
                </div>
                <div>
                    <label for='pin_code'>Pin Code:</label><br>
                    <input type='number' name='pin_code' id='pin_code' value='$old_pin_code' autocomplete='off' spellcheck='false'  required>
                </div>
                <div>
                    <label for='payment-mode'>Select a Payment Mode: </label><br>
                    <select name='payment-mode' id='payment-mode'>
                        <option value='Cash on Delivery'>Cash on Delivery</option>
                        <option value='UPI mode'>UPI mode</option>
                        <option value='Credit Card'>Credit Card</option>
                    </select>
                </div>
                <div>
                    <label for='phone_number'>Phone Number:</label><br>
                    <input type='number' name='phone_number' id='phone_number' value='$old_phone' autocomplete='off' spellcheck='false'  required>
                </div>
                <div>
                    <label for='amount'>Total Amount:</label><br>
                    <span class='price-input'><input type='number' name='amount' id='amount' value={$_GET['amount']}></span>
                </div>
                <div>
                    <input type='submit' name='payment-submit' value='Place Order'>
                    <button class='go-back'><a href='cart.php'>Go to Cart</a></button>
                </div>
            </form>
            <img src='images/payment.jpg' class='payment-img1' width='300px'>
            <img src='images/payment2.jpg' class='payment-img2' width='300px'>
            <img src='images/payment.webp' class='payment-img3' width='300px'>
        </div>
    </div>";
    }
    ?>
    <div id='review-div'>
        <form method="post" id='review-form' class='animate'>
            <center><label for="review">Enter your Review:</label><br>  </center> 
            <textarea name="review" id="review" cols="42" rows="6" placeholder='Type your review here..' autocomplete='off' spellcheck="false" maxlength='310' required></textarea><br>
            <center><input type="submit" name='review-btn' value="Save Review"></center>
        </form>
    </div>
    <script>
        if (window.history.replaceState) {
        window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>