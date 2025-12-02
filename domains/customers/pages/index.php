<?php
session_start();
include '../../../configs/connect-db.php';
include '../functions/get-all-customers.php';
include '../functions/search.php';
include '../functions/add-customer.php';
include '../functions/delete-customer.php';
include '../functions/update-customer.php';

$customers = getAllCustomers() ?? [];
$textToSearch = $_POST['text-to-search'] ?? '';
$filteredCustomers = $customers;


// 🔍search
if (isset($_POST['search'])) {
    $filteredCustomers = searchByName($customers, $textToSearch);
}

// ➕ add customer
if (isset($_POST['add-customer'])) {

    $last_name = $_POST['last-name'];
    $first_name = $_POST['first-name'];
    $initial = $_POST['initial'];
    $area_code = $_POST['area-code'];
    $phone = $_POST['phone'];

    function onError($msg)
    {
        $_SESSION['action'] = 'error';
        $_SESSION['msg'] = $msg;
        header('location: index.php'); //refresh to prevent re-submit
        exit;
    };
    function onSuccess()
    {
        $_SESSION['action'] = 'add';
        $_SESSION['msg'] = 'Customer added successfully!';
        header('location: index.php'); //refresh to prevent re-submit
        exit;
    };

    addCustomer(
        Connect(),
        'onError',
        'onSuccess',

        $last_name,
        $first_name,
        $initial,
        $area_code,
        $phone
    );
}

// 🗑 delete customer
if (isset($_POST['delete'])) {

    $customer_id = $_POST['customer-id'];

    function onError($msg)
    {
        $_SESSION['action'] = 'error';
        $_SESSION['msg'] = $msg;
        header('location: index.php'); //refresh to prevent re-submit
        exit;
    };
    function onSuccess()
    {
        $_SESSION['action'] = 'delete';
        $_SESSION['msg'] = 'Customer deleted successfully!';
        header('location: index.php'); //refresh to prevent re-submit
        exit;
    };

    deleteCustomer(
        Connect(),
        'onError',
        'onSuccess',
        $customer_id
    );
}

if (isset($_POST['trigger-update'])) {
    $_SESSION['is-update-modal-open'] = 1;


    $customer_id = $_POST['customer-id'];
    $last_name = $_POST['last-name'];
    $first_name = $_POST['first-name'];
    $initial = $_POST['initial'];
    $area_code = $_POST['area-code'];
    $phone = $_POST['phone'];

    $_SESSION['customer-id'] = $customer_id;
    $_SESSION['last-name'] = $last_name;
    $_SESSION['first-name'] = $first_name;
    $_SESSION['initial'] = $initial;
    $_SESSION['area-code'] = $area_code;
    $_SESSION['phone'] = $phone;

    header('location: index.php');
    exit;
}

if (isset($_POST['update-customer'])) {

    $customer_id = $_POST['customer-id'];
    $last_name = $_POST['last-name'];
    $first_name = $_POST['first-name'];
    $initial = $_POST['initial'];
    $area_code = $_POST['area-code'];
    $phone = $_POST['phone'];

    function unsetSessionUpdateFields()
    {
        unset($_SESSION['customer-id']);
        unset($_SESSION['last-name']);
        unset($_SESSION['first-name']);
        unset($_SESSION['initial']);
        unset($_SESSION['area-code']);
        unset($_SESSION['phone']);
    }

    function onError($msg)
    {
        $_SESSION['action'] = 'error';
        $_SESSION['msg'] = $msg;
        unsetSessionUpdateFields();
        header('location: index.php'); //refresh to prevent re-submit
        exit;
    };
    function onSuccess()
    {
        $_SESSION['action'] = 'update';
        $_SESSION['msg'] = 'Customer updated successfully!';
        unsetSessionUpdateFields();
        header('location: index.php'); //refresh to prevent re-submit
        exit;
    };

    updateCustomer(
        Connect(),
        'onError',
        'onSuccess',
        $customer_id,
        $last_name,
        $first_name,
        $initial,
        $area_code,
        $phone
    );
};

?>
<!doctype html>
<html lang="en">

