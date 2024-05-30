<?php
include ("db.php");
if (@$_POST['action'] == "register_user") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $dob = $_POST["dob"];
    $user_email = $_POST["user_email"];
    $number = $_POST["number"];
    $password = $_POST["password"];

    $select_user = $con->prepare("SELECT * FROM `users` WHERE `user_email`=?");
    $select_user->bind_param("s", $user_email);
    $select_user->execute();
    $user_result = $select_user->get_result();
    if ($user_result->num_rows > 0) {
        echo 'User Already exist';
    } else {
        $check_query = $con->prepare("INSERT INTO `users`(`firstname`,`lastname`,`username`,`dob`,`number`,`user_email`,`password`) VALUES (?,?,?,?,?,?,?)");
        $check_query->bind_param('ssssiss', $firstname, $lastname, $username, $dob, $number, $user_email, $password);
        if ($check_query->execute()) {
            echo 'User added Sucessfully';
            echo '
                <script type="text/javascript">
                    setTimeout(function() {
                        window.location.href = "login.php";
                    }, 2000);
                </script>
                ';
        }
    }
}
?>
<html>

<head>
    <title>Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel=" stylesheet" href="register.css">
</head>

<body>

    <div class="container" class="col-25">
        <div class="row vh-100 ">
            <div class="col-12 align-self-center">
                <div class="auth-page">
                    <div class="card auth-card shadow-lg">
                        <div class="card-body">
                            <div class="px-3">
                                <form action="" method="post" data-parsley-validate="" class="form_"
                                    class="form-floating mb-3">
                                    <center>
                                        <h4 class="font-monospace">REGISTRATION</h4>
                                    </center>
                                    <input type="hidden" id="action" name="action" value="register_user">
                                    <label class="form-label" class="inblock">First Name</label>
                                    <input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                        type="text" name="firstname" id="firstname" placeholder="Enter first name"
                                        required>
                                    <label class="inblock" class="form-label">Last Name</label>
                                    <input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                        type="text" name="lastname" id="lastname" placeholder="Enter last name"
                                        required>
                                    <label class="form-label">Username </label>
                                    <input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                        type="text" name="username" id="username" placeholder="Enter user name"
                                        required>
                                    <label class="form-label">Date of Birth </label>
                                    <input class="form-control" type="date" name="dob" id="dob" required>
                                    <label class="form-label">Email</label>
                                    <input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                        type="email" name="user_email" id="user_email" placeholder="Enter email"
                                        required>
                                    <label class="form-label">Phone</label>
                                    <input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                        type="number" name="number" id="number" placeholder="Enter phone number"
                                        required>
                                    <label class="form-label">Password</label>
                                    <input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                        type="password" name="password" id="password" placeholder="Enter password"
                                        required>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Submit</button> <br>
                                    <a style=" text-decoration: none" href="login.php">Back</a>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>
</body>

</html>