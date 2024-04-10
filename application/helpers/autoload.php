<?php

require_once "base_path.php";

function autoloader($className) {
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);

    $filePath = base_path($className . '.php');
    if (file_exists($filePath)) {
        return require $filePath;
    }
}
