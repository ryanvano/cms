<?php
if(isset($_POST['create_post'])){
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    move_uploaded_file($post_image_temp, "../images/$post_image");
    $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status) ";
    $query .= "VALUES({$_POST['post_category_id']},'{$_POST['post_title']}','{$_POST['post_author']}',now(), '{$post_image}','{$_POST['post_content']}','{$_POST['post_tags']}','{$_POST['post_status']}')";
    $results = mysqli_query($con,$query);
    confirm($results);
    $i = mysqli_insert_id($con);
    echo "<p class='bg-success'>Post Created <a href='../post.php?p_id={$i}'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";

}
//date('d-m-y');
?>
   

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
        <label for="post_category_id">Post Category</label>
        <select name="post_category_id" id="post_category">
           <?php
                $query = "SELECT * FROM categories";
                $selectCategories = mysqli_query($con,$query);
                confirm($selectCategories);
                echo "<option disabled selected name='' value=''>Select Category</option>";
               while ($catRow = mysqli_fetch_assoc($selectCategories)){
                   echo "<option name='post_category_id' value='{$catRow['cat_id']}'> {$catRow['cat_title']}</option>";
               }
               ?>   
        </select>
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="post_status">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
<!--        <input type="text" class="form-control" name="post_status">-->
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <select name="post_author">
           <?php
                $query = "SELECT * FROM users";
                $selectUsers = mysqli_query($con,$query);
                confirm($selectUsers);
                echo "<option disabled selected name='' value=''>Select Author</option>";
               while ($userRow = mysqli_fetch_assoc($selectUsers)){
                   echo "<option name='post_author' value='{$userRow['user_id']}'> {$userRow['user_username']}</option>";
               }
               ?>   
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>
    <div class="form-group">
        <label for="post_tages">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input class=" btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
</form>


