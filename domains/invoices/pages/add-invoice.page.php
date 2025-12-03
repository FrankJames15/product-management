<?php
session_start();
include '../../../configs/connect-db.php';
include '../../customers/functions/get-all-customers.php';
include '../functions/add-invoice.fn.php';

$customers = getAllCustomers(Connect());

function resetSession()
{
    $_SESSION['customer'] = null;
    $_SESSION['subtotal'] = 0.00;
    $_SESSION['tax-rate'] = 0.0;
    $_SESSION['tax'] = 0.00;
    $_SESSION['total'] = 0.00;
    $_SESSION['is-computed'] = 0;
}

if (isset($_POST['reset'])) {
    resetSession();
}


if (isset($_POST['compute'])) {
    // inputs
    $customer = $_POST['customer'];
    $subtotal = $_POST['subtotal'];
    $taxRate = $_POST['tax-rate'];

    // visualize inputs
    // echo "Customer: " . $customer . '<br />';
    // echo "Subtotal: " . $subtotal . '<br />';
    // echo "TaxRate: " . $taxRate . '<br />';

    // compute
    $tax = $subtotal * ($taxRate / 100);
    $total = $subtotal + $tax;

    // set session
    $_SESSION['customer'] = $customer;
    $_SESSION['subtotal'] = $subtotal;
    $_SESSION['tax-rate'] = $taxRate;
    $_SESSION['tax'] = $tax;
    $_SESSION['total'] = $total;
    $_SESSION['is-computed'] = 1;

    // echo 'SESSIONS' . '<br />';
    // echo 'customer: ' . $_SESSION['customer'] . '<br />';
    // echo 'subtotal: ' . $_SESSION['subtotal'] . '<br />';
    // echo 'tax-rate: ' . $_SESSION['tax-rate'] . '<br />';
    // echo 'tax: ' . $_SESSION['tax'] . '<br />';
    // echo 'total: ' . $_SESSION['total'] . '<br />';
    // echo 'is-computed: ' . $_SESSION['is-computed'] . '<br />';
}

if (isset($_POST['add-invoice'])) {
    $customer = $_SESSION['customer'];
    $subtotal = $_SESSION['subtotal'];
    $tax = $_SESSION['tax'];
    $total = $_SESSION['total'];

    function errorCB($error)
    {
        echo "Adding new invoice failed: " . $error;
    };
    function successCB()
    {
        $_SESSION['action'] = 'Add';
        $_SESSION['msg'] = 'Invoice added successfully!';
        resetSession();
        header('Location: index.php');
    }
    addInvoice(
        Connect(),
        'errorCB',
        'successCB',
        $customer,
        $subtotal,
        $tax,
        $total
    );
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
            <!-- Sidebar Menu -->
            <?php
            include '../../../components/side-bar.php';
            ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">New Invoice</h1>
                </div>
                <div class="container">


                    <form method="POST"
                        action=<?php $_SERVER['PHP_SELF'] ?>>
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label class="form-label">Customer</label>
                                    <select name="customer"

                                        class="form-control">
                                        <?php foreach ($customers as $customer): ?>
                                            <option value=<?= $customer['cus_code'] ?>
                                                <?php echo ($_SESSION['customer']) == $customer['cus_code'] ? 'selected' : '' ?>>
                                                <?= $customer['cus_fname'] . " " . $customer['cus_initial'] . ". " . $customer['cus_fname'] ?>
                                            </option>
                                        <?php endforeach ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label class="form-label">Subtotal</label>
                                    <input name="subtotal"
                                        value=<?php echo !isset($_SESSION['subtotal']) ? 0 : $_SESSION['subtotal'] ?>
                                        required step="0.01" class="form-control" type="number">
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label class="form-label">Tax rate</label>
                                    <input name="tax-rate"
                                        value=<?php echo !isset($_SESSION['tax-rate']) ? 0 : $_SESSION['tax-rate'] ?>

                                        required step="1" class="form-control" type="number">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label class="form-label">Tax</label>
                                    <input name="tax"
                                        value=<?php echo !isset($_SESSION['tax']) ? 0 : $_SESSION['tax'] ?>
                                        readonly class="form-control" type="number">
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label class="form-label">Total</label>
                                    <input
                                        value=<?php echo !isset($_SESSION['total']) ? 0 : $_SESSION['total'] ?>
                                        name="total" disabled class="form-control" type="number">
                                </div>
                            </div>

                        </div>

                        <button name="reset" type="submit" class="btn btn-secondary">Reset</button>
                        <button name="compute" type="submit" class="btn btn-secondary">Compute</button>
                        <button name="add-invoice"
                            <?php echo $_SESSION['is-computed'] ? '' : 'disabled'  ?>
                            type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
        </div>
        </main>
    </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="../assets/js/invoice/jquery.slim.min.js"><\/script>')
    </script>
    <script src="../../../assets/dist/js/bootstrap.bundle.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    <script src="../../../js/dashboard.js"></script>
</body>

</html>