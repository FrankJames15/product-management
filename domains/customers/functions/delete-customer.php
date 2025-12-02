<?php

function deleteCustomer(
    $conn = null,

    // callbacks
    $err_cb = null,
    $succ_cb = null,

    $id = null // customer id
) {
    $query = "DELETE FROM customer WHERE `customer`.`cus_code` = $id";

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
