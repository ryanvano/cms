            <!-- Header -->
<?php include "includes/header.php"; ?>

           
            <!-- Top Navigation -->
<?php include "includes/navigation.php"; ?>
<?php
    $c_id=escape($_GET['category']);
    $postCountQuery = "SELECT * FROM posts WHERE post_status='published' AND post_category_id = '$c_id'";
    $postCountResults = mysqli_query($con, $postCountQuery);
    confirm($postCountResults);
    $postCount = mysqli_num_rows($postCountResults);
    $postPerPage = $config['paginationLength'];
    $pageCount = ceil($postCount/$postPerPage);
?>
   
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">  
                <h1 class="page-header">
                    Welcome to the best CMS<br>
                    <small>We do what we can</small>
                </h1>
                
                <!-- First Blog Post -->
                <?php
                $page = 1;
                if(isset($_GET['page'])){
                    $startPost = (escape($_GET['page'])*$postPerPage)-$postPerPage;
                    $page = escape($_GET['page']);
                } else {$startPost = 0;}
                
                $query = "SELECT posts.*, users.user_username FROM posts LEFT JOIN users ON posts.post_author = users.user_id WHERE post_status = 'published' AND post_category_id= {$c_id} LIMIT {$startPost}, {$postPerPage}";
                
                $selectAllPosts = mysqli_query($con,$query);
                confirm($selectAllPosts);
                if($selectAllPosts->num_rows === 0)
                {
                    echo '<h1 class="text-center">No results</h1>';
                }
                while($row = mysqli_fetch_assoc($selectAllPosts)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['user_username'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'],0,175);
                ?>  
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="users_posts.php?u_id=<?php echo $row['post_author']?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                    <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="<?php echo $post_image;?>"></a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id;?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                
                <?php } ?>   
                   


                <hr>


            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/pagination.php"; ?>
<?php include "includes/footer.php"; ?>