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

        <form class=" form-signin" action="./domains/dashboard/pages/dashboard.php">
            <!-- <img
            class="mb-4"
            src="img/bootstrap-solid.svg"
            alt=""
            width="72"
            height="72" /> -->
            <h1 class="h3 mb-1 font-weight-normal">ACCOUNT LOGIN</h1>
            <p class="mb-3 text-secondary">Signin to manage your products</p>

            <label for="Username" class="sr-only">Username</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                <input
                    type="text"
                    class="form-control"
                    id="Username"
                    placeholder="Type your username" />
            </div>

            <label for="Password" class="sr-only">Password</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fas fa-key"></i>
                    </div>
                </div>
                <input
                    type="text"
                    class="form-control"
                    id="Username"
                    placeholder="Type your password" />
            </div>
            <div class="checkbox mb-3"></div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">
                Sign in
            </button>
            <!-- <p class="mt-5 mb-3 text-muted">&copy; 2021</p> -->
        </form>
    </div>
</body>

</html>