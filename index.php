<?php

session_start();



$_SESSION['error'] = null;

function signIn($user = null, $password = null)
{
    define('HOST', 'localhost');
    define('DBNAME', 'salecodb');

    $conn = @new mysqli(HOST, $user, $password, DBNAME);
    if ($conn->connect_error) {
        return 0;
    }
    $_SESSION['user'] = $user;
    $_SESSION['password'] = $password;
    unset($_SESSION['error']);
    header('Location: ./domains/dashboard/pages/dashboard.php');
    return 1;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user = $_POST['username'] ?? NULL;
    $password = $_POST['password'] ?? NULL;

    // echo 'username: ' . $user . '<br />';
    // echo 'password: ' . $password . '<br />';

    $result = signIn($user, $password);

    if (!$result) {
        $_SESSION['error'] = "Log-in failed";
        header('Location: index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    $title = "Sign-in";
    include './components/head.php'
    ?>
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="text-center ">

    <div class="container">
        <?php if ($_SESSION['error']): ?>
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="..." class="rounded mr-2" alt="...">
                    <strong class="mr-auto">Bootstrap</strong>
                    <small>11 mins ago</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    Hello, world! This is a toast message.
                </div>
            </div>
        <?php endif ?>

        <form
            method="POST"
            class=" form-signin" action=<?= $_SERVER['PHP_SELF'] ?>>

            <h1 class="h3 mb-1 font-weight-normal">ACCOUNT LOGIN</h1>
            <p class="mb-3 text-secondary">Signin to manage your products</p>

            <label class="sr-only">Username</label>
            <div class="input-group mb-3">

                <input
                    name=username
                    class="form-control"
                    placeholder="Username" />
            </div>

            <label class="sr-only">Password</label>
            <div class="input-group mb-2">

                <input
                    name=password
                    type="password"
                    class="form-control"
                    placeholder="Password" />
            </div>
            <!-- <div class="checkbox mb-3"></div> -->
            <button class="btn btn-lg btn-primary btn-block" type="submit">
                Sign in
            </button>
            <!-- <p class="mt-5 mb-3 text-muted">&copy; 2021</p> -->
        </form>
    </div>
</body>

</html>