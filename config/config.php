<?php

/*
 * You can place your custom package configuration in here. test
 */
return [
    'admin' => [
        'css' => 'mongicommerce/template/admin/css/',
        'js' => 'mongicommerce/template/admin/js/',
        'img' => 'mongicommerce/template/admin/img/',
        'media' => 'mongicommerce/template/admin/media/',
        'webfonts' => 'mongicommerce/template/admin/webfonts/',
    ],
    'details' => [
            "select" => "<select class='form-control mongicommerce_el'></select>",
            "text" => "<input type='text' class='form-control mongicommerce_el'>",
            "number" => "<input type='numer' class='form-control mongicommerce_el'>",
            "checkbox" => "<input type='checkbox' class='form-control mongicommerce_el'>",
            "radio" => "<input type='radio' class='form-control mongicommerce_el'>",
            "textarea" => "<textarea class='form-control mongicommerce_el'></textarea>"
    ]
];
