<?php

require_once "base_path.php";

function view($path, $attributes = [], $alert = null)
{
    extract($attributes);

    require base_path('App/Views/' . $path . '.view.php');
    if($alert !== '' && $alert !==null) echo $alert;
}
