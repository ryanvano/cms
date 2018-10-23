<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
<!--            <th>Date</th>-->
            <th>Edit</th>
            <th>Delete</th>
 
        </tr>
    </thead>
    <tbody>
        <?php 
        $query = "SELECT user_id, user_username, user_fname, user_lname, user_email, user_role FROM users";
        $stmt = mysqli_prepare($con, $query);
        $stmt->execute();
        $stmt->bind_result($user_id, $user_username, $user_fname, $user_lname, $user_email, $user_role);

        while($stmt->fetch()){
            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$user_username}</td>";
            echo "<td>{$user_fname}</td>";
            echo "<td>{$user_lname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td>{$user_role}</td>";
            echo "<td><a class='btn btn-info' href='users.php?source=edit_user&u_id={$row['user_id']}'>Edit</a></td>";
            echo "<td><a href='users.php?source=delete_user&u_id={$user_id}'>Delete</a></td>";
            echo "</tr>";
        }

        ?>
    </tbody>
</table> 