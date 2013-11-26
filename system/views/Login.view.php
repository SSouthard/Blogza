<?php

$view = new View(BLOG_TEMPLATE);

$view->setTitle("Login");

$vars = array(
	"posts" => $posts,
	"error" => $error,
	);

$view->setVariable($vars);

$pages = array(
	"header.tpl",
	"navigation.tpl",
	"sidebar.tpl",
	"login.tpl",
	"footer.tpl",
	);

foreach($pages as $page) {
	$view->loadPage($page);
}