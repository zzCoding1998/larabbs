<?php

function route_class()
{
    return str_replace('.','-',\Illuminate\Support\Facades\Route::currentRouteName());
}

function make_excerpt($value,$length=200)
{
    $excerpt = str_replace('/\r\n|\r|\n+/',' ',strip_tags($value));
    return \Illuminate\Support\Str::limit($excerpt,$length);
}
