<?php 
include('../includes/connect.php');
?>
<div class="view-orders">
  <center>
    <h2>View Orders</h2>
  </center>
  <table>
    <tr>
      <th>ID</th>
      <th>User Name</th>
      <th>Product Image</th>
      <th>Product Name</th>
      <th>Quantity Bought</th>
      <th>Amount Paid</th>
      <th>Order Date</th>
    </tr>
    <?php 
    $all_orders="select * from orders where user_id not in (1)";
    $execute_query=mysqli_query($conn,$all_orders);

    while($row=mysqli_fetch_assoc($execute_query)){
        $order_id=$row['id'];
        $user_id=$row['user_id'];
        $product_id=$row['product_id'];
        $quantity=$row['quantity'];
        $order_date=$row['order_date'];

        $select_user="select * from users where id=$user_id";
        $result_user=mysqli_query($conn,$select_user);
        $user_name=mysqli_fetch_assoc($result_user)['name'];

        $select_product="select * from products where id=$product_id";
        $result_product=mysqli_query($conn,$select_product);
        $product=mysqli_fetch_assoc($result_product);

        $product_image=$product['image'];
        $product_name=$product['name'];
        $price=$product['price'];
        $amount_paid=$price*$quantity;
   
        echo "
        <tr>
            <td>$order_id</td>
            <td>$user_name</td>
            <td>
                <center>
                    <img src='product-images/$product_image' width='100px'>
                </center>
            </td>
            <td id='pname'>$product_name</td>
            <td>$quantity</td>
            <td>₹$amount_paid/-</td>
            <td class='order-date'><i class='fa-regular fa-calendar'></i>  $order_date</td>
        </tr>"; 

    }
    ?>
  </table>
</div>