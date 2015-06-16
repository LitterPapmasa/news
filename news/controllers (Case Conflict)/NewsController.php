<?php

class NewsController
{
    
    public function indexAction()
    {
		$this->viewAction();
    }
    
    // CRUD ACTIONS start =====================================================
    public function viewAction()
    {
    	$posts = Request::getPost();
    	if (!empty($posts['column']) or !empty($posts['searchValue']) 
    			or $posts['searchValue'] == '0') {
    		$items = News::findByColumn($posts['column'], $posts['searchValue']);
    	} else {    		
    		$items = News::view();
    	}
    	$view = new View;
    	$view->items = $items;    	
    	
    	$view->render("news/news-view.php");
    }
         
 
    public function insertAction()
    {	
    	$view = new View;
    	        	
    	Auth::authOnly($view);
    	
    	// Get our POST from form news-form.php to array
    	$postData = Request::getPost();
    	
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
    	Auth::authOnly($view);
    	// Get our POST from form news-form.php to array
    	$postData = Request::getPost();  	

    	if (empty($postData['header']) or empty($postData['text'])
    			or empty($postData['id'])) {
    		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    			$view->message = 'Error. Article hasn\'t been updated.';
    		}
    	} elseif  (!is_numeric($postData['id']) or !Filter::isNumericAdd($postData['id'])) {
    		$view->message = 'Error. Wrong id! (Integer only)';
    	} else {

    		$postData['date'] = date("Y-m-d H:i:s");
    
    		$news = new News;
    		if ($data = $news->update($postData) !== false) {
    			// add input id in form    			    			
    			$view->lastId = $news->getLastId();
    			$view->message = 'Article "' . $postData['header'] . '" has been updated.';
    		} else {
    			$view->message = 'Error. Article hasn\'t been updated.';
    		}
    	}
    	$view->update = true;
    	$view->render("forms/news-form.php");
    
    }
    
    public function deleteAction()
    {
    	$view = new View;
    	Auth::authOnly($view);
    	
      	$news = new News;        	
      	$news->delete();    	
      	   					
    	$this->viewAction();
    
    }
    // CRUD ACTIONS end =====================================================   

    
    
}

