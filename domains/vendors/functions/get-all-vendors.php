<?php
function getAllVendors(
    $conn = null,

    // callbacks
    $errorCB = null,
    $successCB = null
) {

    $query = "SELECT * FROM vendors ORDER BY created_at DESC";
    $result = $conn->query($query);

    if (!$result) {
        if ($errorCB) {
            $errorCB($conn->error);
        }
        $conn->close();
        return [];
    }

    $vendors = [];
    while ($row = $result->fetch_assoc()) {
        $vendors[] = $row;
    }
    $conn->close();
    return $vendors;
}
