<?php

class NewsController
{
    
    public function indexAction()
    {
		$this->viewAction();
    }
    
    
    public function viewAction()
    {
    	$items = News::view();
    	$view = new View;
    	
    	$view->items = $items;    	
    	
    	$view->render("news/news-view.php");
    }
    
    
    public function getPost()
    {
    	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    		
    		$postData = [];
    		foreach ($_POST as $key=>$value){    			
    			$postData[$key] = Filter::input($value);
    		}
    		return $postData;
    	} else {
    		return false;
    	}
    		 
    }
    
    
    public function insertAction()
    {	
    	$view = new View;
    	
    	// Get our POST from form news-form.php to array
    	$postData = $this->getPost();
    	
    	if (!empty($postData['header']) and !empty($postData['text'])) {
            
    		$postData['date'] = date("Y-m-d H:i:s");
    		
            $news = new News;
            if ($data = $news->insert($postData) !== false) {				            	
            	$view->lastId = $news->getLastId();
                $view->message = 'Article "' . $postData['header'] . '" has been added.';
            } else {
                $view->message = 'Error. Article hasn\'t been add.';
            }			                                  

        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               $view->message = 'Error. Article hasn\'t been add.';
            }           
        }
        
        $view->render("forms/news-form.php");

    }
    
    public function updateAction()
    {
    	$view = new View;
    	 
    	// Get our POST from form news-form.php to array
    	$postData = $this->getPost();
    	 
    	if (!empty($postData['header']) and !empty($postData['text'])) {
    
    		$postData['date'] = date("Y-m-d H:i:s");
    
    		$news = new News;
    		if ($data = $news->update($postData) !== false) {

    			// add input id in form    			
    			
    			$view->lastId = $news->getLastId();
    			$view->message = 'Article "' . $postData['header'] . '" has been updated.';
    		} else {
    			$view->message = 'Error. Article hasn\'t been updated.';
    		}
    
    	} else {
    		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    			$view->message = 'Error. Article hasn\'t been updated.';
    		}
    	}
    	$view->update = true;
    	$view->render("forms/news-form.php");
    
    }
    
    
}

