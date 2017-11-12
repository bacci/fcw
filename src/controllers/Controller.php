<?php
namespace Fcw\Controllers;

class Controller
{
	protected $app;
	
	public function __construct($app)
	{
		$this->app = $app;
	}
}