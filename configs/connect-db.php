<?php

const HOST = 'localhost'; //Server's IP or localhost
const USER = 'root'; //DB User ex root
const PWD = '';
const DBNAME = 'salecodb';

function Connect()
{
    $conn = new mysqli(HOST, USER, PWD, DBNAME);
    if ($conn->connect_error) {
        die('Error Connection');
        exit;
    }
    return $conn;
}
