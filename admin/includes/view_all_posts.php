
<?php 
if(isset($_POST['remove'])){
    deleteRecord('posts', 'post_id', $_POST['post_id']);
}

if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $checkBoxValue){
        switch($_POST['bulkOptions']){
            case 'publish':
                $editQuery = "UPDATE posts SET ";
                $editQuery .= "post_status = 'published' ";
                $editQuery .= "WHERE post_id = $checkBoxValue"; 
                $updatePost = mysqli_query ($con, $editQuery);
                confirm($updatePost);
                break;
                
            case 'draft':
                $editQuery = "UPDATE posts SET ";
                $editQuery .= "post_status = 'draft' ";
                $editQuery .= "WHERE post_id = $checkBoxValue"; 
                $updatePost = mysqli_query ($con, $editQuery);
                confirm($updatePost);
                break;    
                
            case 'delete':
                $editQuery = "DELETE FROM posts ";
                $editQuery .= "WHERE post_id = $checkBoxValue"; 
                $updatePost = mysqli_query ($con, $editQuery);
                confirm($updatePost);
                break; 
                
            case 'clone':
                $getQuery = "SELECT * FROM posts where post_id={$checkBoxValue}";
                $getPost = mysqli_query ($con, $getQuery);
                confirm($getPost);
                $row = mysqli_fetch_assoc($getPost);
                
                
                $editQuery = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
                $editQuery .= "VALUES({$row['post_category_id']}, '{$row['post_title']}', '{$row['post_author']}', now(),  '{$row['post_image']}', '{$row['post_content']}', '{$row['post_tags']}', '{$row['post_status']}') ";
                $addPost = mysqli_query ($con, $editQuery);
                confirm($addPost);
                break;      
                
            default:
                echo "Select a Bulk Option";
                break;
        }
    }
}


?>
    

    
    <form action="" method="post">
       <div id="bulkOptionsContainer" class="col-xs-4">
          <select class="form-control" name="bulkOptions" id="">
              <option value="">Select Option</option>
              <option value="publish">Publish</option>
              <option value="draft">Draft</option>
              <option value="clone">Clone</option>
              <option value="delete">Delete</option>
          </select>
       </div>
       <div class="col-xs-4">
           <input type="submit" name="submit" class="btn btn-success" value="Apply">
           <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
       </div>

    <table class="table table-bordered table-hover">
       
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllBoxes"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Views</th>
                <th>Date</th> 
                <th>Update</th> 
            </tr>
        </thead>
        <tbody>
            <?php 
            //$query = "SELECT * FROM posts";
            $query = "SELECT posts.*, categories.cat_title, categories.cat_id, users.user_username FROM posts LEFT JOIN categories ON posts.post_category_id = categories.cat_id LEFT JOIN users ON posts.post_author = users.user_id ORDER By post_id DESC";
            $selectPost = mysqli_query($con,$query);
            confirm($selectPost);
            while($row = mysqli_fetch_assoc($selectPost)){
                $cc = recordCount('comments', 'comment_post_id' , $row['post_id']);
                //$cc = commentCount($row['post_id']);
                echo "<tr>";
                ?>
                <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?php echo $row['post_id'];?>'></td>
                <?php
                echo "<td>{$row['post_id']}</td>";
                echo "<td>{$row['user_username']}</td>";
                echo "<td><a href='../post.php?p_id={$row['post_id']}'>{$row['post_title']}</a></td>";
                echo "<td><a href='../category.php?category={$row['cat_id']}'>{$row['cat_title']}</a></td>";
                echo "<td>{$row['post_status']}</td>";
                echo "<td> <img width='100px' src='../images/{$row['post_image']}' alt='Really good post on {$row['post_image']}'></td>";
                echo "<td>{$row['post_tags']}</td>";
                echo "<td><a href='post_comments.php?p_id={$row['post_id']}'>{$cc}</a></td>";
                echo "<td>{$row['post_views']}<a href='posts.php?source=clear_count&p_id={$row['post_id']}'> <i class='far fa-minus-square fa-lg'></i></a></td>";
                echo "<td>{$row['post_date']}</td>";
                echo "<td><a style='width: 65px' class='btn btn-info' href='posts.php?source=edit_post&p_id={$row['post_id']}'> Edit </a>";
                ?>
                
                <form method="post">
                    <input type="hidden" name="post_id" value="<?php echo $row['post_id'];?>">
                    <button type="submit" name="remove" style='width: 65px' class="btn btn-danger">Delete</button>
                </form>
                
                <?php
                echo "</tr>";
            }

            ?>
        </tbody>
    </table> 
    </form>