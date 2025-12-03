<?php

function deleteInvoice(
    $conn = null,

    // callbacks
    $errorCB = null,
    $successCB = null,

    $id = null // customer id
) {
    $query = "DELETE FROM invoice WHERE inv_number = $id";

    $result = $conn->query($query);

    if (!$result) {
        if ($errorCB) $errorCB($conn->error);
        $conn->close();
        return false;
    }

    if ($successCB) $successCB();
    $conn->close();
    return true;
}
