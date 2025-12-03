<?php

function search($products = [], $toSearch = '')
{
    // normalize search string
    $toSearch = trim((string)$toSearch);

    // if empty search return full list
    if ($toSearch === '') {
        return $products;
    }

    $results = [];

    foreach ($products as $product) {
        // create a single haystack containing first and last name for easier searching
        $code = $product['p_code'] ?? '';
        $first = $product['p_name'] ?? '';

        $haystack = $code . $first;

        // use strict comparison !== false so matches at position 0 are detected
        if (stripos($haystack, $toSearch) !== false || stripos($code, $toSearch) !== false) {
            $results[] = $product;
            continue;
        }
    }

    return $results;
}
