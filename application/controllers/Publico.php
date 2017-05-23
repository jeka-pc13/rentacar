<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publico extends CI_Controller {


	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$data['active_menu'] = 'home';
		$data['content']     = 'home';
		$this->load->view('init',$data);
	}

	public function sobre(){
		$data['active_menu'] = 'about';
		$data['content']     = 'about';
		$this->load->view('init',$data);
	}

	public function contacto(){
		$data['active_menu'] = 'contact';
		$data['content']     = 'contact';
		$this->load->view('init',$data);
	}
}
