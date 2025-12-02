<?php

function searchByName($customers = [], $name = '')
{
    // normalize search string
    $name = trim((string)$name);

    // if empty search return full list
    if ($name === '') {
        return $customers;
    }

    $results = [];

    foreach ($customers as $customer) {
        // create a single haystack containing first and last name for easier searching
        $first = $customer['cus_fname'] ?? '';
        $last = $customer['cus_lname'] ?? '';
        $code = $customer['cus_code'] ?? '';

        $haystack = $first . ' ' . $last;

        // use strict comparison !== false so matches at position 0 are detected
        if (stripos($haystack, $name) !== false || stripos($code, $name) !== false) {
            $results[] = $customer;
            continue;
        }
    }

    return $results;
}
