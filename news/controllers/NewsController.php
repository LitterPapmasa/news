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
                $error = 'Error. Article hasn\'t been add.';
                $view->message = $error;
                Log::write($error . " | \$news->insert error (MySQL)");
            }

        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               $error = 'Error. Article hasn\'t been add.';
               $view->message = $error;
               Log::write($error . " | Empty \$postData in [text or header] insertAction");
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
    		    $error = 'Error. Article hasn\'t been updated.';
    			$view->message = $error;
    			Log::write($error . " | \$news->update error, empty field(s)");
    		}
    	} elseif  (!is_numeric($postData['id']) or !Filter::isNumericAdd($postData['id'])) {
    		$error = 'Error. Wrong id! (Integer only)';
    	    $view->message = $error;
    	    Log::write($error . " | \$news->update error, id is not numeric");
    	} else {

    		$postData['date'] = date("Y-m-d H:i:s");

    		$news = new News;
    		if ($data = $news->update($postData) !== false) {
    			// Add input id in form
    			$view->lastId = $news->getLastId();
    			$view->message = 'Article "' . $postData['header'] . '" has been updated.';
    		} else {
    		    $error = 'Error. Article hasn\'t been updated.';
    			$view->message = $error;
    			Log::write($error . " | \$news->update error (MySQL)");
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
      	// Delete from table (DB)
      	if ($news->delete() == false) {
      	    $error = 'Error. Article hasn\'t been deleted.';
      	    $view->message = $error;
      	    Log::write($error . " | \$news->delete error (MySQL)");
      	}

    	$this->viewAction();

    }
    // CRUD ACTIONS end =====================================================



}

