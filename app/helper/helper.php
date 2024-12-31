<?php

/**
 * @param $uri
 * @return string
 */
//function is_element_active($uri)
//{
//    return preg_match($uri, url()->current()) ? 'm-menu__item--active' : '';
//}
use Illuminate\Support\Str;

function front_url($route)
{
    return url('/public/front/' . $route);
}

function admin_url($route)
{
    return url('/public/'.$route);
}

function panel_url($route)
{
    return url('/public/panel/' . $route);
}
