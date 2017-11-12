<?php

namespace Fcw\Controllers;

class CadastroController extends Controller
{
	
	public function index()
	{
		echo "INDEX do cadastro";
		$data = array("asd");
		return $this->app->view->render($this->app->response, 'cadastro.phtml', $data);
	}
}