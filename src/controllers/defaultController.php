<?php

namespace Fcw\Controllers;

class DefaultController extends Controller
{
	
	public function index()
	{
		echo "INDEX do default";
		$data = array("asd");
		return $this->app->view->render($this->app->response, 'index.phtml', $data);
	}
}