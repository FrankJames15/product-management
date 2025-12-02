<?php

function addCustomer(
    $conn = null, // connection object

    // callbacks
    $err_cb = null,
    $succ_cb = null,

    // payloads
    $last_name = null,
    $first_name = null,
    $initial = null,
    $area_code = null,
    $phone = null,

) {
    $query = "INSERT INTO customer
              (cus_lname, cus_fname, cus_initial, cus_areacode, cus_phone)
              VALUES 
              ('$last_name', '$first_name', '$initial', '$area_code', '$phone')";

    $result = $conn->query($query);

    if (!$result) {
        if ($err_cb) $err_cb($conn->error);
        $conn->close();
        return;
    }

    if ($succ_cb) $succ_cb();
    $conn->close();
    return;
}
