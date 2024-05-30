<?php
include ("db.php");
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $check_query = $con->prepare("SELECT * FROM users WHERE `username` = ? AND `password` = ?");
    $check_query->bind_param("ss", $username, $password);
    $check_query->execute();
    $check_result = $check_query->get_result();
    if ($check_result->num_rows > 0) {

        $user_data = $check_result->fetch_assoc();
        $_SESSION['id'] = $user_data['id'];
        $_SESSION['username'] = $user_data['username'];
        header("Location: index.php");
        exit();
    } else {
        echo "<p style='color:red'>Invalid Credentials</p>";
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Login</title>
</head>

<body class="account-body accountbg">
    <div class="container">
        <div class="row vh-100 ">
            <div class="col-12 align-self-center">
                <div class="auth-page">
                    <div class="card auth-card shadow-lg">
                        <div class="card-body">
                            <div class="px-3">


                                <form class="" method="POST" action="login.php">

                                    <div class="form-group"><span>
                                            <label for="username" style="margin:10px">Username</label>
                                        </span>
                                        <div class="input-group mb-3">
                                            <span class="auth-form-icon">
                                                <i class="dripicons-user"></i>
                                            </span>
                                            <input style="margin:10px" type="text" class="form-control" name="username"
                                                id="username" placeholder="Enter username">
                                        </div>
                                    </div>
                                    <div class="form-group"><span>
                                            <label style="margin:10px" for="userpassword">Password</label>
                                        </span>
                                        <div class="input-group mb-3">
                                            <span class="auth-form-icon">
                                                <i class="dripicons-lock"></i>
                                            </span>
                                            <input style="margin:10px" type="password" class="form-control"
                                                name="password" id="password" placeholder="Enter password">
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 row">
                                        <div class="col-12 mt-2">
                                            <button style="margin:10px" class="btn btn-primary" type="submit">Log In <i
                                                    class="fas fa-sign-in-alt ml-1"></i></button>
                                        </div>

                                    </div>
                                    <a style="margin:10px" href="register.php">Register</a>

                                </form>
                                <a href="forgotpassword.php">Reset Password</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>