<head>
    <?php
    $title = 'Customers';
    include '../../../components/head.php'
    ?>
    <!-- Custom styles for this template -->
    <link href="../../../css/dashboard.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>
    <?php
    include '../../../components/nav-bar.php';
    ?>

    <div class="container-fluid">
        <div class="row">
            <?php include '../../../components/side-bar.php' ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Manage Customers</h1>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <!-- 🔍 Search Bar -->
                        <form method="post">
                            <div class="row mb-3">
                                <div class="col-8 ">
                                    <input class="form-control " value="<?= $textToSearch ?>" name="text-to-search" placeholder="Type to search...">
                                </div>
                                <div class="col-4">
                                    <input type="submit" name="search" value="Search"
                                        class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6 justify-content-end">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success w-auto float-sm-end" data-bs-toggle="modal" data-bs-target="#add-customer-modal">
                            <i class="fas fa-plus-square"></i>
                            New Customer
                        </button>
                    </div>
                </div>

                <!-- MODAL for adding customer -->
                <div class="modal fade" id="add-customer-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">New Customer</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-5">

                                            <label class="form-label">Last Name
                                            </label>
                                            <input name="last-name" class="form-control">
                                        </div>
                                        <div class="col-sm-5">

                                            <label class="form-label">First Name
                                            </label>
                                            <input name="first-name" class="form-control">
                                        </div>
                                        <div class="col-sm-2">

                                            <label class="form-label">Initial
                                            </label>
                                            <input name="initial" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm">
                                            <label class="form-label">Area Code
                                            </label>
                                            <input name="area-code" class="form-control">
                                        </div>
                                        <div class="col-sm">
                                            <label class="form-label">Phone
                                            </label>
                                            <input name="phone" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="add-customer" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <?php
                if (isset($_SESSION['action'])):
                ?>
                    <div class="alert <?php echo $_SESSION['action'] == "error" ? 'alert-danger' : 'alert-success'  ?> mt-3 col-6">
                        <?= $_SESSION['msg'] ?>
                    </div>
                <?php
                    unset($_SESSION['action']);
                    unset($_SESSION['msg']);

                endif;
                ?>
                <div class="table-responsive">
                    <!-- 📄 TABLE -->
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Initial</th>
                                <th>Area Code</th>
                                <th>Phone</th>
                                <th>Balance</th>
                                <th>Action</th>
                                <!-- <th>Created at</th> -->
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i = 0;
                            foreach ($filteredCustomers as $customer):
                                $i++;
                            ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $customer['cus_code'] ?></td>
                                    <td><?= $customer['cus_lname'] ?></td>
                                    <td><?= $customer['cus_fname'] ?></td>
                                    <td><?= $customer['cus_initial'] ?></td>
                                    <td><?= $customer['cus_areacode'] ?></td>
                                    <td><?= $customer['cus_phone'] ?></td>
                                    <td><?= number_format($customer['cus_balance'], 2) ?></td>
                                    <!-- <td><?= date("d M Y", strtotime($customer['created_at'])) ?></td> -->
                                    <!-- actions -->
                                    <td>
                                        <form
                                            action=<?= $_SERVER['PHP_SELF'] ?>
                                            method="POST">
                                            <input name="customer-id" value="<?= $customer['cus_code'] ?>" type="hidden">
                                            <input name="last-name" value="<?= $customer['cus_lname'] ?>" type="hidden">
                                            <input name="first-name" value="<?= $customer['cus_fname'] ?>" type="hidden">
                                            <input name="initial" value="<?= $customer['cus_initial'] ?>" type="hidden">
                                            <input name="area-code" value="<?= $customer['cus_areacode'] ?>" type="hidden">
                                            <input name="phone" value="<?= $customer['cus_phone'] ?>" type="hidden">
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <button
                                                    name="trigger-update"
                                                    class="btn btn-primary"
                                                    type="submit">
                                                    <a class="text-white"><i class="fas fa-pen"></i></a>
                                                </button>
                                                <button
                                                    name="delete"
                                                    class="btn btn-danger"
                                                    type="submit">
                                                    <a class="text-white"><i class="fas fa-trash"></i></a>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <?php if (isset($_SESSION['is-update-modal-open'])) : ?>
        <!-- Update Customer Modal (unique id) -->
        <div class="modal fade" id="update-customer-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateCustomerLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="updateCustomerLabel">Update Customer</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="customer-id" value="<?= htmlspecialchars($_SESSION['customer-id']) ?>">

                            <div class="row">
                                <div class="col-sm-5">
                                    <label class="form-label">Last Name</label>
                                    <input name="last-name" class="form-control" value="<?= htmlspecialchars($_SESSION['last-name'] ?? '') ?>">
                                </div>
                                <div class="col-sm-5">
                                    <label class="form-label">First Name</label>
                                    <input name="first-name" class="form-control" value="<?= htmlspecialchars($_SESSION['first-name'] ?? '') ?>">
                                </div>
                                <div class="col-sm-2">
                                    <label class="form-label">Initial</label>
                                    <input name="initial" class="form-control" value="<?= htmlspecialchars($_SESSION['initial'] ?? '') ?>">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm">
                                    <label class="form-label">Area Code</label>
                                    <input name="area-code" class="form-control" value="<?= htmlspecialchars($_SESSION['area-code'] ?? '') ?>">
                                </div>
                                <div class="col-sm">
                                    <label class="form-label">Phone</label>
                                    <input name="phone" class="form-control" value="<?= htmlspecialchars($_SESSION['phone'] ?? '') ?>">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <!-- use a distinct submit name for update; backend handler can be added later -->
                            <button type="submit" name="update-customer" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // show the modal after the page loads
            document.addEventListener('DOMContentLoaded', function() {
                var updateModalEl = document.getElementById('update-customer-modal');
                if (updateModalEl) {
                    var modal = new bootstrap.Modal(updateModalEl);
                    modal.show();
                }
            });
        </script>

        <?php
        // clear the flag so the modal doesn't reopen on subsequent refreshes
        unset($_SESSION['is-update-modal-open']);
        ?>
    <?php endif; ?>

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <!-- <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script> -->
    <!-- <script src="../assets/dist/js/bootstrap.bundle.min.js"></script> -->


    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    <script src="../../../js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>