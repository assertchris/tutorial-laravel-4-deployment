<?php

Form::macro("assets", function($section) {

    $markup = "";
    $assets = Config::get("asset");

    if (isset($assets[$section]))
    {
        foreach ($assets[$section] as $key => $value)
        {
            $use = $value;

            if (is_string($key))
            {
                $use = $key;
            }

            if (ends_with($use, ".css"))
            {
                $markup .= "<link rel='stylesheet' type='text/css' href='" . asset($use) . "' />";
            }

            if (ends_with($use, ".js"))
            {
                $markup .= "<script type='text/javascript' src='" . asset($use) . "'></script>";
            }
        }
    }

    return $markup;

});