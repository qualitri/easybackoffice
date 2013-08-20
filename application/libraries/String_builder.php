<?php

class String_builder
{
    private $string;

    public function __construct()
    {
        $this->string = '';
    }

    public function append($string)
    {
        $this->string .= $string;
    }

    public function prepend($string)
    {
        $this->string = $string.$this->string;
    }

    public function get_string()
    {
        return $this->string;
    }

    public function flush_string()
    {
        $this->string = '';
    }
}
