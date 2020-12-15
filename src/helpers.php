<?php

function css($name){
    return config('mongicommerce.admin.css')."/{$name}";
}

function js($name){
    return config('mongicommerce.admin.js')."/{$name}";
}

function img($name){
    return config('mongicommerce.admin.img')."/{$name}";
}
function media($name){
    return config('mongicommerce.admin.media')."/{$name}";
}

function webfonts($name){
    return config('mongicommerce.admin.webfonts')."/{$name}";
}
