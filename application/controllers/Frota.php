<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frota extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('automovel_model');

		$this->load->model('cores_model');
		$this->cores_model->init(array('tabela' =>"cores"));

		$this->load->model('fabricantes_model');
		$this->fabricantes_model->init(array('tabela' =>"fabricantes"));

		$this->load->model('modelos_model');
		$this->modelos_model->init(array('tabela' =>"modelos"));
	}
	
	/**
	 * Filtra a pesquisa
	 * @return [type] [description]
	 */
	public function pesquisa(){

		$this->load->helper('form');
		$search = array();
		$filtro= $this->input->get('filtro')??"";
		$search['filtro'] = $this->input->get('filtro')??"";
		$search['search'] = $this->input->get('search')??"";
		$search[$filtro] = $this->input->get('search')??"";
		$this->load->library('pagination');
		$form_url = "frota/pesquisa";

		if (count($search) > 0) {
			$form_url .= '?'.http_build_query($search,'',"&");
		}

		$offset = $this->input->get("page")??0;

		$config['base_url'] = base_url($form_url);//redefinido para a paginação
		$config['enable_query_strings']= TRUE;
		$config['page_query_string']= true;
		$config['per_page'] = ITEMS_PER_PAGE;
		$config['total_rows'] = $this->automovel_model->getAutomoveisListCount($search);
		$this->pagination->initialize($config);
		

		// $data['cores']= $this->input->get('cores');//ALTERAR
		// $data['fabricantes']= $this->input->get('fabricantes');//ALTERAR
  //       $data['modelos']= $this->input->get('modelos');

		$data['search_results_count'] = $config['total_rows'];
		$data['search_pagination'] = $this->pagination->create_links();
		$data['search_results'] = $this->automovel_model->obterAutomoveisPorFiltro($search, $offset);

		//carregar view
		$data_modal['cores'] = $this->cores_model->getAll();
		$data_modal['fabricantes'] = $this->fabricantes_model->getAll();
		$data_modal['modelos'] = $this->modelos_model->getAll();
		$data['create_modal'] = $this->load->view('frota/adicionar', $data_modal, TRUE);
		if ($this->input->post('success')??FALSE) {
			$data_modal['success'] = true;
		}
		$data['active_menu'] = 'books';
		$data['content']     = 'frota/pesquisa';
		//add values from the form
		$this->load->view('init',$data);

	}

	/*

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
*/
	public function adicionar(){
		//var_dump($this->input->post());	

		$this->load->model('cores_model');
		$this->cores_model->init(array('tabela' =>"cores"));

		$this->load->model('fabricantes_model');
		$this->fabricantes_model->init(array('tabela' =>"fabricantes"));

		$this->load->model('modelos_model');
		$this->modelos_model->init(array('tabela' =>"modelos"));

		$this->load->helper('form');
		$this->load->library('form_validation');

		//$this->form_validation->set_rules('title', 'Title', 'required');
		//$this->form_validation->set_error_delimiters('<div class="alert alert-danger page-alert">', '</div>');

		$config = array(
			array(
				'field' => 'modelo',
				'label' => 'Modelo',
				'rules' => 'required|alpha_numeric_spaces',
				'errors' => array(
					'required' => 'É obrigatório indicar um %s.',
					'alpha_numeric_spaces' => 'Contém caracteres inválidos'
					)
				),
			array(
				'field' => 'matricula',
				'label' => 'Matrícula',
				'rules' => 'required|exact_length[8]|is_unique[automoveis.matricula]',
				'errors' => array(
					'required' => 'É obrigatório inserir uma %s.',
					'exact_length' => 'Verifique o número de caracteres(XX-XX-XX)',
					'is_unique' => 'Ops! Esta %s já está registrada!'
					)
				),
			array(
				'field' => 'cor',
				'label' => 'Cor',
				'rules' => 'required',
				'errors' => array(
					'required' => 'É obrigatório escolher uma %s.',
					)
				),
			array(
				'field' => 'estado',
				'label' => 'Disponilidade',
				'rules' => 'required',
				'errors' => array(
					'required' => 'É obrigatório indicar a %s do automóvel.',
					)
				)
			);

		$this->form_validation->set_rules($config);

		//$data = array();
		//para executar as validaçoes
		if ($this->form_validation->run() === FALSE)
		{			
			$data['cores'] = $this->cores_model->getAll();
			$data['fabricantes'] = $this->fabricantes_model->getAll();
			$data['modelos'] = $this->modelos_model->getAll();

			$data['active_menu'] = 'books';
			$data['content']     = 'frota/adicionar';
			$this->load->view('init',$data);
		}else{
        	// Adiciona livro a database
			
			//var_dump($this->input->post());
			$datos = array(
				"modelo"=> $this->input->post('modelo'),
				"cor"=> $this->input->post('cor'),
				"estado"=> $this->input->post('estado'),
				"matricula"=> $this->input->post('matricula')
				);
			$this->automovel_model->create($datos);
			
			// $data['active_menu'] = 'books';
			// $data['content']     = 'frota/pesquisa';
			// $data['success']     = true;
			// $this->load->view('init',$data);      	
			//$this->pesquisa();
			redirect('frota/pesquisa'.$this->input->post('success'));
		}	
	}
}