<?php

function css($name){
    return asset(config('mongicommerce.admin.css'))."/{$name}";
}

function js($name){
    return asset(config('mongicommerce.admin.js'))."/{$name}";
}

function img($name){
    return asset(config('mongicommerce.admin.img'))."/{$name}";
}
function media($name){
    return asset(config('mongicommerce.admin.media'))."/{$name}";
}

function webfonts($name){
    return asset(config('mongicommerce.admin.webfonts'))."/{$name}";
}
