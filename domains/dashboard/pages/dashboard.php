<?php

include '../functions/getCounts.php';
include '../../../configs/connect-db.php';
$conn = Connect();
$productsCount  = getCount($conn, 'product');
$customersCount = getCount($conn, 'customer');
$ordersCount    = getCount($conn, 'invoice');

$stats = [
    [
        'label' => 'Products',
        'count' => $productsCount,
        'icon' => 'box',
        'icon-color' => 'text-primary'
    ],
    [
        'label' => 'Customers',
        'count' => $customersCount,
        'icon' => 'users',
        'icon-color' => 'text-success'
    ],
    [
        'label' => 'Orders',
        'count' => $ordersCount,
        'icon' => 'shopping-cart',
        'icon-color' => 'text-danger'
    ],

]
?>

<!doctype html>
<html lang="en">

<head>
    <?php
    $title = 'Dashboard';
    include '../../../components/head.php'
    ?>
    <!-- Custom styles for this template -->
    <link href="../../../css/dashboard.css" rel="stylesheet">
</head>

<body class="bg-body-secondary">
    <?php include '../../../components/nav-bar.php' ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Menu -->
            <?php include '../../../components/side-bar.php' ?>

            <main role="main" class=" col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>
                <!-- stats card container -->
                <div class="container mt-4">
                    <div class="row g-3">
                        <?php foreach ($stats as $stat): ?>

                            <div class="col-12 col-md-4">
                                <div class="card shadow-sm rounded-4 p-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-muted mb-1"><?= $stat['label'] ?></p>
                                            <h2 class="mb-0 fw-bold">
                                                <?= $stat['count'] ?>
                                            </h2>
                                        </div>
                                        <i data-feather=<?= $stat['icon'] ?> class=<?= $stat['icon-color'] ?> style="width:40px;height:40px;"></i>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>



                    </div>
                </div>
            </main>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="../../../assets/js/vendor/jquery.slim.min.js"><\/script>')
    </script>
    <script src="../../../assets/dist/js/bootstrap.bundle.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    <script src="../../../js/dashboard.js"></script>
</body>

</html>