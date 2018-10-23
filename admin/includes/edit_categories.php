<?php
$cat_id = $_GET['update'];
$selectQuery = "SELECT * FROM categories WHERE cat_id = $cat_id";
$cat_result = mysqli_query($con, $selectQuery);
if(!$cat_result){
    die("Select did not work -> " . mysqli_error($con));
}
$row = mysqli_fetch_assoc($cat_result);


if(isset($_POST['edit_cat'])){
    $editQuery = "UPDATE categories SET cat_title = '{$_POST['cat_title']}' WHERE cat_id = {$cat_id}";
    $result = mysqli_query($con, $editQuery);
    if(!$result){
        die("Select did not work -> " . mysqli_error($con));
    }
    header("Location: categories.php");
}
?>

   

   
<form action="" method="post">
    <div class="form-group">
       <label for="cat_title">Update Category</label>
           <input value="<?php echo $row['cat_title'];?>" class='form-control' type='text' name='cat_title'>                                
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_cat" value="Update Category">
    </div>
</form>