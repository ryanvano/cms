    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./">Ryan's CMS</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                <?php //category top menus
                    $query = "SELECT * FROM categories";
                    $selectAllCategories = mysqli_query($con,$query);
                    while($row = mysqli_fetch_assoc($selectAllCategories)){
                        $catClass = "";
                        if(isset($_GET['category']) && $_GET['category'] == $row['cat_id']){
                            $catClass = "class='active'";
                        }
                        echo "<li $catClass><a href='category.php?category={$row['cat_id']}'>{$row['cat_title']}</a></li>";
                    }
                ?>
                </ul>
                <ul class="nav navbar-right navbar-nav">
                <?php //right top menus
                    if(!aRole()){
                        if($_SERVER['PHP_SELF'] == "/cms/registration.php"){
                            echo "<li class='active'><a href='registration.php'>Registration</a></li>";
                        } else {
                            echo "<li><a href='registration.php'>Registration</a></li>";
                        }
                    }
                    if($_SERVER['PHP_SELF'] == "/cms/contact.php"){
                        echo "<li class='active'><a href='contact.php'>Contact</a></li>";
                    } else {
                        echo "<li><a href='contact.php'>Contact</a></li>";
                    }
                    //show and hide admin and edit post based on being an admin
                 ?>   
                    
                    <?php if(!aRole()): ?>
                        <li><a href='user_login.php'>Login</a></li>
                    <?php else: ?>
                        <li><a href='/cms/includes/logout.php'>Logout</a></li>
                    <?php endif;
                    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
                        if(isset($_GET['p_id'])){
                            echo "<li><a href='admin/posts.php?source=edit_post&p_id={$_GET['p_id']}'>Edit Post</a></li>";
                        }
                        echo "<li><a href='admin'>Admin</a></li>";
                    }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
