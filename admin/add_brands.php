<?php
include('../includes/connect.php'); 

if(isset($_POST['add-brand']))
{
    $brand_name=$_POST['name'];
    $select_brands="select * from brands where name='$brand_name'";
    $result_select=mysqli_query($conn,$select_brands);
    $repeat_count=mysqli_num_rows($result_select);
    
    if($repeat_count>0)
    {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title:'Failure',
            text: 'Brand is already inserted', 
            width:400,
            timer:1800,
            showConfirmButton:false    
        })
        </script>";
    }
    else
    {
        $insert_brand="insert into brands(name) values('$brand_name')";
        $result=mysqli_query($conn,$insert_brand);
        if($result)
        {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title:'Success',
                text: 'Brand has been inserted successfully',
                width:400,
                timer:1800,
                showConfirmButton:false
              })
            </script>";
        }
    }
}
?>

<div class="add-products" method="post">
    <center>
        <h2>Add Brands</h2>
    </center>
    <form action="" method="post">
        <div>
            <label for="name">Brand Name: </label><br>
            <input type="text" name="name" id="name" autocomplete="off" spellcheck="false" autofocus required>
        </div>
        <input type="submit" name="add-brand">
    </form>
</div>