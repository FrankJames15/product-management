<?php

// include '../../../configs/connect-db.php';

function findProducts($find)
{
    $conn = Connect();

    $query = "SELECT * FROM product WHERE p_descript LIKE '%$find%'";
    $result = $conn->query($query);
    $data = []; //data set
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $conn->close();
    return $data;
}
