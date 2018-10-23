<?php
if(isset($_POST['add_user'])){
//    $post_image = $_FILES['post_image']['name'];
//    $post_image_temp = $_FILES['post_image']['tmp_name'];
//    move_uploaded_file($post_image_temp, "../images/$post_image");
    $hashPassword = password_hash($_POST['user_password'],PASSWORD_BCRYPT);
    $query = "INSERT INTO users(user_username, user_password, user_fname, user_lname, user_email, user_role) VALUES(?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);
    $stmt->bind_param("ssssss", $_POST['user_username'], $hashPassword, $_POST['user_fname'], $_POST['user_lname'], $_POST['user_email'], $_POST['user_role']);
    $stmt->execute();
    header("Location: users.php");


}
//date('d-m-y');
?>
   

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_username">Username</label>
        <input type="text" class="form-control" name="user_username">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="text" class="form-control" name="user_password">
    </div>
    <div class="form-group">
        <label for="user_fname">First Name</label>
        <input type="text" class="form-control" name="user_fname">
    </div>
    <div class="form-group">
        <label for="user_lname">Last Name</label>
        <input type="text" class="form-control" name="user_lname">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="user_role">Role</label>
        <select name="user_role" id="user_role">
            <option value="contributor">Select Role</option>
            <option value="admin">Admin</option>
            <option value="contributor">Contributor</option>

               <?php
               // $query = "SELECT * FROM categories";
               // $selectCategories = mysqli_query($con,$query);
               // confirm($selectCategories);
               //while ($catRow = mysqli_fetch_assoc($selectCategories)){
                //echo "<option name='post_category_id' value='{$catRow['cat_id']}'> {$catRow['cat_title']}</option>";
               //}
               ?>   

        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>
    <div class="form-group">
        <input class=" btn btn-primary" type="submit" name="add_user" value="Create User">
    </div>
</form>


