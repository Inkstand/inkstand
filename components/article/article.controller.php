<?php

require_once DIR . '/components/controller.php';

class ArticleController extends Controller
{

	public function __construct($args = null)
    {
        parent::__construct($args);
    }
    
	public function index() {

		require_once 'article.lib.php';

		$this->viewdata->articles = getArticleList();

		return parent::view();
	}

	public function read() {

		require_once 'article.lib.php';

		$articleid = $this->args[0];

		if(empty($articleid)) {
			header("Location: " . WWW . "/index.php/article");
			die();
		}

		$this->viewdata->article = getArticle($articleid); 

		return parent::view();
	}
}

?>