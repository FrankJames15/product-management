<?php
// this function require a connection object from `new mysqli`
function updateCustomer(
    $conn = null,

    // callbacks
    $err_cb = null,
    $succ_cb = null,

    // INPUTS
    $id = null,
    $last_name = null,
    $first_name = null,
    $initial = null,
    $area_code = null,
    $phone = null,
) {

    $query = "UPDATE customer
              SET 
                cus_lname = '$last_name', 
                cus_fname = '$first_name', 
                cus_initial = '$initial', 
                cus_areacode = '$area_code', 
                cus_phone = '$phone'
              WHERE  cus_code = '$id'";

    $result = $conn->query($query);

    if (!$result) {
        if ($err_cb) $err_cb($conn->error);
        $conn->close();
        return false;
    }

    if ($succ_cb) $succ_cb();
    $conn->close();
    return true;
}
