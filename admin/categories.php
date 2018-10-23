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
                            <small>Category Management</small>
                        </h1>
                        
                        <div class="col-xs-6">
                            <form action="" method="post">
                                <div class="form-group">
                                   <label for="cat_title">Add Category</label>
                                   <input class="form-control" type="text" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="add_category" value="Add Category">
                                </div>
                            </form>
                            <?php insert_categories (); ?>
                            <?php //EDIT category with update
                                if(isset($_GET['update'])){
                                    include "includes/edit_categories.php";
                                }
                            ?>
                            
                        </div>
                        <div class="col-xs-6">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                        <th>Post Count</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php selectAllCategories(); //LIST all categories in grid?>
                                    
                                </tbody>
                            </table>
                        </div>
                        <?php
                            if(isset($_POST['remove'])){
                                deleteRecord('categories', 'cat_id', $_POST['cat_id']);
                                header("Location: categories.php");
                            }
                        ?>
                        <div class="col-xs-12">
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                        </div>
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
