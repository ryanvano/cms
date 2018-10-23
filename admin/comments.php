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
                            <small>Comment Management</small>
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
                                header("Location: comments.php");
                                break;
                                
                                case "decline_comment";
                                declineComment($_GET['c_id']);
                                header("Location: comments.php");
                                break;
                                
                                case "delete_comment";
                                deleteRecord('comments', 'comment_id', $_GET['c_id']);
                                header("Location: comments.php");
                                break;
                                
                            default:
                                include("includes/view_all_comments.php");
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
