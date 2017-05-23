<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publico extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Automovel_model');
			// var_dump($this->db);
			// var_dump($this->db->conn_id)
	}
	
	public function index(){
		// var_dump($this->Automovel_model->obterTodosAutomoveis());
		$search = array('fabricante' => "Toyota");
		// var_dump($this->Automovel_model->obterAutomoveisPorFiltro($search));
		//var_dump($this->Automovel_model->obterListaMatriculas());
		$data['active_menu'] = 'home';
		$data['content']     = 'home';
		$this->load->view('init',$data);
	}

	public function sobre(){
		$data['active_menu'] = 'about';
		$data['content']     = 'sobre';
		$this->load->view('init',$data);
	}

	public function contacto(){
		$data['active_menu'] = 'contact';
		$data['content']     = 'contacto';
		$this->load->view('init',$data);
	}
}
