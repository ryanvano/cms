<?php


function confirm($results){
    global $con;    
    if(!$results){
    die("<br>boom -> " . mysqli_error($con));
    }
}
function insert_categories (){
    global $con;
    if($_SESSION['role'] <> "admin"){return;}
    if(isset($_POST['add_category'])){
        $new_title = $_POST['cat_title'];
        if ($new_title == "" || empty($new_title)){
            echo "This field should not be empty";
        } else {
            $stmt = mysqli_prepare($con, "INSERT INTO categories (cat_title) VALUE (?)");
            $stmt->bind_param("s", $new_title);
            $stmt->execute();
        }
    }                            
}

function selectAllCategories() {
    global $con;
    $query = "SELECT * FROM categories";
    $selectCategories = mysqli_query($con,$query);
    while($row = mysqli_fetch_assoc($selectCategories)){
        echo "<tr>";
        echo "<td>{$row['cat_id']}</td>";
        echo "<td>{$row['cat_title']}</td>";
        echo "<td>" . recordCount('posts', 'post_category_id',$row['cat_id']) . "</td>";
        echo "<td>";
        ?>
        <form method="post">
            <input type="hidden" name="cat_id" value="<?php echo $row['cat_id'];?>">
            <button type="submit" name="remove" style='width: 65px' class="btn btn-danger">Delete</button>
        </form>
        <?php 
        echo "<a style='width: 65px' class='btn btn-info' href='categories.php?update={$row['cat_id']}'>Edit</a></td>";
        echo "</tr>";
    }
}

function deleteRecord($table, $column, $condition){
    global $con;
    if($_SESSION['role'] <> "admin"){return;}
    $query = "DELETE FROM {$table} WHERE {$column} = ?";
    $stmt = mysqli_prepare($con, $query);
    $stmt->bind_param("s", $condition);
    $stmt->execute();
    header("Location: /admin/posts.php");

}

function approveComment($id){
    global $con;
    if($_SESSION['role'] <> "admin"){return;}
    $approveComment = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = ";
    $approveComment .= mysqli_real_escape_string($con,$id);
    $result = mysqli_query($con, $approveComment);
    confirm($result);
 }

function declineComment($id){
    global $con;
    if($_SESSION['role'] <> "admin"){return;}
    $declineComment = "UPDATE comments SET comment_status = 'Declined' WHERE comment_id = ";
    $declineComment .= mysqli_real_escape_string($con,$id);
    $result = mysqli_query($con, $declineComment);
    confirm($result);
}

function clearPostView($pid){
    global $con;
    if($_SESSION['role'] <> "admin"){return;}
    $clearCount = "UPDATE posts SET post_views = 0 WHERE post_id = {$pid}";
    $result = mysqli_query($con, $clearCount);
    confirm($result);  
    header("Location: posts.php");
}

function adminOnline($who){
    global $config;
    global $con;
    $session=session_id();
    $time=time();
    $expireTime = time() + $config['adminOnline'];
    $sessionQuery = mysqli_query($con,"SELECT * FROM user_online WHERE online_session = '{$session}'");
    confirm($sessionQuery);
    $count = mysqli_num_rows($sessionQuery);
    if($count == null) {
        $query = "INSERT INTO user_online (online_session, online_time, online_role) VALUES ('{$session}','{$expireTime}', '{$_SESSION['role']}')";
        mysqli_query($con,$query);

    } else {
        mysqli_query($con,"UPDATE user_online SET online_time='$expireTime', online_role='{$_SESSION['role']}' WHERE online_session = '$session'");
    }
    $onlineAdmin = mysqli_query($con,"SELECT * FROM user_online WHERE online_time > $time AND online_role='$who'");

    confirm($onlineAdmin);
    return $onlineCount = mysqli_num_rows($onlineAdmin);    
}

function escape($string){
    global $con;
    return mysqli_real_escape_string($con, trim($string));
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

function isLoggedIn($role){
    global $config;
    if($_SESSION['role'] == null){
        header("Location: ../index.php");
    } 
    if($_SESSION['adminTimeOut'] < time()){
        header("Location: ../index.php");
        $_SESSION['role']=null;
    } else {$_SESSION['adminTimeOut'] = time() + $config['adminTimeOut'];
    }
    if($role == $_SESSION['role']){
        return true;
    }  
}

function ifItIsMethod($method=null){
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
        return true;
    }
    return false;
    
}


// should be able to remove as these were all refactored into countRecord()
//function postCount($status){
//    global $con;
//    $postCount = "SELECT * FROM posts where post_status = '{$status}'";
//    $result = mysqli_query($con, $postCount);
//    confirm($result); 
//    return($postCount = mysqli_num_rows($result));
//}

//function commentPendingCount(){
//    global $con;
//    $commentPendingCount = "SELECT * FROM comments where comment_status = 'pending'";
//    $result = mysqli_query($con, $commentPendingCount);
//    confirm($result); 
//    return($commentPendingCount = mysqli_num_rows($result));
//}
//
//function userPendingCount(){
//    global $con;
//    $userPendingCount = "SELECT * FROM users where user_role = 'pending'";
//    $result = mysqli_query($con, $userPendingCount);
//    confirm($result); 
//    return($userPendingCount = mysqli_num_rows($result));
//}
//function commentCount($pid){
//    global $con;
//    if(!$pid){
//        $commentCount = "SELECT * FROM comments ";
//    } else {
//        $commentCount = "SELECT * FROM comments WHERE comment_post_id = {$pid}";
//    }
//    $result = mysqli_query($con, $commentCount);
//    confirm($result); 
//    return(mysqli_num_rows($result));
//}



//function deleteCategory(){
//    global $con;
//    if($_SESSION['role'] <> "admin"){return;}
//    if(isset($_GET['delete'])){
//        $deleteQuery = "DELETE FROM categories WHERE cat_id = ";
//        $deleteQuery = $deleteQuery . $_GET['delete'];
//        $result = mysqli_query($con, $deleteQuery);
//        if(!$result){
//            die("Delete did not work -> " . mysqli_error($con));
//        }
//    header("Location: categories.php");
//    }
//}

//function deletePost($id){
//    global $con;
//    if($_SESSION['role'] <> "admin"){return;}
//    $deletePost = "DELETE FROM posts WHERE post_id = ";
//    $deletePost .= mysqli_real_escape_string($con,$id);
//    $result = mysqli_query($con, $deletePost);
//    confirm($result);
//    header("Location: posts.php");
//
//}
//
//function deleteComment($id){
//    global $con;
//    if($_SESSION['role'] <> "admin"){return;}
//    $deleteComment = "DELETE FROM comments WHERE comment_id = ";
//    $deleteComment .= mysqli_real_escape_string($con,$id);
//    $result = mysqli_query($con, $deleteComment);
//    confirm($result);
//}


//function deleteUser($id){
//    global $con;
//    if($_SESSION['role'] <> "admin"){return;}
//
//    $deleteComment = "DELETE FROM users WHERE user_id = ";
//    $deleteComment .= mysqli_real_escape_string($con,$id);
//    $result = mysqli_query($con, $deleteComment);
//    confirm($result);
//    header("Location: users.php");
//
//}

?>