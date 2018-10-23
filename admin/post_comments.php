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
                            <small>Post Comment Management</small>
                        </h1>
                        <?php
                        if(isset($_GET['source'])){
                            $action = $_GET['source'];
                        } else {
                            $action = "";
                        } 
                        switch($action){
                                case "approve_comment";
                                approveComment($_GET['c_id']);
                                header("Location: post_comments.php?p_id={$_GET['p_id']}");
                                break;
                                
                                case "decline_comment";
                                declineComment($_GET['c_id']);
                                header("Location: post_comments.php?p_id={$_GET['p_id']}");
                                break;
                                
                                case "delete_comment";
                                deleteComment($_GET['c_id']);
                                header("Location: post_comments.php?p_id={$_GET['p_id']}");
                                break;
                                
                            default:
                                include("includes/view_post_comments.php");
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
