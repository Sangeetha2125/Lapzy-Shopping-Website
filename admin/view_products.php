<?php 
include('../includes/connect.php');
?>
<div class="view-products">
  <center>
    <h2>View Products</h2>
  </center>
  <table>
    <tr>
      <th>ID</th>
      <th>Product Image</th>
      <th>Product Name</th>
      <th>Product Price</th>
      <th>Category</th>
      <th>Brand</th>
      <th>Stocks Available</th>
    </tr>
    <?php 
    $all_products="select * from products";
    $execute_query=mysqli_query($conn,$all_products);
    while($row=mysqli_fetch_assoc($execute_query)){
      $product_id=$row['id'];
      $product_image=$row['image'];
      $product_name=$row['name'];
      $product_price=$row['price'];
      $product_stock=$row['stock'];
      $product_category_id=$row['category_id'];
      $product_brand_id=$row['brand_id'];

      $brand="select * from brands where id=$product_brand_id";
      $brand_result=mysqli_query($conn,$brand);
      $brand_name=mysqli_fetch_assoc($brand_result)['name'];

      $category="select * from categories where id=$product_category_id";
      $category_result=mysqli_query($conn,$category);
      $category_name=mysqli_fetch_assoc($category_result)['name'];

      echo "
      <tr>
        <td>$product_id</td>
        <td><img src='product-images/$product_image' width='100px'></td>
        <td id='pname'>$product_name</td>
        <td>₹$product_price/-</td>
        <td>$category_name</td>
        <td>$brand_name</td>
        <td>$product_stock</td>
      </tr>
      ";

    }
    ?>
  </table>
</div>