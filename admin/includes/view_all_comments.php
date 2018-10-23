<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Email</th>
            <th>Comment</th>
            <th>Status</th>
            <th>In Response To</th>
            <th>Date</th>
            <th>Edit</th> 
        </tr>
    </thead>
    <tbody>
        <?php 
        //$query = "SELECT * FROM comments";
        $query = "SELECT comments.*, posts.post_title FROM comments LEFT JOIN posts ON comments.comment_post_id = posts.post_id ORDER BY comment_id";

        $selectComment = mysqli_query($con,$query);
        confirm($selectComment);
        while($row = mysqli_fetch_assoc($selectComment)){
            echo "<tr>";
            echo "<td>{$row['comment_id']}</td>";
            echo "<td>{$row['comment_author']}</td>";
            echo "<td>{$row['comment_email']}</td>";
            echo "<td> <span style='word-break: break-word'>{$row['comment_content']}</span></td>";
            echo "<td>{$row['comment_status']}</td>";
            echo "<td><a href='../post.php?p_id={$row['comment_post_id']}'>{$row['post_title']}</a></td>";
            echo "<td>{$row['comment_date']}</td>";
            echo "<td><a style='width: 80px' class='btn btn-primary' href='comments.php?source=approve_comment&c_id={$row['comment_id']}'>Approve</a>";
            echo "<a style='width: 80px' class='btn btn-info' href='comments.php?source=decline_comment&c_id={$row['comment_id']}'>Decline</a>";
            ?>
            <form method="post">
               <input type="hidden" name="comment_id" value="<?php echo $row['comment_id'];?>">
               <input style='width: 80px' class="btn btn-danger" type="submit" name="remove" value="Delete">
                
            </form>
            </td>
            </tr>
            <?php
        }
        if(isset($_POST['remove'])){
            deleteRecord('comments', 'comment_id', $_POST['comment_id']);
            header("Location: comments.php");
            print_r($_POST);
        }

        ?>
    </tbody>
</table> 