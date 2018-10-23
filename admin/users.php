<?php include "includes/admin_header.php"; ?>
<?php
if(!isLoggedIn('admin')){header("Location: index.php");}
?>
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
                            <small>User Management</small>
                        </h1>
                        <?php
                        if(isset($_GET['source'])){
                            $action = $_GET['source'];
                        } else {
                            $action = "";
                        } 
                        switch($action){
                                case "add_user";
                                include "includes/add_user.php";
                                break;
                                
                                case "edit_user";
                                include "includes/edit_user.php";
                                break;
                                
                                case "delete_user";
                                deleteRecord ('users', 'user_id', $_GET['u_id']);
                                header("Location: users.php");
                                //deleteUser($_GET['u_id']);
                                break;
                                
                            default:
                                include("includes/view_all_users.php");
                                break;
                        }
                        ?>
                      
 
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
