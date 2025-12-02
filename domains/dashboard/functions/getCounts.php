<?php

function getCount($conn, $table)
{
    $sql = "SELECT COUNT(*) AS total FROM `$table`";
    $result = $conn->query($sql);

    if (!$result) {
        die("Query error: " . $conn->error);
    }

    $row = $result->fetch_assoc();
    return $row['total'];
}
