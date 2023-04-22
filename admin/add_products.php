<?php
include('../includes/connect.php'); 
if(isset($_POST['add-product'])){
    $product_name=$_POST['name'];
    $product_price=$_POST['price'];
    $product_stock=$_POST['stock'];
    $category_id=$_POST['category'];
    $brand_id=$_POST['brand'];
    $product_description=mysqli_real_escape_string($conn,$_POST['specs']);

    $product_image=$_FILES['image']['name'];
    $product_image_tmp=$_FILES['image']['tmp_name'];

    move_uploaded_file($product_image_tmp,"./product-images/$product_image");

    $insert_product="insert into products(name,price,stock,category_id,brand_id,image,description,date) values('$product_name',$product_price,$product_stock,$category_id,$brand_id,'$product_image','$product_description',NOW())";
    $result=mysqli_query($conn,$insert_product);
    if($result){
        echo "<script>
            Swal.fire({
                icon: 'success',
                title:'Success',
                text: 'Product has been inserted successfully',
                width:400,
                timer:1800,
                showConfirmButton:false
              })
            </script>";
    }
}
?>

<div class="add-products">
    <center>
        <h2>Add Products</h2>
    </center>
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="name">Product Name: </label><br>
            <input type="text" name="name" id="name" autocomplete="off" spellcheck="false" autofocus required>
        </div>
        <div>
            <label for="price">Product Price: </label><br>
            <span class="price-input"><input type="number" name="price" id="price" placeholder="0" required></span>
        </div>
        <div>
            <label for="stock">Product Stock: </label><br>
            <span class="stock"><input type="number" name="stock" id="stock" placeholder="0" required></span>
        </div>
        <div>
            <label for="category-select">Select a Category: </label><br>
            <select name="category" id="category-select" class="category-select">
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
        <div>
            <label for="brand-select">Select a Brand: </label><br>
            <select name="brand" id="brand-select" class="brand-select">
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
        </div>
        <div>
            <label for="image">Product Image: </label><br>
            <input type="file" name="image" id="image" accept="image/png" required>
        </div>
        <div>
            <label for="specs">Product Description: </label><br>
            <textarea name="specs" id="specs" cols="30" rows="10" autocomplete="off" spellcheck="false" required></textarea>
        </div>
        <input type="submit" name="add-product">
    </form>
    <img src="../images/laptop-2.png" width="300px" alt="">
</div>