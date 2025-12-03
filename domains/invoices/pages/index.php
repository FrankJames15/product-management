<?php
session_start();
include '../../../configs/connect-db.php';
include '../functions/get-all-invoices.php';
include '../functions/search.fn.php';

include '../functions/delete-invoice.fn.php';

$orders = getAllInvoices() ?? [];
$textToSearch = $_POST['text-to-search'] ?? '';
$filteredData = $orders;


// 🔍search
if (isset($_POST['search'])) {
    $filteredData = search($orders, $textToSearch);
}

if (isset($_POST['delete'])) {

    $to_delete = $_POST['to-delete'];

    function errorCB()
    {
        $_SESSION['action'] = 'error';
        $_SESSION['msg'] = 'Deletion Failed';
        header('location: index.php'); //refresh to prevent re-submit
        exit;
    }
    function successCB()
    {
        $_SESSION['action'] = 'delete';
        $_SESSION['msg'] = 'Invoice deleted successfully!';
        header('location: index.php'); //refresh to prevent re-submit
        exit;
    }
    deleteInvoice(Connect(), 'errorCB', 'successCB', $to_delete);
}

?>
<!doctype html>
<html lang="en">

<head>
    <?php
    $title = 'Orders';
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
            <?php include '../../../components/side-bar.php' ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Manage Invoices</h1>
                </div>

                <form method="post">
                    <div class="row d-flex align-items-end mb-3">
                        <div class="col6">
                            <!-- <label for="stocks form-label">Search</label> -->
                            <input type="text" class="form-control " name="text-to-search"

                                value='<?= $textToSearch ?>'
                                placeholder="Type to search...">
                        </div>
                        <div class="col-6">
                            <input type="submit" name="search" value="Search" class="btn btn-primary">
                        </div>
                </form>
                <a href="add-invoice.page.php" class="btn btn-success text-white  float-right"><i class="fas fa-plus-square"></i> New Invoice</a>

        </div>
        <?php
        if (isset($_SESSION['action'])) {
        ?>
            <div class="alert alert-success mt-3 col-6">
                <?= $_SESSION['msg'] ?>
            </div>
        <?php
            unset($_SESSION['action']);
        }
        ?>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Customer Name</th>
                        <th>Invoice Date</th>
                        <th>Sub total</th>
                        <th>Tax</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                    <?php

                    $i = 0;
                    foreach ($filteredData as $order):
                        $i++;
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $order['inv_number'] ?></td>
                            <td><?= $order['cus_fname'] . ' ' . $order['cus_initial'] . ' ' . $order['cus_lname'] ?></td>

                            <td><?= date("d M Y", strtotime($order['inv_date'])) ?></td>
                            <td><?= number_format($order['inv_subtotal'], 2) ?></td>
                            <td><?= number_format($order['inv_tax'], 2) ?></td>
                            <td><?= number_format($order['inv_total'], 2) ?></td>
                            <td>
                                <form
                                    action=<?= $_SERVER['PHP_SELF'] ?>
                                    method="POST">
                                    <input name='to-delete' value=<?= $order['inv_number'] ?> type="hidden">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <button

                                            class="btn btn-primary btn-sm">
                                            <a href="" class="text-white"><i class="fas fa-pen"></i></a>
                                        </button>
                                        <button
                                            name='delete'
                                            type='submit'
                                            class="btn btn-danger btn-sm">
                                            <a href="" class="text-white"><i class="fas fa-trash"></i></a>
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


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')
    </script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    <script src="../../../js/dashboard.js"></script>
</body>

</html>