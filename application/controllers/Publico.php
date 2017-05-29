<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publico extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Automovel_model');

		$this->load->model('modelos_model');
		$this->modelos_model->init(array('tabela' => "modelos"));

		$this->load->model('cores_model');
		$this->cores_model->init(array('tabela' => "cores"));

		$this->load->model('fabricantes_model');
		$this->fabricantes_model->init(array('tabela' => "fabricantes"));

			// var_dump($this->db);
			// var_dump($this->db->conn_id)
			$this->load->helper('form');
$this->load->library('form_validation');
$this->load->library('encrypt');
$this->load->helper('security');

	}
	
	public function index(){
		// var_dump($this->Automovel_model->obterTodosAutomoveis());
		//$search = array('fabricante' => "Toyota");
		//var_dump($this->Automovel_model->obterAutomoveisPorFiltro($search));
		//var_dump($this->Automovel_model->obterListaMatriculas());
		$data['active_menu'] = 'home';
		$data['content']     = 'home';
		$this->load->view('init',$data);
	}
	public function home(){
		// var_dump($this->Automovel_model->obterTodosAutomoveis());
		//$search = array('fabricante' => "Toyota");
		//var_dump($this->Automovel_model->obterAutomoveisPorFiltro($search));
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
		$search = array('fabricante' => "Toyota");
		// 
		
		// $search = array('matricula' => "v");
		//var_dump($this->Automovel_model->obterAutomoveisPorFiltro($search));
		//var_dump($this->Automovel_model->obterTodosAutomoveis());
		$data['active_menu'] = 'contact';
		$data['content']     = 'contacto_prueba';
		$this->load->view('init',$data);
	}

	// Send Gmail to another user
	public function Send_Mail() {

// Check for validation
		$this->form_validation->set_rules('user_email', 'User Email', 'trim|required|xss_clean');
		$this->form_validation->set_rules('user_password', 'User Password', 'trim|required');//|xss_clean');
		$this->form_validation->set_rules('to_email', 'To', 'trim|required');//|xss_clean');
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required');//|xss_clean');
		$this->form_validation->set_rules('message', 'Message', 'trim|required');//|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			//$this->load->view('view_form');
			$data['active_menu'] = 'contact';
		$data['content']     = 'contacto_prueba';
		$this->load->view('init',$data);
		} else {

// Storing submitted values
			$sender_email = $this->input->post('user_email');
			$user_password = $this->input->post('user_password');
			$receiver_email = $this->input->post('to_email');
			$username = $this->input->post('name');
			$subject = $this->input->post('subject');
			$message = $this->input->post('message');

// Configure email library
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'ssl://smtp.googlemail.com';
			$config['smtp_port'] = 465;
			$config['smtp_user'] = $sender_email;
			$config['smtp_pass'] = $user_password;

// Load email library and passing configured values to email library
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");

// Sender email address
			$this->email->from($sender_email, $username);
// Receiver email address
			$this->email->to($receiver_email);
// Subject of email
			$this->email->subject($subject);
// Message in email
			$this->email->message($message);

			if ($this->email->send()) {
				$data['message_display'] = 'Email Successfully Send !';
			} else {
				$data['message_display'] =  '<p class="error_msg">Invalid Gmail Account or Password !</p>';
			}
			//$this->load->view('publico/contacto', $data);
			$data['active_menu'] = 'contact';
		$data['content']     = 'contacto_prueba';
		$this->load->view('init',$data);
		}
	}
}
