<?php

function replace_strings($string){
    $from = array('é', 'è', 'à', 'ù', 'â', 'ê', 'î', 'ô', 'û', 'ë', 'ï', 'ç', ' ');
    $to   = array('e', 'e', 'a', 'u', 'a', 'e', 'i', 'o', 'u', 'e', 'i', 'c', '_');
    return str_replace($from, $to, $string);
}

function clean_string($string){
    return str_replace(array('(',')','[',']','{','}'), '', replace_strings(strtolower(trim($string))));
}

function joined_ucwords($string)
{
    return str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
}

function joined_ucfirst($string)
{
    return str_replace(' ', '', ucfirst(strtolower(str_replace('_', ' ', $string))));
}

function joined_to_lower($string)
{
    return str_replace(' ', '', strtolower(str_replace('_', ' ', $string)));
}

function underlined($string)
{
    return str_replace(' ', '_', $string);
}

function underlined_to_lower($string)
{
    return strtolower(str_replace(' ', '_', $string));
}

function underlined_ucfirst($string)
{
    return ucfirst(strtolower(str_replace(' ', '_', $string)));
}
