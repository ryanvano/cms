<?php include "db.php"; ?>
<?php include "function.php";?>
<?php session_start();?>


<?php 

if(isset($_POST['login'])){
    loginUser($_POST['username'], $_POST['password']);
}
?>