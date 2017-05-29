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

		$this->load->library("session");
		$this->load->helper('form');
		$this->load->library('form_validation');
	}
	
	public function index(){
		redirect('frota/pesquisa','refresh');
	}


	/**
	 * Filtra a pesquisa
	 * @return [type] [description]
	 */
	public function pesquisa(){
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
  		// $data['modelos']= $this->input->get('modelos');

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

	

	public function editar($id_automovel = 1){
		//var_dump($id_automovel);
		
		$whiteListModelos = $this->modelos_model->getListID();
		$whiteListCores = $this->cores_model->getListID();
		
		$data['cores'] = $this->cores_model->getAll();
		$data['fabricantes'] = $this->fabricantes_model->getAll();
		$data['modelos'] = $this->modelos_model->getAll();

		$data['active_menu'] = 'books';
		$data['id_automovel'] = $id_automovel;
		$data['content']     = 'frota/adicionar';
		$data['formulario']     = 'editar';
		$data['auto']     = $this->automovel_model->getCarroById($id_automovel);
		$this->load->view('init',$data);
	}	


	public function remover($id_automovel=1){

		$data['id_automovel'] = $id_automovel;
		$data['active_menu'] = 'frota';
		$data['content']     = 'frota/remover';
		$data['auto']     = $this->automovel_model->getCarroById($id_automovel);
		
		$data['create_modal'] = $this->load->view('books/create', $data, TRUE);
		$this->load->view('frota/remover',$data);

	}

	public function delete($id_automovel=1){

		redirect('frota/pesquisa','refresh');
	}

	public function adicionar(){
		$autoDummy = new stdClass();
		$autoDummy->id =NULL;
		$autoDummy->modelo_id =0;
		$autoDummy->cor_id =0;
		$autoDummy->disponibilidade =1;
		$autoDummy->matricula =NULL;

		$data['cores'] = $this->cores_model->getAll();
		$data['fabricantes'] = $this->fabricantes_model->getAll();
		$data['modelos'] = $this->modelos_model->getAll();

		$data['active_menu'] = 'books';
		$data['content']     = 'frota/adicionar';
		$data['formulario']     = 'adicionar';
		$data['id_automovel'] = NULL;
		$data['auto']     = $autoDummy;
		$this->load->view('init',$data);
		
	}

	public function escrita(){
		//var_dump($this->input->post('id'));
		// $novo = $this->input->post('id')?? $this->input->post('id') : NULL;
		$whiteListModelos = $this->modelos_model->getListID();
		$whiteListCores = $this->cores_model->getListID();
		$id = $this->input->post('id')?? NULL;
		$regraMatricula = "";
		if (is_null($id)){//modo criacao
			$regraMatricula = "|is_unique[automoveis.matricula]";

		}/*else{//modo edicao

		}*/
		$config = array(
			array(
				'field' => 'modelo',
				'label' => 'Modelo',
				'rules' => 'required|in_list['.$whiteListModelos.']',
				'errors' => array(
					'required' => 'É obrigatório indicar um %s.',
					'in_list' => 'É obrigatório indicar um %s da lista.',
					'alpha_numeric_spaces' => 'Contém caracteres inválidos'
					)
				),
			array(
				'field' => 'matricula',
				'label' => 'Matrícula',
				'rules' => 'required|exact_length[8]|validateMatricula'.$regraMatricula,
				'errors' => array(
					'required' => 'É obrigatório inserir uma %s.',
					'exact_length' => 'Verifique o número de caracteres(XX-XX-XX)',
					'is_unique' => 'Ops! Esta %s já está registrada!',
					'validateMatricula' => 'Ops! Este formato de %s não é válido!'
					)
				),
			array(
				'field' => 'cor',
				'label' => 'Cor',
				'rules' => 'required|in_list['.$whiteListCores.']',
				'errors' => array(
					'required' => 'É obrigatório escolher uma %s.',
					'in_list' => 'É obrigatório escolher uma %s da lista.',
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

		if ($this->form_validation->run() === FALSE){
		//Passou todas as validacoes, pelo que se pode fazer o insert/update
			if (is_null($id)){// se nao existe o id o pretendido e adicionar o novo automovel
				$this->adicionar();
			}else{//caso existir entao o pretendido e editar o automovel
				$this->editar();
			}

		}else{// nesta fase sao passadas todas as validacoes, pelo que o pretendido e ou bem inserir o novo automovel ou bem atualizar o existente

			if (!is_null($id)){//se o id existe e porque se trata de um update
				$datos = array(
					"modelo_id"=> $this->input->post('modelo'),
					"cor_id"=> $this->input->post('cor'),
					"disponibilidade"=> $this->input->post('estado'),
					"matricula"=> $this->input->post('matricula')
					);
				$this->automovel_model->editarAutomovel($id, $datos);
				//var_dump($datos);
				$this->session->set_flashdata('event', 'Automóvel modificado com sucesso!');

			}else{//caso contrario trata-se de um insert
				$datos = array(
					"modelo"=> $this->input->post('modelo'),
					"cor"=> $this->input->post('cor'),
					"estado"=> $this->input->post('estado'),
					"matricula"=> $this->input->post('matricula')
					);
				$this->automovel_model->create($datos);
				$this->session->set_flashdata('event', 'Automóvel criado com sucesso!');
			}
			redirect('frota/pesquisa');
		}	
	}
}