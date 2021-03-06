<?php

/**
* Controller for all the posts.
**/
class PostController extends Controller {

	public function index() {
		$view = BLOGZA_DIR . "/system/views/Home.view.php";

		$posts = array_reverse(Database::getPosts());

		require $view;
	}

	public function viewPost() {
		$view = BLOGZA_DIR . "/system/views/ViewPost.view.php";

		$id = $this->matched[2];
		$post = Database::getPost($id);
		$posts = array_reverse(Database::getPosts());

		if($post == null) {
			Util::abort(404);
		}

		require $view;
	}

	public function viewComments() {
		$id = $this->matched[2];
		$post = Database::getPost($id);

		if($post == null) {
			Util::abort(404);
		}

		$msg = false;
		$error = false;
		if(Auth::isLogged() && isset($_POST['content'])) {
			if(!CSRFHandler::check()) {
				$error = "CSRF token missing from request; contact blog administrator if in error.";
			} else {
				// Passed CSRF check, you shall now pass.
				$author = Auth::getUsername();
				$content = $_POST['content'];

				Database::createComment($id, $author, $content);

				$msg = "Comment created, awaiting moderator approval.";
			}
		}

		$view = BLOGZA_DIR . "/system/views/ViewComments.view.php";

		CSRFHandler::generate();
		$posts = array_reverse(Database::getPosts());

		$comments = Database::getComments($id);

		require $view;
	}

}