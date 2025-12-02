<?php
session_start();
include '../../../configs/connect-db.php';
include '../functions/get-all-products.php';
include '../functions/delete-product.php';

if (isset($_POST['delete'])) {
    $pcode = $_POST['pcode'];
    if (deleteProduct($pcode)) {
        $_SESSION['action'] = 'delete';
        $_SESSION['msg'] = 'Product deleted successfully!';
        header('location: products.php'); //refresh to prevent re-submit
        exit;
    }
}

if (isset($_POST['search'])) {
    $search = $_POST['txtsearch'];
    $products = findProducts($search);
} else {
    $products = getAllProducts();
}

?>
<!doctype html>
<html lang="en">

<head>
    <?php
    $title = 'Products';
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
                    <h1 class="h2">Manage Products</h1>
                </div>

                <form method="post">
                    <div class="row d-flex align-items-end mb-3">
                        <div class="col6">
                            <!-- <label for="stocks form-label">Search</label> -->
                            <input type="text" class="form-control " name="txtsearch"
                                placeholder="Type to search...">
                        </div>
                        <div class="col-6">
                            <input type="submit" name="search" value="Search" class="btn btn-primary">
                        </div>
                </form>
                <a href="product-form.php" class="btn btn-success text-white  float-right"><i class="fas fa-plus-square"></i> New Product</a>

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
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stocks</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    //todo: add search
                    $i = 0;
                    foreach ($products as $product) :
                        $i++;
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $product['p_code'] ?></td>
                            <td><?= $product['p_descript'] ?></td>
                            <td><?= $product['p_price'] ?></td>
                            <td><?= $product['p_qoh'] ?></td>
                            <td>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-primary btn-sm">
                                        <a href="" class="text-white"><i class="fas fa-pen"></i></a>
                                    </label>
                                    <form method="post">
                                        <input type="hidden" name="pcode" value="<?= $product['p_code'] ?>">
                                        <button class="btn btn-danger btn-sm" name="delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
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