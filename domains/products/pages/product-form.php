 <?php
    include '../../../configs/connect-db.php';
    include '../../vendors/functions/get-all-vendors.php';
    include '../functions/add-product.php';



    $vendors = getAllVendors(Connect(), null, null);
    $selectedVendor = null;


    if (isset($_POST['add-product'])) {
        $name = $_POST['name'];
        $vendor = $_POST['vendor'];
        $desc = $_POST['description'];
        $price = floatval($_POST['price']);
        $stocks = intval($_POST['stocks']);


        $selectedVendor = $vendor;

        // echo "Name: " . $name . '<br />';
        // echo "Vendor: " . $vendor . '<br />';
        // echo "Desc: " . $desc . '<br />';
        // echo "Price: " . $price . '<br />';
        // echo "Stocks: " . $stocks . '<br />';

        function errorCB($error)
        {
            echo "Adding new product failed" . $error;
        };

        if (addProduct(
            Connect(),
            'errorCB',
            null,
            $name,
            $vendor,
            $desc,
            $price,
            $stocks
        )) {
            $_SESSION['action'] = 'Add';
            $_SESSION['msg'] = 'Product added successfully!';
            header('Location: products.php');
        }
    }
    ?>

 <!doctype html>
 <html lang="en">
 <?php session_start(); ?>

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
             <!-- Sidebar Menu -->
             <?php
                include '../../../components/side-bar.php';
                ?>

             <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                 <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                     <h1 class="h2">New Product</h1>
                 </div>
                 <div class="container">


                     <form method="POST"
                         action=<?php $_SERVER['PHP_SELF'] ?>>
                         <div class="row">
                             <div class="col">
                                 <div class="form-group">
                                     <label class="form-label">Product Name</label>
                                     <input name="name" class="form-control">
                                 </div>
                             </div>
                             <div class="col">
                                 <div class="form-group">
                                     <label class="form-label">Select Vendor</label>
                                     <select name="vendor" class="form-control">
                                         <?php foreach ($vendors as $vendor): ?>
                                             <option

                                                 <?php echo $vendor['id'] === $selectedVendor ? 'selected' : null ?>
                                                 value=<?= $vendor['id'] ?>><?= $vendor['last_name'] . ", " . $vendor['first_name'] . " " . $vendor['initial'] . "."  ?></option>
                                         <?php endforeach; ?>
                                     </select>
                                 </div>
                             </div>
                         </div>




                         <div class="mb-3">
                             <label class="form-label">Description</label>
                             <textarea name='description' class="form-control"></textarea>
                         </div>

                         <div class="row">
                             <div class="form-group col-sm">
                                 <label for="price">Price</label>
                                 <input name="price" class="form-control" type='number' step="0.01" required>
                             </div>

                             <div class="form-group col-sm">
                                 <label for="stocks">Stocks</label>
                                 <input name="stocks" class="form-control" type='number' step="1" required>
                             </div>
                         </div>
                         <button type="reset" class="btn btn-secondary">Reset</button>
                         <button name="add-product" type="submit" class="btn btn-primary">Save</button>
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