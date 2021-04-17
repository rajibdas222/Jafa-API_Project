<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Test extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('barcode'));
		
	}
	
	public function index()
	{
		$this->barcode->test_method();	
		echo "Ahsan Ullah";
	}
}