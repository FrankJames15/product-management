<?php
function addInvoice(
    $conn = null,

    // callbacks
    $errorCB = null,
    $successCB = null,

    // payloads
    $customer = null,
    $subtotal = null,
    $tax = null,
    $total = null,
) {


    $query = "INSERT INTO invoice
                (cus_code, inv_subtotal, inv_tax, inv_total )
                VALUES
                ($customer, $subtotal ,$tax, $total )";

    $result = $conn->query($query);
    if (!$result) {
        if ($errorCB) $errorCB($conn->error);
        $conn->close();
        return false;
    }

    if ($successCB) {
        successCB();
    }

    $conn->close();
    return true;
}
