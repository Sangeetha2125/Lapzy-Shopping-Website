<?php
include('../includes/connect.php'); 

if(isset($_POST['add-category']))
{
    $category_name=$_POST['name'];
    $select_categories="select * from categories where name='$category_name'";
    $result_select=mysqli_query($conn,$select_categories);
    $repeat_count=mysqli_num_rows($result_select);
    
    if($repeat_count>0)
    {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title:'Failure',
            text: 'Category is already inserted', 
            width:400,
            timer:1800,
            showConfirmButton:false    
        })
        </script>";
    }
    else
    {
        $insert_category="insert into categories(name) values('$category_name')";
        $result=mysqli_query($conn,$insert_category);
        if($result)
        {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title:'Success',
                text: 'Category has been inserted successfully',
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
        <h2>Add Categories</h2>
    </center>
    <form action="" method="post">
        <div>
            <label for="name">Category Name: </label><br>
            <input type="text" name="name" id="name" autocomplete="off" spellcheck="false" autofocus required>
        </div>
        <input type="submit" name="add-category">
    </form>
</div>