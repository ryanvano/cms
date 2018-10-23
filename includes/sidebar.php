            <div class="col-md-4">
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                       <form action="search.php" method="post">
                       <div class="input-group">
                        <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                           </div>
                        </form>
                    <!-- /.input-group -->
                </div>
                
                <!-- Login Well -->
                
                   <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "admin"): ?>
                        <div class="well">
                        <h4>Logged in as <?php echo $_SESSION['username'];?></h4>
                        <form action="includes/login.php" method="post">
                        <span class="input-group-btn">
                            <button name="login" class="btn btn-primary" type="submit">Logout</button>
                        </span>
                        </form>
                        </div>
                    <?php else: ?>
                       <div class="well">
                       <h4>Login</h4>
                       <form action="includes/login.php" method="post">
                       <div class="form-group">
                        <input name="username" type="text" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="input-group">
                        <input name="password" type="password" class="form-control" placeholder="Enter Password">
                        <span class="input-group-btn">
                            <button name="login" class="btn btn-primary" type="submit">Submit</button>
                        </span>
                        </div>
                        <div class="form-group">
                            <a href="forgot.php?forgot=<?php echo uniqid(true);?>">Forgot Password?</a>
                        </div>
                        </form>
                        </div>
                    <?php endif; ?>
                    <!-- /.input-group -->
                

                <!-- Blog Categories Well -->
                <?php
                    $query = "SELECT * FROM categories";
                    $selectAllCategoriesSidebar = mysqli_query($con,$query);
                ?>
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <?php 
                                while($row = mysqli_fetch_assoc($selectAllCategoriesSidebar)){
                                    echo "<li><a href='category.php?category={$row['cat_id']}'>{$row['cat_title']}</a></li>";
                                }
                                ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->

                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php"; ?>
                <?php include "widget.php"; ?>

            </div>