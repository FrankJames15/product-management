<?php

function deleteVendor(
    $conn = null,

    // callbacks
    $errorCB = null,
    $successCB = null,

    $id = null // vendor id
) {
    $query = "DELETE FROM vendors WHERE id = $id";

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
