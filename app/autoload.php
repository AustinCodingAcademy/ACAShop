<?php

date_default_timezone_set('America/Chicago');

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

function pre($pre, $name)
{
    echo '<h3>' . $name . '</h3>';
    echo '<pre>';
    print_r($pre);
    echo '</pre>';
}

/**
 * @var ClassLoader $loader
 */
$loader = require __DIR__ . '/../vendor/autoload.php';

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

return $loader;
