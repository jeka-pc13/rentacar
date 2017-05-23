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
	
		public function pesquisa(){
		// var_dump($this->Automovel_model->obterTodosAutomoveis());
		$this->load->helper('form');

		$data['active_menu'] = 'books';
		$data['content']     = 'frota/pesquisa';
		$this->load->view('init',$data);
		$this->load->helper('form');

		$search = array();
		$search['fabricante'] = $this->input->get('fabricante')??"";
		$search['matricula'] = $this->input->get('matricula')??"";	
		$search['modelo'] = $this->input->get('modelo')??"";	


		$this->load->library('pagination');
		$form_url = "frota/";

		if (count($search) > 0) {
			$form_url .= '?'.http_build_query($search,'',"&");
		}

		$offset = $this->input->get("page")??0;

		$config['base_url'] = base_url($form_url);//redefinido para a paginação
		$config['enable_query_strings']= TRUE;
		$config['page_query_string']= true;
				
		$config['total_rows'] = $this->Automovel_model->getAutomoveisListCount($search);
		$this->pagination->initialize($config);
		$config['per_page'] = ITEMS_PER_PAGE;

		$data['title']= $this->input->get('title');
		$data['author']= $this->input->get('author');
        //$data['isbn']= $this->input->get('isbn');

		$data['search_results_count'] = $config['total_rows'];
		$data['search_pagination'] = $this->pagination->create_links();
		$data['search_results'] = $this->Books_model->getBookList($search, $offset);

		//carregar view
		$data_modal['authors'] = $this->Authors_model->getAll();
		$data_modal['editoras'] = $this->Editors_model->getAll();
		$data['create_modal'] = $this->load->view('books/create', $data_modal, TRUE);

		$data['active_menu'] = 'books';
		$data['content']     = 'rentacar/index';
		//add values from the form
		$this->load->view('init',$data);

	}

	public function editar($id_automovel = 0){
		$data['id_automovel'] = $id_automovel;
		$data['active_menu'] = 'frota';
		$data['content']     = 'frota/editar';
		$this->load->view('init',$data);

	}

	public function remover($id_automovel = 0){
		$data['id_automovel'] = $id_automovel;
		$data['active_menu'] = 'frota';
		$data['content']     = 'frota/remover';
		$this->load->view('init',$data);

	}

		



}