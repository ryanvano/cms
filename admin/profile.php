<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

                                                    
        <!-- Navigation -->
<?php include "includes/admin_navigation.php";?>

   
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Profile Management</small>
                        </h1>
                        <?php
                        if(isset($_POST['update_profile'])){
                        //    $post_image = $_FILES['post_image']['name'];
                        //    $post_image_temp = $_FILES['post_image']['tmp_name'];
                        //    if(empty($post_image)){
                        //        $post_image = $row['post_image'];
                        //    }
                        //    move_uploaded_file($post_image_temp, "../images/{$post_image}");
                            if (!empty($_POST['user_password'])){
                                $hashPassword = password_hash($_POST['user_password'],PASSWORD_BCRYPT);
                                $query = "UPDATE users SET user_name = ?, user_password = ?, user_fname = ?, user_lname = ?, user_email = ? WHERE user_id = ?";
                                $stmt2 = mysqli_prepare($con, $query);
                                mysqli_stmt_bind_param($stmt2, "sssssi", $_POST['user_username'], $hashPassword, $_POST['user_fname'],$_POST['user_lname'], $_POST['user_email'], $_SESSION['user_id']);
                                
                            } else {
                                $hashPassword = null;
                                $query = "UPDATE users SET user_username = ?, user_fname = ?, user_lname = ?, user_email = ? WHERE user_id = ?";
                                $stmt2 = mysqli_prepare($con, $query);
                                mysqli_stmt_bind_param($stmt2, "sssss", $_POST['user_username'], $_POST['user_fname'], $_POST['user_lname'], $_POST['user_email'], $_SESSION['user_id']);

                            }
                            
                            mysqli_stmt_execute($stmt2);


                        //    move_uploaded_file($post_image_temp, "../images/$post_image");
                        //    $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_counts,post_status) ";
                        //    $query .= "VALUES({$_POST['post_category_id']},'{$_POST['post_title']}','{$_POST['post_author']}',now(), 'images/{$post_image}','{$_POST['post_content']}','{$_POST['post_tags']}',4,'{$_POST['post_status']}')";
                        //    $results = mysqli_query($con,$query);
                        //    confirm($results);

                        }
                        
                        
                                                
                        $stmt = mysqli_prepare($con, "SELECT user_username, user_fname, user_lname, user_email FROM users WHERE user_id = ?");
                        mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $user_username, $user_fname, $user_lname, $user_email);
                        mysqli_stmt_fetch($stmt);
                        ?>

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="user_username">Username</label>
                                <input value="<?php echo $user_username ?>" type="text" class="form-control" name="user_username">
                            </div>
                            <div class="form-group">
                                <label for="user_password">Password</label>
                                <input value="" type="password" class="form-control" name="user_password">
                            </div>
                            <div class="form-group">
                                <label for="user_fname">First Name</label>
                                <input value="<?php echo $user_fname ?>" type="text" class="form-control" name="user_fname">
                            </div>
                            <div class="form-group">
                                <label for="user_lname">Last Name</label>
                                <input value="<?php echo $user_lname ?>" type="text" class="form-control" name="user_lname">
                            </div>
                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input value="<?php echo $user_email ?>" type="text" class="form-control" name="user_email">
                            </div>
                            <div class="form-group">
                                <label for="post_image">Post Image</label>
                                <input type="file" name="post_image">
                            </div>
                            <div class="form-group">
                                <input class=" btn btn-primary" type="submit" name="update_profile" value="Update Profile">
                            </div>
                        </form>
                      
 
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>
