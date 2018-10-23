<?php
$query = "SELECT * FROM users WHERE user_id = {$_GET['u_id']}";
$selectUser = mysqli_query($con,$query);
confirm($selectUser);
$row = mysqli_fetch_assoc($selectUser);




if(isset($_POST['edit_user'])){
//    $post_image = $_FILES['post_image']['name'];
//    $post_image_temp = $_FILES['post_image']['tmp_name'];
//    if(empty($post_image)){
//        $post_image = $row['post_image'];
//    }
//    move_uploaded_file($post_image_temp, "../images/{$post_image}");
    if (!empty($_POST['user_password'])){
        $hashPassword = password_hash($_POST['user_password'],PASSWORD_BCRYPT);
    } else {$hashPassword=null;}
    
    $editQuery = "UPDATE users SET ";
    $editQuery .= "user_username = '{$_POST['user_username']}', ";
    if ($hashPassword <> null){$editQuery .= "user_password = '{$hashPassword}', ";}
    $editQuery .= "user_fname = '{$_POST['user_fname']}', ";
    $editQuery .= "user_lname = '{$_POST['user_lname']}', ";
    $editQuery .= "user_email = '{$_POST['user_email']}', ";
    $editQuery .= "user_role = '{$_POST['user_role']}' ";
    $editQuery .= "WHERE user_id = {$_GET['u_id']}";
    $updateUser = mysqli_query ($con, $editQuery);
    confirm($updateUser);
    header("Location: users.php");
    
//    move_uploaded_file($post_image_temp, "../images/$post_image");
//    $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_counts,post_status) ";
//    $query .= "VALUES({$_POST['post_category_id']},'{$_POST['post_title']}','{$_POST['post_author']}',now(), 'images/{$post_image}','{$_POST['post_content']}','{$_POST['post_tags']}',4,'{$_POST['post_status']}')";
//    $results = mysqli_query($con,$query);
//    confirm($results);

}
?>
   
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_username">Username</label>
        <input value="<?php echo $row['user_username'] ?>" type="text" class="form-control" name="user_username">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input value="" type="password" class="form-control" name="user_password">
    </div>
    <div class="form-group">
        <label for="user_fname">First Name</label>
        <input value="<?php echo $row['user_fname'] ?>" type="text" class="form-control" name="user_fname">
    </div>
    <div class="form-group">
        <label for="user_lname">Last Name</label>
        <input value="<?php echo $row['user_lname'] ?>" type="text" class="form-control" name="user_lname">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input value="<?php echo $row['user_email'] ?>" type="text" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="user_role">Role</label>
        <select name="user_role" id="user_role">
            <option value="admin">Admin</option>
            <option <?php if($row['user_role']=='contributor'){echo "selected";} ?>  value="contributor">Contributor</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>
    <div class="form-group">
        <input class=" btn btn-primary" type="submit" name="edit_user" value="Edit User">
    </div>
</form>