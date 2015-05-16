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
        // assign values from data array to keyname variable
        foreach($this->data as $key=>$val){
            $$key = $val;
        }
        
        include __DIR__.'/../views/'.$viewPath;
    }
}