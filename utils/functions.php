<?php 

/**
 * Dump and die
 * @param mixed $data
 * @return void
 */
function dd($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

/**
 * Generate a slug from a string
 * @param string $string
 * @return string
 */
function generateSlug(string $string): string {
    $string = preg_replace('/[^a-z0-9]+/', '-', strtolower(trim($string)));
    return rtrim($string, '-');
}