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
            <th>Approve</th>
            <th>Decline</th>
            <th>Delete</th>
 
        </tr>
    </thead>
    <tbody>
        <?php 
        //$query = "SELECT * FROM comments";

        $query = "SELECT comments.*, posts.post_title FROM comments INNER JOIN posts ON comments.comment_post_id = posts.post_id WHERE comment_post_id = '{$_GET['p_id']}' ORDER BY comment_id";

        $selectComment = mysqli_query($con,$query);
        confirm($selectComment);
        while($row = mysqli_fetch_assoc($selectComment)){
            echo "<tr>";
            echo "<td>{$row['comment_id']}</td>";
            echo "<td>{$row['comment_author']}</td>";
            echo "<td>{$row['comment_email']}</td>";
            echo "<td>{$row['comment_content']}</td>";
            echo "<td>{$row['comment_status']}</td>";
            echo "<td><a href='../post.php?p_id={$row['comment_post_id']}'>{$row['post_title']}</a></td>";
            echo "<td>{$row['comment_date']}</td>";
            echo "<td><a href='post_comments.php?source=approve_comment&c_id={$row['comment_id']}&p_id={$_GET['p_id']}'>Approve</a></td>";
            echo "<td><a href='post_comments.php?source=decline_comment&c_id={$row['comment_id']}&p_id={$_GET['p_id']}'>Decline</a></td>";
            echo "<td><a href='post_comments.php?source=delete_comment&c_id={$row['comment_id']}&p_id={$_GET['p_id']}'>Delete</a></td>";
            echo "</tr>";
        }

        ?>
    </tbody>
</table> 