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
		var_dump($this->Automovel_model->obterListaMatriculas());

		$this->load->library('pagination');
		$form_url = "publico/index";

		if (count($search) > 0) {
			$form_url .= '?'.http_build_query($search,'',"&");
		}

		$offset = $this->input->get("page")??0;

		$config['base_url'] = base_url($form_url);//redefinido para a paginação
		$config['enable_query_strings']= TRUE;
		$config['page_query_string']= true;
		
		$config['total_rows'] = $this->Automovel_model->obterAutomoveisPorFiltro($search);
		$this->pagination->initialize($config);
		$config['per_page'] = ITEMS_PER_PAGE;

		$data['title']= $this->input->get('title');
		$data['author']= $this->input->get('author');
		$data['author']= $this->input->get('author');
        

		$data['search_results_count'] = $config['total_rows'];
		$data['search_pagination'] = $this->pagination->create_links();
		$data['search_results'] = $this->Automovel_model->obterAutomoveisPorFiltro($search, $offset);

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
