<?php

function getAllProducts()
{
    $conn = Connect();

    $query = "SELECT product.*, vendors.last_name, vendors.first_name, vendors.initial 
            FROM product
            JOIN vendors ON product.p_vendor = vendors.id
            ORDER BY product.p_code DESC
            ";


    $result = $conn->query($query);
    $data = []; //data set
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $conn->close();
    return $data;
}
