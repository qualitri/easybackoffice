<?php

function replace_strings($string){
    $from = array('é', 'è', 'à', 'ù', 'â', 'ê', 'î', 'ô', 'û', 'ë', 'ï', 'ç', ' ');
    $to   = array('e', 'e', 'a', 'u', 'a', 'e', 'i', 'o', 'u', 'e', 'i', 'c', '-');
    return str_replace($from, $to, $string);
}

function clean_string($string){
    return str_replace(array('(',')','[',']','{','}',' '), '', replace_strings(trim($string)));
}