<?php

function addVendor(
    $conn = null, // connection object

    // callbacks
    $errorCB = null,
    $successCB = null,

    // payloads
    $last_name = null,
    $first_name = null,
    $initial = null,
    $contact = null

) {
    $query = "INSERT INTO vendors
              (last_name, first_name, initial, contact)
              VALUES 
              ('$last_name', '$first_name', '$initial', '$contact')";

    $result = $conn->query($query);

    if (!$result) {
        if ($errorCB) $errorCB($conn->error);
        $conn->close();
        return;
    }

    if ($successCB) $successCB();
    $conn->close();
    return;
}
