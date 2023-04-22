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
    <link rel="stylesheet" href="glide.core.min.css">
    <link rel="stylesheet" href="glide.theme.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        import Swal from 'sweetalert2';
        const Swal=require('sweetalert2');
    </script>
    <style>
        .header-nav-border{
            position: relative;
        }
        .products{
            gap:1.6rem;
        }
        .product-description p.product-name{
            font-size:1.25em;
            text-align: justify;
            margin: 5px 12px;
        }
        .product-description button{
            margin:15px 37px;
            border-radius: 9px;
        }
        .filter-button{
            font-size: 2.2em;
            border: none;
            background-color: white;
            margin-left: 0.5em;
            align-self: center;
        }
        .filter-button:hover{
            cursor: pointer;
        }
        .search form{
            display: flex;
            flex-direction: row;
            justify-content: center;
            margin-bottom: 3em;
        }
        .search form input[type=submit]{
            margin-left: 1.2em;
            font-size: 1.1em;
            border-radius: 8px;
            padding: 10px 24px;
            border: none;
            color:white;
            background-color: darkblue;
        }
        .search form input[type=submit]:hover{
            cursor: pointer;
        }
        .search form input[type=search]{
            width:60%;
            padding:0.85rem 1rem;
            border: 3px solid;
            border-radius: 18px;
            font-size: 1.23em;
            box-sizing: border-box;
            transition: 0.5s ease;
        }
        .products-section span{
            display: block;
            text-align: center;
            font-size: 1.7em;
            font-weight: bold;
            color: brown;
            margin:1em;
        }
        /* Glider Styles */
        .glide__slides li{
            border: 3.5px solid black;
            border-radius: 6px;
        }
        .glide__bullet{
            background-color: rgb(0,0,0,0.25);
        }
        .glide__bullet--active{
            background-color: rgb(0,0,0,0.7);
        }
        .card{
            height: 290px;
            text-align: justify;
            padding: 1em 1.2em;
            position: relative;
            overflow: hidden;
            background: linear-gradient(rgba(255,255,255,0.85),rgba(255,255,255,0.85)),url('images/review.jpg');
            width: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .card p{
            font-size: 1.15em;
            text-align: justify;
            height: 57%;
            max-height: 80%;
            margin: auto;
        }
        .card div{
            font-size: 1.2em;
            color: darkgreen;
            font-weight: bold;
        }
        .card h2{
            color:darkred;
            font-size: 1.65em;
        }
        footer{
            margin-top: 1.5em;
        }
        i{
            color: black;
        }
        .order_date{
            color: darkgreen;
            letter-spacing: 9px;   
            font-weight: bold;
        }
        .user_icon{
            color: darkred;
            font-size: 0.9em;
            letter-spacing: 15px;
        }
        hr{
            height: 3px;
            background-color: #000;
        }
        .review-heading{
            font-size: 2em;
            margin: 25px;
            padding: 10px 20px;
            display: inline-block;
            border: 8px solid rgb(0, 0, 90);
            border-radius: 30px;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo">
                <a href="index.php"><img src="images/logo.png" alt=""></a>
            </div>
            <ul>
                <li><button><a href="index.php">Home</a></button></li>
                <li><button><a href="#products-section">Products</a></button></li>
                <?php 
                
                if(!isset($_SESSION['user-id']) or $_SESSION['user-id']==1){
                    echo "<li><button onclick=\"document.getElementById('signup-form').style.display='block'\" style=\"width:auto;\">Sign Up</button></li>
                    <li><button onclick=\"document.getElementById('login-form').style.display='block'\" style=\"width:auto;\">Login</button></li>";
                }
                else{
                    echo "<li><button><a href='cart.php'>Cart</a></button></li>
                    <li><button><a href='orders.php'>Orders</a></button></li>
                    <li><button><a href='index.php?logout'>Logout</a></button></li>";
                }
                ?>
                <?php 
                if(isset($_POST['login'])){
                    $name=mysqli_real_escape_string($conn,$_POST['username']);
                    $email=mysqli_real_escape_string($conn,$_POST['email']);
                    $password=mysqli_real_escape_string($conn,md5($_POST['user-password']));

                    $valid_user="select * from users where name='$name' and email='$email' and password='$password'";
                    $result=mysqli_query($conn,$valid_user);
                    
                    if(mysqli_num_rows($result)>0){
                        if($password==md5('admin@123')){
                           echo "<script>window.location.href='admin/index.php';</script>";
                        }
                        else{
                            if(!isset($_SESSION)){
                                session_start();
                            }
                            $_SESSION['user-id']=mysqli_fetch_assoc($result)['id'];
                            echo "
                            <script>
                            Swal.fire({
                                title: 'Welcome back!',
                                text: 'You have been logged in Successfully',
                                icon: 'success',
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
                    }
                    else{
                        echo "
                        <script> 
                          Swal.fire({
                            title: 'Try Again !',
                            text: 'Invalid User Credentials',
                            icon: 'error',
                            showDenyButton: true,
                            showCancelButton: true,
                            confirmButtonText: 'Try Again ?',
                            denyButtonText: 'Register Now',
                            cancelButtonText: 'No, Cancel!', 
                            denyButtonColor:'#24ad3d',
                            allowOutsideClick:false,
                            allowEscapeKey:false,    
                          }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('login-form').style.display='block';
                            }
                            else if(result.isDenied){
                                document.getElementById('signup-form').style.display='block';
                            }
                          })
                        </script>";
                    }
                }
                ?>
        </div>
    </header>
    <?php 
    echo "<style>
    .banner{
        background: url('images/bg.jpg');
        width: 100%;
        height: 80vh;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    </style>";
    ?>
    <div class="banner"></div>
    <div class="form" id="signup-form">
        <form action="" method="post" class="form-content animate">
            <div class="avatar-image">
                <span onclick="document.getElementById('signup-form').style.display='none';document.getElementById('errors').style.display='none';" class="close" title="Close Signup Form">&times;</span>
                <img src="images/boy_avatar.png" alt="Avatar" class="avatar">
            </div>
            <div class="form-flex">
                <label for="username">Name: </label>
                <input type="text" name="username" id="username" title="Username should not contain numbers,special characters and should be atleast 3-20 characters long" pattern="[A-Z a-z]{3,20}" autocomplete="off" spellcheck="false" required><br>
            </div>
            <div class="form-flex">
                <label for="email">Email-ID: </label>
                <input type="email" name="email" id="email" autocomplete="off" spellcheck="false" required><br>
            </div>
            <div class="form-flex">
                <label for="new-password">Password: </label>
                <input type="password" name="new-password" id="new-password" title="The password should be atleast 5 characters long" minlength="5" autocomplete="off" spellcheck="false" required><br>
            </div>
            <div class="form-flex">
                <label for="confirm-password">Confirm Password: </label>
                <input type="password" name="confirm-password" id="confirm-password" minlength="5" autocomplete="off" spellcheck="false" required><br>
            </div>
            <div class="flex-container-form">
                <span id="errors"></span>
            </div>
            <div class="flex-container-form">
                <span id="valid"></span>
            </div>
            <div class=flex-container-form>
                <div class="existing-user-link" onclick="document.getElementById('login-form').style.display='block';document.getElementById('signup-form').style.display='none'">Already Registered?</div>
                <button name="signup" id="signupbtn" type="submit" onclick="return validatePassword()">Sign Up</button>
            </div>
        </form>
    </div>
    <?php 
        if(isset($_POST['signup'])){
            $name=mysqli_real_escape_string($conn,$_POST['username']);
            $email=mysqli_real_escape_string($conn,$_POST['email']);
            $password=mysqli_real_escape_string($conn,md5($_POST['new-password']));

            $new_user="select * from users where name='$name' and email='$email' and password='$password'";
            $result=mysqli_query($conn,$new_user);
            
            if(mysqli_num_rows($result)>0){
                echo "
                <script>
                Swal.fire({
                    title: 'User Already Exists',
                    text: 'Do you want to login?',
                    confirmButtonText:'Yes, Login',
                    confirmButtonColor: '#3085d6',
                    showDenyButton: true,
                    denyButtonText: 'No, Signup',
                    icon: 'info',
                    width:400,
                    allowOutsideClick:false,
                    allowEscapeKey:false
                    }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('login-form').style.display='block';
                    }
                    else if(result.isDenied){
                        document.getElementById('signup-form').style.display='block';
                    }
                    })  
                </script>
                ";
            }
            else{
                $insert_user="insert into users(name,email,password) values('$name','$email','$password')";
                $result_insert=mysqli_query($conn,$insert_user);
                echo "
                <script>
                Swal.fire({
                    title: 'Signed Up',
                    text: 'Your Registration is Successful',
                    confirmButtonText:'Proceed',
                    confirmButtonColor: '#3085d6',
                    icon: 'success',
                    allowOutsideClick:false,
                    allowEscapeKey:false
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title:'Do you want to login?',
                            icon:'question',
                            showConfirmButton:true,
                            showDenyButton: true,
                            confirmButtonText: 'Yes',
                            denyButtonText: 'No',
                            width:400,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('login-form').style.display='block';
                            }
                            })
                    }
                    })  
                </script>
                ";
            }
        }
    ?>
    <div class="form" id="login-form">
        <form action="" method="post" class="form-content animate">
            <div class="avatar-image">
                <span onclick="document.getElementById('login-form').style.display='none';" class="close" title="Close Login Form">&times;</span>
                <img src="images/girl_avatar.png" alt="Avatar" class="avatar">
            </div>
            <div class="form-flex">
                <label for="username">Name: </label>
                <input type="text" name="username" id="username" title="Username should not contain numbers and should be atleast 3-20 characters long" pattern="[A-Z a-z]{3,20}" autocomplete="off" spellcheck="false" required><br>
            </div>
            <div class="form-flex">
                <label for="email">Email-ID: </label>
                <input type="email" name="email" id="email" autocomplete="off" spellcheck="false" required><br>
            </div>
            <div class="form-flex">
                <label for="user-password">Password: </label>
                <input type="password" name="user-password" id="user-password" title="The password should be atleast 5 characters long" minlength="5" autocomplete="off" spellcheck="false" required><br>
            </div>
            <div class=flex-container-form>
                <div class="new-user-link" onclick="document.getElementById('signup-form').style.display='block';document.getElementById('login-form').style.display='none'">Haven't Registered Yet?</div>
                <button name="login" type="submit">Login</button>
            </div>
        </form>
    </div>
    <section class="products-section" id="products-section">
        <h1>Products for You</h1>
        <div class="search">
            <form action="" class="search-form" method="get">
                <input type="search" name="search-product" placeholder="Search your product here..." autocomplete="off" spellcheck="false">
                <input type="submit" name="search-btn" value="Search">
            </form>
                <form action="index.php" method="get">
                <div class="select-form"> 
                    <div>
                        <select name="category" id="category-select">
                            <option value="">-- Select a Category --</option>
                            <?php 
                                $select_categories="select * from categories";
                                $result_select=mysqli_query($conn,$select_categories);
                                while($row=mysqli_fetch_assoc($result_select)){
                                    $category_id=$row['id'];
                                    $category_name=$row['name'];
                                    echo "<option value='$category_id'>$category_name</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div style="display:flex">
                        <select name="brand" style="align-self:flex-start;">
                            <option value="">-- Select a Brand --</option>
                            <?php 
                                $select_brands="select * from brands";
                                $result_select=mysqli_query($conn,$select_brands);
                                while($row=mysqli_fetch_assoc($result_select)){
                                    $brand_id=$row['id'];
                                    $brand_name=$row['name'];
                                    echo "<option value='$brand_id'>$brand_name</option>";
                                }
                            ?>
                        </select>
                        <button class="filter-button" title="filter"><i class="fa-sharp fa-solid fa-filter"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <h2 class="category-heading">Laptops</h2><span id="search-result1"></span>
        <div class="products">
            <?php 
                if(!isset($_GET['search-btn']) or empty($_GET['search-product'])){
                if((empty($_GET['category']) and empty($_GET['brand'])) or (empty($_GET['brand']) and $_GET['category']==1)){
                    $select_laptops="select * from products where category_id in (1) order by rand() limit 0,9";
                }
                else if(($_GET['category']==1 and !empty($_GET['brand'])) or empty($_GET['category'])){
                    $select_laptops="select * from products where category_id in (1) and brand_id={$_GET['brand']}";
                }
                if(!empty($select_laptops)){
                $result_laptops=mysqli_query($conn,$select_laptops);
                if(mysqli_num_rows($result_laptops)==0){
                    echo "<style>.category-heading{display:none;margin:0}.accessory-heading{display:inline-block}</style>";
                }
                else{
                while($row=mysqli_fetch_assoc($result_laptops)){
                    $product_id=$row['id'];
                    $product_name=$row['name'];
                    $product_price=$row['price'];
                    $product_image=$row['image'];

                    echo 
                    "<div class='product-content'>
                        <img src='./admin/product-images/$product_image'>
                        <div class='product-description'>
                            <div>
                                <p class='product-name'>$product_name</p>
                                <p class='product-price'>₹$product_price/-</p>
                            </div>
                            <div>
                                <button class='add-to-cart'><a href='cart.php?pid=$product_id'>Add to Cart</a></button>
                                <button class='view-more'><a href='product_page.php?laptop=$product_id'>View More</a></button>
                            </div>
                        </div>
                    </div>";
                }}}
                else if(empty($select_laptops)){
                    echo "<style>.category-heading{display:none;margin:0}.accessory-heading{display:inline-block;}</style>";
                }}
                else{
                    $search_query="select * from products where category_id in (1) and lower(name) like '%{$_GET['search-product']}%'";
                    $result_search=mysqli_query($conn,$search_query);
                    if(mysqli_num_rows($result_search)==0){
                        echo "
                        <script>document.getElementById('search-result1').innerHTML='No search results found!'</script>
                        ";
                    }
                    else{
                        while($row=mysqli_fetch_assoc($result_search)){
                            $product_id=$row['id'];
                            $product_name=$row['name'];
                            $product_price=$row['price'];
                            $product_image=$row['image'];
        
                            echo 
                            "<div class='product-content'>
                                <img src='./admin/product-images/$product_image'>
                                <div class='product-description'>
                                    <div>
                                        <p class='product-name'>$product_name</p>
                                        <p class='product-price'>₹$product_price/-</p>
                                    </div>
                                    <div>
                                        <button class='add-to-cart'><a href='cart.php?pid=$product_id'>Add to Cart</a></button>
                                        <button class='view-more'><a href='product_page.php?laptop=$product_id'>View More</a></button>
                                    </div>
                                </div>
                            </div>";
                        }}
                }
            ?>
        </div>
        <h2 class="category-heading accessory-heading">Accessories</h2><span id="search-result2"></span>
        <div class="products accessories">
            <?php
            if(!isset($_GET['search-btn']) or empty($_GET['search-btn'])){
                if((empty($_GET['category']) and empty($_GET['brand']))){
                    $select_accessories="select * from products where category_id not in (1) order by rand() limit 0,9";
                }
                else if(empty($_GET['category'])){
                    $select_accessories="select * from products where category_id not in (1) and brand_id={$_GET['brand']}";
                }
                else if(($_GET['category']!=1 and !empty($_GET['brand']))){
                    $select_accessories="select * from products where category_id={$_GET['category']} and brand_id={$_GET['brand']}";
                }
                else if($_GET['category']!=1 and empty($_GET['brand'])){
                    $select_accessories="select * from products where category_id={$_GET['category']}";
                }
                if(!empty($select_accessories)){
                    $result_accessories=mysqli_query($conn,$select_accessories);
                    if(mysqli_num_rows($result_accessories)==0){
                        echo "<style>.accessory-heading{display:none}</style>";
                    }
                    else{
                while($row=mysqli_fetch_assoc($result_accessories)){
                    $product_id=$row['id'];
                    $product_name=$row['name'];
                    $product_price=$row['price'];
                    $product_image=$row['image'];

                    echo 
                    "<div class='product-content'>
                        <img src='./admin/product-images/$product_image'>
                        <div class='product-description'>
                            <div>
                                <p class='product-name'>$product_name</p>
                                <p class='product-price'>₹$product_price/-</p>
                            </div>
                            <div>
                                <button class='add-to-cart'><a href='cart.php?pid=$product_id'>Add to Cart</a></button>
                                <button class='view-more'><a href='product_page.php?accessory=$product_id'>View More</a></button>
                            </div>
                        </div>
                    </div>";
                }}}
                else if(empty($select_accessories)){
                    echo "<style>.accessory-heading{display:none;}</style>";
                }}
            else{
                $search_query="select * from products where category_id not in (1) and lower(name) like '%{$_GET['search-product']}%'";
                $result_search=mysqli_query($conn,$search_query);
                if(mysqli_num_rows($result_search)==0){
                    echo "
                    <script>document.getElementById('search-result2').innerHTML='No search results found!'</script>
                    ";
                }
                else{
                    while($row=mysqli_fetch_assoc($result_search)){
                        $product_id=$row['id'];
                        $product_name=$row['name'];
                        $product_price=$row['price'];
                        $product_image=$row['image'];
    
                        echo 
                        "<div class='product-content'>
                            <img src='./admin/product-images/$product_image'>
                            <div class='product-description'>
                                <div>
                                    <p class='product-name'>$product_name</p>
                                    <p class='product-price'>₹$product_price/-</p>
                                </div>
                                <div>
                                    <button class='add-to-cart'><a href='cart.php?pid=$product_id'>Add to Cart</a></button>
                                    <button class='view-more'><a href='product_page.php?accessory=$product_id'>View More</a></button>
                                </div>
                            </div>
                        </div>";
                    }}
            }
            ?>
        </div>
    </section>
    <div id="review-section">
        <center><h2 class="review-heading">Reviews</h2></center><br>
        <div class="glide">
            <div class="glide__track" data-glide-el="track">
              <ul class="glide__slides">
    <?php 
    $select_review="select * from review order by rand()";
    $result_review=mysqli_query($conn,$select_review);
    $no_of_rows=mysqli_num_rows($result_review);

    while($row=mysqli_fetch_assoc($result_review)){
    $user_id=$row['user_id'];
    $review_text=$row['review_text'];
    $order_date=$row['order_date'];
    
    $user_name_query="select name from users where id=$user_id";
    $result_user=mysqli_query($conn,$user_name_query);
    $user_name=mysqli_fetch_assoc($result_user)['name'];

    echo"<li class='glide__slide'>
    
    <div class='card'>
        <h2><i class='fa-solid fa-user user_icon'></i>$user_name</h2><br><hr><br>
        <p>$review_text</p><br>
        <div><i class='fa-regular fa-calendar order_date'></i>$order_date</div>
    </div>
    </li>";
    }
    echo "</ul>
    </div>
    <br><br><br>
    <div class='glide__bullets' data-glide-el='controls[nav]'>";

    $index=0;
    while($no_of_rows>0){
        echo "<button class='glide__bullet' data-glide-dir='=$index'></button>";
        $index+=1;
        $no_of_rows-=1;
    }
    ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
    <script src="glider.js"></script>
    <script>
        const config ={
            type:'carousel',
            perView:3,
            focusAt:'center',
            autoplay:2300,
            breakpoints:{
                800:{
                    perView:3
                }
            }
        }
        new Glide('.glide',config).mount()
    </script>
    <footer>
        <p>@Copyrights Reserved</p>
    </footer>
    <script>
        
        var signupdiv = document.getElementById('signup-form');
        var login = document.getElementById('login-form');

        window.onclick = function(event)
        {
        if (event.target == signupdiv)
        {
            signupdiv.style.display = "none";
            document.getElementById('errors').style.display='none';
        }
        else if(event.target == login)
        {
            login.style.display = "none";
        }
        }
        var errors = document.getElementById('errors');
        var valid = document.getElementById('valid');

        function validatePassword() 
        {
        const newPassword = document.getElementById('new-password').value;
        const confirmPassword = document.getElementById('confirm-password').value;

        if(newPassword!="" & confirmPassword!="" & newPassword!=confirmPassword)
        {
            valid.style.display='none';
            errors.style.display='block';
            errors.innerHTML="Passwords doesn't match !";
            return false;
        }
        else if(newPassword!="" & confirmPassword!="")
        {
            errors.style.display='none';
            valid.style.display='block';
            valid.innerHTML="Passwords match successfully !";
            return true;
        }
        }
    </script>
    <script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
        }
    </script>
</body>
</html>