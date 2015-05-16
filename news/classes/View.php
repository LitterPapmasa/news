<?php

class View
{
    protected $data;
    
    public function assign($var, $val)
    {
        $this->data[$var] = $val;    
    }

    public function render($viewPath)
    {
        include __DIR__.'/../views/'.$viewPath;
    }
}