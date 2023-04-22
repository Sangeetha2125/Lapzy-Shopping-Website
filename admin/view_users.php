<?php 
include('../includes/connect.php');
?>
<div class="view-users">
  <center>
    <h2>View Users</h2>
  </center>
  <table>
    <tr>
      <th>ID</th>
      <th>User Name</th>
      <th>Email Id</th>
    </tr>
    <?php 
    $all_users="select * from users";
    $execute_query=mysqli_query($conn,$all_users);
    while($row=mysqli_fetch_assoc($execute_query)){
      $user_id=$row['id'];
      $user_name=$row['name'];
      $user_email=$row['email'];

      echo "
      <tr>
        <td>$user_id</td>
        <td>$user_name</td>
        <td>$user_email</td>
      </tr>
      ";

    }
    ?>
  </table>
</div>