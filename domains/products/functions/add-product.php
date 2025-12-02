<?php



function addProduct($errCB = null, $pcode, $desc, $price, $stocks)
{
    $conn = Connect();

    $query = "INSERT INTO product
                (p_code, p_descript, p_qoh, p_price)
                VALUES
                ('$pcode','$desc', $stocks, $price)";
    $result = $conn->query($query);
    if (!$result) {
        if ($errCB) $errCB($conn->error);
        $conn->close();
        return false;
    }
    $conn->close();
    return true;
}
