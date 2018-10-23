
<?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>

<?php
//$error[]='';

if(isset($_POST['submit'])){
    if(empty($_POST['username'])){$error[] = "Username can't be empty";}
    if(empty($_POST['password'])){$error[] = "Password can't be empty";}
    if(empty($_POST['email'])){$error[] = "Email can't be empty";}
    if(recordCount('users', 'user_username',$_POST['username'])>0){$error[] = "Username already exists";}
    if(recordCount('users', 'user_email',$_POST['email'])>0){$error[] = "Email already exists";}
    //print_r($error);
    if (isset($error)){
        echo "<div class='alert alert-danger text-center' role='alert'>";
        foreach($error as $value){
            echo $value . "<br>";
        }
        echo "</div>";
    } else {
        $password = escape($_POST['password']);
        $hash_password = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO users(user_username, user_password, user_email, user_role) ";
        $query .=sprintf("VALUES('%s', '%s', '%s', 'contributor')",
                        escape($_POST['username']),
                        $hash_password,
                        escape($_POST['email']));
        $results = mysqli_query($con,$query);
        confirm($results);
        if(!empty($results)){
            //echo "<div class='alert alert-success text-center' role='alert'>Your Registration Has Been Submitted</div>";
            loginUser(escape($_POST['username']), $password);
        }
        }
    



}







?>

    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" autocomplete="on" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" autocomplete="on" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>

<?php include "includes/footer.php";?>
