<?php

function deleteProduct($pcode)
{
    $conn = Connect();

    $query = "DELETE FROM product WHERE p_code='$pcode'";
    $result = $conn->query($query);
    $conn->close();
    if ($result) return true;

    return false;
}
