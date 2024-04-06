<?php 

/**
 * Récupère une variable d'environnement.
 * @param string $key La clé de la variable d'environnement
 * @param mixed $default La valeur par défaut à retourner si la variable d'environnement n'est pas définie
 * @return mixed La valeur de la variable d'environnement ou la valeur par défaut si elle n'est pas définie
 */
function env(string $key, $default = null)
{
    $value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);

    if ($value === false) {
        return $default;
    }

    return $value;
}

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