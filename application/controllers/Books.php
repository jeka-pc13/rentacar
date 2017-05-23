<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Books_model');
		$this->load->model('Authors_model');
		$this->load->model('Editors_model');
	}
	
	public function index(){
		$this->load->helper('form');

		$search = array();
		$search['author'] = $this->input->get('author')??"";
		$search['title'] = $this->input->get('title')??"";	
		//$search['isbn'] = $this->input->get('isbn')??"";	
		//$search['author'] = $this->input->post('author')??"";	

		$this->load->library('pagination');
		$form_url = "books/index";

		if (count($search) > 0) {
			$form_url .= '?'.http_build_query($search,'',"&");
		}

		$offset = $this->input->get("page")??0;

		$config['base_url'] = base_url($form_url);//redefinido para a paginação
		$config['enable_query_strings']= TRUE;
		$config['page_query_string']= true;
		//$config['base_url'] = base_url("books/index/");//redefinido para a paginação
		
		$config['total_rows'] = $this->Books_model->getBookListCount($search);
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
		


		//var_dump($this->Books_model);
		//$livros=$this->Books_model->getBooksARSimpleQuery();
		//$livros=$this->Books_model->getBooksARQuery();
		//$livros=$this->Books_model->getBooksById(1);
		//$livros=$this->Books_model->getBooksBuilder(2);
		//$livros=$this->Books_model->getBooksBuilder2(2);
		
		//$livros = $this->Books_model->getBookList();
		//$search = array('author'=>'Romulo Gallegos');
		/*$search = array('title'=>'leverage impactful initiatives');
		$livros = $this->Books_model->getBookList($search);*/
		

		//$data['livros']= $livros;		


/*--------------------------------------------------------------------
                      A  U  T  O  R  E  S
                      --------------------------------------------------------------------*/
        //$livros=$this->Authors_model->getAuthorsBuilder(2);
		//$livros=$this->Authors_model->getEditorBuilder();

/*
		$data= array(
			array(
			'idautor'=>7,
			'nome' => "Simao Mata",
			'data_nascimento'=> "1988-04-05",
			'paises_idpais'=> 2),	
		array(
			'idautor'=> 8,
			'nome' => "Julio Rodrigues",
			'data_nascimento'=> "1975-12-08",
			'paises_idpais'=> 2)
			);
		
		$this->Authors_model->createBatch($data);
*/

		
		
/*
		$new_data = array('data_nascimento'=>"2016-12-13");
		$this->Authors_model->updateAuthor(5,$new_data);

		$new_data = array('data_nascimento'=>"2016-12-13");
		$this->Authors_model->updateAuthor(5,$new_data);
*/
	/*
	$data= array(
			array(
			'nome' => "Simao Mata",
			'data_nascimento'=> "2015-04-05"),
		array(
			'nome' => "Julio Rodrigues",
			'data_nascimento'=> "2016-12-08"
			)
		);
		$this->Authors_model->updateAuthorsBatch("nome",$data); 
*/

		//$this->Authors_model->removeAuthors(3); 


		$data['active_menu'] = 'books';
		$data['content']     = 'rentacar/index';
		//add values from the form
		$this->load->view('init',$data);

	}


	public function create(){
		//var_dump($this->input->post());	
		$this->load->model('Editors_model');
		$this->load->model('Authors_model');

		$this->load->helper('form');
		$this->load->library('form_validation');

		//$this->form_validation->set_rules('title', 'Title', 'required');
		//$this->form_validation->set_error_delimiters('<div class="alert alert-danger page-alert">', '</div>');

		$config = array(
			array(
				'field' => 'title',
				'label' => 'Titulo',
				'rules' => 'required|alpha_numeric_spaces',
				'errors' => array(
					'required' => 'É obrigatório indicar um %s.',
					'alpha_numeric_spaces' => 'Contém caracteres inválidos'
					)
				),
			array(
				'field' => 'isbn',
				'label' => 'ISBN',
				'rules' => 'required|min_length[10]|max_length[13]|is_unique[livros.isbn]',
				'errors' => array(
					'required' => 'É obrigatório indicar um %s.',
					'is_unique' => 'Ops! Este ISBN já existe!'
					)
				),
			array(
				'field' => 'authors[]',
				'label' => 'Autor',
				'rules' => 'required|numeric',
				'errors' => array(
					'required' => 'É obrigatório escolher um %s.',
					'numeric' => 'É obrigatório indicar pelo menos um %s.'
					)
				),
			array(
				'field' => 'data_publicacao',
				'label' => 'Data de publicação',
				'rules' => 'required|validateDate',
				'errors' => array(
					'required' => 'É obrigatório inserir a %s.',
					'validateDate' => ' Verifique o formato YYYY-MM-DD '
					)
				),
			array(
				'field' => 'editoras',
				'label' => 'Editora',
				'rules' => 'required|alpha_numeric_spaces',
				'errors' => array(
					'required' => 'É obrigatório escolher uma %s.',
					'alpha_numeric_spaces' => 'Contém caracteres inválidos'
					)
				)
			);

		$this->form_validation->set_rules($config);

		//$data = array();
		//para executar as validaçoes
		if ($this->form_validation->run() == FALSE)
		{
			$data['authors'] = $this->Authors_model->getAll();
			$data['editoras'] = $this->Editors_model->getAll();

			$data['active_menu'] = 'books';
			$data['content']     = 'books/create';
			$this->load->view('init',$data);
		}else{
        	// Adicona livro a database
			$this->Books_model->create($this->input->post());

			$data['active_menu'] = 'books';
			$data['content']     = 'books/create_success';
			$this->load->view('init',$data);      	
		}	
	}



	public function createAjax(){
		//var_dump($this->input->post());	
		$this->load->model('Editors_model');
		$this->load->model('Authors_model');

		$this->load->helper('form');
		$this->load->library('form_validation');

		$config = array(
			array(
				'field' => 'title',
				'label' => 'Titulo',
				'rules' => 'required|alpha_numeric_spaces',
				'errors' => array(
					'required' => 'É obrigatório indicar um %s.',
					'alpha_numeric_spaces' => 'Contém caracteres inválidos'
					)
				),
			array(
				'field' => 'isbn',
				'label' => 'ISBN',
				'rules' => 'required|min_length[10]|max_length[13]|is_unique[livros.isbn]',
				'errors' => array(
					'required' => 'É obrigatório indicar um %s.',
					'min_length' => 'O %s deve conter pelo menos 10 dígitos.',
					'max_length' => 'O %s pode conter até 13 dígitos.',
					'is_unique' => 'Ops! Este %s já existe!'
					)
				),
			array(
				'field' => 'authors[]',
				'label' => 'Autor',
				'rules' => 'required|numeric',
				'errors' => array(
					'required' => 'É obrigatório escolher um %s.',
					'numeric' => 'É obrigatório indicar pelo menos um %s.'
					)
				),
			array(
				'field' => 'data_publicacao',
				'label' => 'Data de publicação',
				'rules' => 'required|validateDate',
				'errors' => array(
					'required' => 'É obrigatório inserir a %s.',
					'validateDate' => ' Verifique o formato YYYY-MM-DD ')
				),
			array(
				'field' => 'editoras',
				'label' => 'Editora',
				'rules' => 'required|alpha_numeric_spaces',
				'errors' => array(
					'required' => 'É obrigatório escolher uma %s.',
					'alpha_numeric_spaces' => 'Contém caracteres inválidos'
					)
				)
			);

		$this->form_validation->set_rules($config);

		//para executar as validaçoes
		if ($this->form_validation->run() == FALSE)
		{
			$data['authors'] = $this->Authors_model->getAll();
			$data['editoras'] = $this->Editors_model->getAll();

			$output = new stdClass();
			$form_status = false;
			$html_result = $this->load->view('books/create',$data,TRUE);
		}else{
        	// Adicona livro a database
        	$form_status = true;
			$this->Books_model->create($this->input->post());
			$this->load->view('books/create_success', $data, TRUE);	

		}
		$output = new stdClass();
		$output->success = $form_status;
		$output->html = $html_result;
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}


}