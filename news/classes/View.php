<?php

class View
{
    protected $data;
    
    public function __set($k ,$v)
    {
        $this->data[$k] = $v;
    }

    public function render($viewPath)
    {
        // assign values from data array to keyname variable (if exists)
        if (sizeof($this->data)){
            foreach ($this->data as $key => $val) {
                $$key = $val;
            }
        }
        include __DIR__.'/../views/'.$viewPath;
    }
}