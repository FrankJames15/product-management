<?php
include '../../../configs/connect-db.php';
include '../functions/add-vendor.fn.php';



if (isset($_POST['add-vendor'])) {

    // names
    $last_name = $_POST['last-name'];
    $first_name = $_POST['first-name'];
    $initial = $_POST['initial'];
    $contact = $_POST['contact'];


    echo "Last_name: " . $last_name . '<br />';
    echo "First_name: " . $first_name . '<br />';
    echo "Initial: " . $initial . '<br />';
    echo "Contact: " . $contact . '<br />';

    function errorCB($error)
    {
        echo "Adding new vendor failed: " . $error;
    };
    function successCB()
    {
        $_SESSION['action'] = 'Add';
        $_SESSION['msg'] = 'Vendor added successfully!';
        header('Location: index.php');
    }
    addVendor(
        Connect(),
        'errorCB',
        'successCB',
        $last_name,
        $first_name,
        $initial,
        $contact
    );
}
?>

<!doctype html>
<html lang="en">
<?php session_start(); ?>

<head>
    <?php
    $title = 'Vendors';
    include '../../../components/head.php'
    ?>
    <!-- Custom styles for this template -->
    <link href="../../../css/dashboard.css" rel="stylesheet">
</head>

<body>
    <?php
    include '../../../components/nav-bar.php';
    ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Menu -->
            <?php
            include '../../../components/side-bar.php';
            ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">New Vendor</h1>
                </div>
                <div class="container">


                    <form method="POST"
                        action=<?php $_SERVER['PHP_SELF'] ?>>
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label class="form-label">Last Name</label>
                                    <input name="last-name" class="form-control" value='test'>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label class="form-label">First Name</label>
                                    <input name="first-name" class="form-control" value='test'>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label">Initial</label>
                                    <input name="initial" class="form-control" value='test'>
                                </div>

                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label class="form-label">Contact</label>
                                    <input name="contact" class="form-control" value='test'>
                                </div>
                            </div>

                        </div>

                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button name="add-vendor" type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
        </div>
        </main>
    </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')
    </script>
    <script src="../../../assets/dist/js/bootstrap.bundle.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    <script src="../../../js/dashboard.js"></script>
</body>

</html>