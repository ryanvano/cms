            <!-- Header -->
<?php include "includes/header.php"; ?>

           
            <!-- Top Navigation -->
<?php include "includes/navigation.php"; ?>
   
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                if(isset($_POST['create_comment'])){
                    $query = "INSERT INTO comments(comment_post_id, comment_author, Comment_email, comment_content, comment_status, comment_date) ";
                    
                    $query .= sprintf("VALUES('%s', '%s', '%s', '%s', 'pending', now())",
                                    escape($_GET['p_id']),
                                    escape($_POST['comment_author']),
                                    escape($_POST['comment_email']),
                                    escape($_POST['comment_content']));
                    if(!empty($_POST['comment_author']) && !empty($_POST['comment_email']) && !empty($_POST['comment_content'])){
                        $results = mysqli_query($con,$query);
                        confirm($results);
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>Comment Fields Can Not Be Empty</div>";
                    }
                }
                  ?>

                <?php 
                if($_SESSION['role'] == "admin"){
                    $query = "SELECT posts.*, users.user_username FROM posts INNER JOIN users ON posts.post_author = users.user_id WHERE post_id = {$_GET['p_id']}";
                } else {
                    $query = "SELECT posts.*, users.user_username FROM posts INNER JOIN users ON posts.post_author = users.user_id WHERE post_status='published' AND post_id = {$_GET['p_id']}";
                }

                
                $selectAllPosts = mysqli_query($con,$query);
                while($row = mysqli_fetch_assoc($selectAllPosts)){
                    $post_title = escape($row['post_title']);
                    $post_author = escape($row['user_username']);
                    $post_date = escape($row['post_date']);
                    $post_image = escape($row['post_image']);
                    $post_content = escape($row['post_content']);
                ?>    
                <h1 class="page-header">
                    <?php echo $post_title; ?>
                    <small><br>by <a href="index.php"><?php echo $post_author; ?></a></small>
                </h1>

                <!-- First Blog Post -->
 
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="<?php echo $post_image;?>">
                <hr>
                <p><?php echo $post_content; ?></p>

                
                <?php 
                postViewInc(escape($_GET['p_id'])); 
                ?>  
                   


                <hr>
                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                           <label for="comment_author">Your Name</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                           <label for="comment_email">Your Email Address</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                           <label for="">Your Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="create_comment" value="Publish Comment">
                        </div>
                    </form>
                </div>

                <hr>

                <!-- Comment Query -->
                <?php 
                
                $commentQuery="SELECT * FROM comments WHERE comment_post_id = {$_GET['p_id']} ";
                $commentQuery .= "AND comment_status = 'Approved' ";
                $commentQuery .= "ORDER BY comment_id DESC";
                $results = mysqli_query($con,$commentQuery);
                confirm($results);
                while ($crow = mysqli_fetch_assoc($results)){
                    ?>
                    <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $crow['comment_author']; ?>
                            <small><?php echo $crow['comment_date']; ?></small>
                        </h4>
                        <?php echo $crow['comment_content']; ?>
                    </div>
                </div>
                   <?php
                    
                }
                
                
                }
                ?>

                <!-- Comment -->
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>