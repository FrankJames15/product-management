<?php

function search($invoices = [], $toSearch = '')
{
    // normalize search string
    $toSearch = trim((string)$toSearch);

    // if empty search return full list
    if ($toSearch === '') {
        return $invoices;
    }

    $results = [];

    foreach ($invoices as $invoice) {
        // create a single haystack containing first and last name for easier searching
        $code = $invoice['inv_number'] ?? '';
        //$first = $invoice['p_name'] ?? '';

        $haystack = $code; // . $first;

        // use strict comparison !== false so matches at position 0 are detected
        if (
            stripos($haystack, $toSearch) !== false
            // || stripos($code, $toSearch) !== false
        ) {
            $results[] = $invoice;
            continue;
        }
    }

    return $results;
}
