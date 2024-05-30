
<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="forgotPassword.css">
    <title>Login</title>
</head>

<body>

    <form action="" class="mb-3 row" method="POST">
     <center>   <h3>Re-Changing Password</h3></center>
        <input type="hidden" id="action" name="action" value="reset_password" />
        <label>Username</label>
        <input type="text" class="form-control" placeholder="username" name="username"
         required>
        <label for="password">Old Password</label>
        <input type="text" name="password" id="password" placeholder="Enter your old password" class="form-control" required>
        <label for="password">New Password</label>

        <input type="text" name="new_password" id="new_password" placeholder="Enter your new password"
            class="form-control" required>
        <label for="password">Re-Password</label>

        <input type="text" name="re_enter_password" id="re_enter_password" placeholder="Re-enter your password"
            class="form-control" required>
        <br>

        <?php
include ("db.php");

if (@$_POST['action'] == "reset_password") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $new_password = $_POST["new_password"];
    $re_enter_password = $_POST["re_enter_password"];

    $user = $con->prepare("SELECT username from `users` where `username`=? ");
    $user->bind_param("s", $username);
    $user->execute();
    $check_result = $user->get_result();
    $user_data = $check_result->fetch_assoc();



    $user_pass = $con->prepare("SELECT password from `users` where `password`=? ");
    $user_pass->bind_param("s", $password);
    $user_pass->execute();
    $check_result_pass = $user_pass->get_result();
    $user_data_pass = $check_result_pass->fetch_assoc();

    if ($username == $user_data['username']) {

        if ($password == $user_data_pass['password']) {

            if ($new_password == $re_enter_password) {
                $update_query = $con->prepare("UPDATE users set password=? where `username`=?;");

                $update_query->bind_param('ss', $new_password, $user_data['username']);
                $y = $update_query->execute();
                
                if ($update_query->execute()) {
                    echo "<div style='color:green'>success fully updated</div>";
                } else {
                    echo "<div style='color:red'>Error in updating</div>";
                }

            } else {
                echo "<div style='color:red'>Re-Enter the password Correctly</div>";
            }

        } else {
            echo "<div style='color:red'>Incorrect Password</div>";
        }


    } else {
        echo "<div style='color:red'>Wrong credentials</div>";
    }

}


?>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</body>
</html>