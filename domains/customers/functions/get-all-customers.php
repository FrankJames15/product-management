<?php
function getAllCustomers()
{
    $conn = Connect();

    $query = "SELECT * FROM customer ORDER BY cus_code DESC";
    $result = $conn->query($query);

    $customers = [];
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
    $conn->close();
    return $customers;
}
