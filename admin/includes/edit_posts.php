<?php
if(isset($_POST['edit_post'])){
    if(!empty($_FILES['post_image']['name'])){
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];    
        move_uploaded_file($post_image_temp, "../images/{$post_image}");
        $editQuery = sprintf("UPDATE posts SET post_category_id = '%s', post_title = '%s', post_author = '%s', post_date = now(), post_image = '%s', post_content = '%s', post_tags = '%s', post_status = '%s' WHERE post_id = {$_GET['p_id']}",
                        escape($_POST['post_category_id']),
                        escape($_POST['post_title']),
                        escape($_POST['post_author']),
                        $post_image,
                        escape($_POST['post_content']),
                        escape($_POST['post_tags']),
                        escape($_POST['post_status'])
                        );
    } else {
        $editQuery = sprintf("UPDATE posts SET post_category_id = '%s', post_title = '%s', post_author = '%s', post_date = now(), post_content = '%s', post_tags = '%s', post_status = '%s' WHERE post_id = {$_GET['p_id']}",
                        escape($_POST['post_category_id']),
                        escape($_POST['post_title']),
                        escape($_POST['post_author']),
                        escape($_POST['post_content']),
                        escape($_POST['post_tags']),
                        escape($_POST['post_status'])
                        );
    }
//    $editQuery = "UPDATE posts SET ";
//    $editQuery .= "post_category_id = '{$_POST['post_category_id']}', ";
//    $editQuery .= "post_title = '{$_POST['post_title']}', ";
//    $editQuery .= "post_author = '{$_POST['post_author']}', ";
//    $editQuery .= "post_date = now(), ";
//    $editQuery .= "post_image = '{$post_image}', ";
//    $editQuery .= "post_content = '{$_POST['post_content']}', ";
//    $editQuery .= "post_tags = '{$_POST['post_tags']}', ";
//    $editQuery .= "post_status = '{$_POST['post_status']}' ";
//    $editQuery .= "WHERE post_id = {$_GET['p_id']}";
    $updatePost = mysqli_query ($con, $editQuery);
    confirm($updatePost);
    echo "<p class='bg-success'>Post Updated <a href='../post.php?p_id={$_GET['p_id']}'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";

}
$query = "SELECT * FROM posts WHERE post_id = {$_GET['p_id']}";
$selectPost = mysqli_query($con,$query);
confirm($selectPost);
$row = mysqli_fetch_assoc($selectPost);
?>
   

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php echo $row['post_title'] ?>" type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
        <label for="post_category_id">Post Category</label>
        <select name="post_category_id" id="post_category">
           <?php
                $query = "SELECT * FROM categories";
                $selectCategories = mysqli_query($con,$query);
                confirm($selectCategories);
               while ($catRow = mysqli_fetch_assoc($selectCategories)){
                   if ($row['post_category_id'] == $catRow['cat_id']) {
                       echo "<option selected name='post_category_id' value='{$catRow['cat_id']}'>{$catRow['cat_title']}</option>";
               } else {
                       echo "<option name='post_category_id' value='{$catRow['cat_id']}'> {$catRow['cat_title']}</option>";
                   }
               }
               ?>   
        </select>
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="post_status">
            <option value="draft">Draft</option>
            <option <?php if($row['post_status']=='published'){echo " selected ";}?>value="published">Published</option>
        </select>
<!--        <input value="<?php echo $row['post_status'] ?>" type="text" class="form-control" name="post_status">-->
    </div>
    <div class="form-group"> <!-- need to update the edit post to read the user ID-->
        <label for="post_author">Post Author</label>
        <select name="post_author">
           <?php
                $query = "SELECT * FROM users";
                $selectUsers = mysqli_query($con,$query);
                confirm($selectUsers);
               while ($userRow = mysqli_fetch_assoc($selectUsers)){
                   if($userRow['user_id']==$row['post_author']){
                    echo "<option selected name='post_author' value='{$userRow['user_id']}'> {$userRow['user_username']}</option>";
                   } else {
                       echo "<option name='post_author' value='{$userRow['user_id']}'> {$userRow['user_username']}</option>";
                   }
               }
               ?>   
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
        <img width="100" src="../images/<?php echo $row['post_image']; ?>">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $row['post_tags'] ?>" type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"><?php echo $row['post_content'] ?>
        </textarea>
    </div>
    <div class="form-group">
        <input class=" btn btn-primary" type="submit" name="edit_post" value="Update Post">
    </div>
</form>
