<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frota extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//$this->load->model('Automovel_model');
		$this->load->model('Cores_model');
		$this->load->model('Fabricantes_model');
		$this->load->model('Modelos_model');
	}
	
		public function index(){
		// var_dump($this->Automovel_model->obterTodosAutomoveis());
		$this->load->helper('form');

		$data['active_menu'] = 'frota';
		$data['content']     = 'frota/index';
		$this->load->view('init',$data);

	}

		



}