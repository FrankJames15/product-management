<?php

function search($vendors = [], $toSearch = '')
{
    // normalize search string
    $toSearch = trim((string)$toSearch);

    // if empty search return full list
    if ($toSearch === '') {
        return $vendors;
    }

    $results = [];

    foreach ($vendors as $vendor) {
        // create a single haystack containing first and last name for easier searching
        $code = $vendor['id'] ?? '';
        $last = $vendor['last_name'] ?? '';
        $first = $vendor['first_name'] ?? '';

        $haystack = $last . $first;

        // use strict comparison !== false so matches at position 0 are detected
        if (stripos($haystack, $toSearch) !== false || stripos($code, $toSearch) !== false) {
            $results[] = $vendor;
            continue;
        }
    }

    return $results;
}
