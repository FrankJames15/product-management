<?php



function addProduct(
    $conn = null,

    // callbacks
    $errorCB = null,
    $successCB = null,

    // payloads
    $name,
    $vendor,
    $description,
    $price,
    $stocks
) {


    $query = "INSERT INTO product
                (p_name, p_vendor, p_descript, p_price, p_qoh )
                VALUES
                ('$name', '$vendor' ,'$description', $price, $stocks )";

    $result = $conn->query($query);
    if (!$result) {
        if ($errorCB) $errorCB($conn->error);
        $conn->close();
        return false;
    }
    $conn->close();
    return true;
}
