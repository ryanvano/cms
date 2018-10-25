<?php

function escape($string){
    global $con;
    return mysqli_real_escape_string($con, trim($string));
}

function confirm($results){
    global $con;  
    if(!$results){
    die("<br>boom -> " . mysqli_error($con));
    }
}

function postViewInc($p_id){
    global $con;
    $p_id = escape($p_id);
    $query = "UPDATE posts SET ";
    $query .= "post_views = post_views + 1 where post_id = $p_id";
    $results = mysqli_query($con,$query);
    confirm($results);
}

function visitorOnline(){ //indicates there are users online, this is viewed in the admin nav
    global $config;
    global $con;
    $session=session_id();
    $time=time();
    $expireTime = time() + $config['adminOnline'];
    $sessionQuery = mysqli_query($con,"SELECT * FROM user_online WHERE online_session = '{$session}'");
    confirm($sessionQuery);
    $count = mysqli_num_rows($sessionQuery);
    if($count == null) {
        $query = "INSERT INTO user_online (online_session, online_time, online_role) VALUES ('{$session}','{$expireTime}', 'visitor')";
        mysqli_query($con,$query);

    } else {
        $results = mysqli_query($con,"UPDATE user_online SET online_time='$expireTime', online_role='visitor' WHERE online_session = '$session'");
        confirm($results);
    }
    $onlineUsers = mysqli_query($con,"SELECT * FROM user_online WHERE online_time > $time");
    confirm($onlineUsers);
 
}

function recordCount($tableName, $column, $condition) {
    global $con;
    $count = "SELECT * FROM {$tableName} ";
    if($column <> null){
        $count .= "WHERE $column = '$condition'";
    }
    $result = mysqli_query($con, $count);
    confirm($result); 
    return mysqli_num_rows($result);
}

function loginUser($username, $userpassword){
    global $con;
    $username = escape($username);
    $userpassword = escape($userpassword);
    $check_cred = "SELECT * FROM users WHERE user_username = '{$username}'";
    $results = mysqli_query($con, $check_cred);
    confirm($results);
    $row = mysqli_fetch_assoc($results);
    $password = $row['user_password'];
    if(!password_verify($userpassword, $password)){
        session_unset();
        header("Location: ../index.php");
    } else {
        $_SESSION['username'] = $row['user_username'];
        $_SESSION['firstname'] = $row['user_fname'];
        $_SESSION['lastname'] = $row['user_lname'];
        $_SESSION['role'] = $row['user_role'];
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['adminTimeOut'] = time() + $config['adminTimeOut'];
       header("Location: /admin");
    }
}

function aRole(){
    if(isset($_SESSION['role'])){
        return true;
    }
    return false;
}
?>