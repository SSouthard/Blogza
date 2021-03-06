<?php

/**
* View class, used for managing Views and loading Template files.
*
* @author	boboman13 <me@boboman13.net>
* @version	1.0
**/
class View {

	protected $template;
	protected $dir;

	protected $smarty;

	/**
	* Creates the TemplateManager instance.
	*
	* @access 	public
	* @return	void
	**/
	public function __construct($template = "default") {
		if($template == null) {
			throw new Exception("The template cannot be null!");
		}
		$this->template = $template;

		// Load the Smarty Template files.
		define("SMARTY_DIR", BLOGZA_DIR . "/system/views/smarty/libs/");
		require SMARTY_DIR . "Smarty.class.php";

		// Create Smarty!
		$this->smarty = new Smarty();

		$this->smarty->setTemplateDir(BLOGZA_DIR . "/templates/" . BLOG_TEMPLATE . "/");
		$this->smarty->setCompileDir (BLOGZA_DIR . "/system/views/smarty/templates_c");
		$this->smarty->setConfigDir  (BLOGZA_DIR . "/system/views/smarty/configs/");
		$this->smarty->setCacheDir   (BLOGZA_DIR . "/system/views/smarty/cache/");

		$this->smarty->error_reporting = E_ALL & ~E_NOTICE; 

		$this->addVariables();

		$this->smarty->muteExpectedErrors();
	}

	/**
	* Sets the page title.
	*
	* @access 	public
	* @param 	string 	$title 	The title of the page.
	* @return 	void
	**/
	public function setTitle($title) {
		$this->smarty->assign("title", " | " . $title);
	}

	/**
	* Loads a page into the cache.
	*
	* @access	public
	* @param 	string 	$page 		The page that should be loaded.
	* @return	void
	**/
	public function loadPage($page) {
		$this->smarty->display($page);
	}

	/**
	* Sets the custom variable array for the View
	*
	* @access 	public
	* @param 	array 	$val 	The array of variables used. '$vars'
	* @return 	void
	**/
	public function setVariable($val) {
		$this->smarty->assign("vars", $val);
	}

	private function addVariables() {
		$this->smarty->assign("blog",
			array(
				"name" => BLOG_NAME,
				"folder" => BLOG_URL,
				"url" => BLOG_NICE_URLS ? BLOG_URL : BLOG_URL . "/index.php",
				"description" => BLOG_DESC,
				));

		$this->smarty->assign("title", "");

		$this->smarty->assign("stats", array(
			"queries" => Database::$queries,
			"time" => round(microtime() - Blogza::$start, 5),
			));

		$this->smarty->assign("user",
			array(
				"user" => Auth::getUsername(),
				"rank" => Auth::getRank(),
				));

		$this->smarty->assign("template",
			array(
				"name" => $this->template,
				));

		$this->smarty->assign("util",
			array(
				"date" => date("M-D-Y"),
				"dateyear" => date("Y"),
			));

		$this->smarty->assign("protect",
			array(
				"csrf_token" => CSRFHandler::generate(),
				"captcha_question" => CAPTCHAHandler::generate(),
				));

	}
	
}