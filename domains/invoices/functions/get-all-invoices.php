<?php

function getAllInvoices()
{
    $conn = Connect();

    $query = "SELECT invoice.*, customer.cus_fname, customer.cus_lname, customer.cus_initial
                FROM invoice
                JOIN customer ON invoice.cus_code = customer.cus_code";
    $result = $conn->query($query);
    $data = []; //data set
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $conn->close();
    return $data;
}
