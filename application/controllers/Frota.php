<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frota extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Automovel_model');
		$this->load->model('Cores_model');
		$this->load->model('Fabricantes_model');
		$this->load->model('Modelos_model');
	}
	
	/**
	 * Filtra a pesquisa
	 * @return [type] [description]
	 */
	public function pesquisa(){
		$this->load->helper('form');
		var_dump($this->input->get()??"");
		$search = array();
		$filtro= $this->input->get('filtro')??"";
		$search[$filtro] = $this->input->get('search')??"";
		var_dump($search);
		//$search['matricula'] = $this->input->get('search')??"";	
		//$search['modelo'] = $this->input->get('search')??"";




		$this->load->library('pagination');
		$form_url = "frota/pesquisa/";

		if (count($search) > 0) {
			$form_url .= '?'.http_build_query($search,'',"&");
		}

		$offset = $this->input->get("page")??0;

		$config['base_url'] = base_url($form_url);//redefinido para a paginação
		$config['enable_query_strings']= TRUE;
		$config['page_query_string']= true;

		$config['total_rows'] = 100;
		$config['total_rows'] = $this->Automovel_model->getAutomoveisListCount($search);
		$this->pagination->initialize($config);
		$config['per_page'] = ITEMS_PER_PAGE;

		$data['title']= $this->input->get('title');
		$data['author']= $this->input->get('author');
        //$data['isbn']= $this->input->get('isbn');

		$data['search_results_count'] = $config['total_rows'];
		$data['search_pagination'] = $this->pagination->create_links();
		$data['search_results'] = $this->Automovel_model->obterAutomoveisPorFiltro($search, $offset);

		//carregar view
		//$data_modal['authors'] = $this->Cores_model->getAll();
		$data_modal['editoras'] = $this->Modelos_model->getAll();
		$data_modal['editoras'] = $this->Fabricantes_model->getAll();
		//$data['create_modal'] = $this->load->view('frota/criar', $data_modal, TRUE);

		$data['active_menu'] = 'books';
		$data['content']     = 'frota/pesquisa';
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