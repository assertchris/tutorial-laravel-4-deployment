<?php

/*
|--------------------------------------------------------------------------
| Assets
|--------------------------------------------------------------------------
|
| Assets are defined in the following order:
|
| section => asset [ => part of asset (in an array) ]
|
*/

return [
    "header-css" => [
        "css/shared.min.css" => [
            "css/bootstrap.css",
            "css/shared.css"
        ]
    ],
    "footer-js" => [
        "js/shared.min.js" => [
            "js/jquery.js",
            "js/bootstrap.js",
            "js/shared.js"
        ]
    ]
];