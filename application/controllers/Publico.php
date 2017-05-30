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

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->load->library('encrypt');
		$this->load->helper('security');

		$this->load->library("session");
	}
	
	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index(){
		$data['active_menu'] = 'home';
		$data['content']     = 'home';
		$this->load->view('init',$data);
	}

	/**
	 * [home description]
	 * @return [type] [description]
	 */
	public function home(){
		$data['active_menu'] = 'home';
		$data['content']     = 'home';
		$this->load->view('init',$data);
	}

	/**
	 * [sobre description]
	 * @return [type] [description]
	 */
	public function sobre(){
		$data['active_menu'] = 'about';
		$data['content']     = 'sobre';
		$this->load->view('init',$data);
	}

	/**
	 * [contacto description]
	 * @return [type] [description]
	 */
	public function contacto(){
		$data['active_menu'] = 'contact';
		$data['content']     = 'contacto';
		$this->load->view('init',$data);
	}

	/**
	 * Send Gmail to another user
	 * @return [type] [description]
	 */
	public function send_mail() {
        // Check for validation
        
        $config = array(
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email|xss_clean',
				'errors' => array(
					'required' => 'É obrigatório indicar um %s.',
					'valid_email' => 'Insira um %s válido.'
					)
				),
			array(
				'field' => 'nome',
				'label' => 'Nome',
				'rules' => 'trim|required|alpha_numeric_spaces|xss_clean',
				'errors' => array(
					'required' => 'É obrigatório inserir um %s.',
					'alpha_numeric_spaces' => 'Contém caracteres inválidos',
					)
				),
			array(
				'field' => 'mensagem',
				'label' => 'Mensagem',
				'rules' => 'trim|required|alpha_numeric_spaces|xss_clean',
				'errors' => array(
					'required' => 'É obrigatório inserir a %s.',
					'alpha_numeric_spaces' => 'Contém caracteres inválidos'
					)
				),
			array(
				'field' => 'g-recaptcha-response',
				'label' => 'captcha',
				'rules' => 'required',
				'errors' => array(
					'required' => 'É obrigatório o %s.'
					)
				)
			);

		$this->form_validation->set_rules($config);
     
		if ($this->form_validation->run() == FALSE) {
			//$this->load->view('view_form');
			// $data['active_menu'] = 'contact';
			// $data['content']     = 'contacto';
			$this->contacto();
		} else {

            // Storing submitted values
			$sender_email = 'rentacar.bravavalley@gmail.com';
			$user_password = '1a2s3d4f5g';
			$username = 'Brava Valley - Rent a car';
			$subject ='Confirmação';
			$receiver_email = $this->input->post('email');
			$name = $this->input->post('nome');
			$message = '<strong>Obrigada pelo seu contacto seremos breves em responder a sua questão!</strong><br><br><br>';
			$message.='***COPIA DA SUA MENSAGEM***<br>';
			$message.='<i>'.$this->input->post('mensagem').'</i>';

            // Configure email library
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'ssl://smtp.googlemail.com';
			$config['smtp_port'] = 465;
			$config['smtp_user'] = $sender_email;
			$config['smtp_pass'] = $user_password;
			$config['mailtype'] = 'html';

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
				//$data['message_display'] = 'Email enviado com successo !';
				$this->session->set_flashdata('event', 'Email enviado com successo !');
			} else {
				//$data['message_display'] =  '<p class="error_msg">Palavra passe ou correio inválido!</p>';
				$this->session->set_flashdata('event', 'Palavra passe ou correio inválido!');
			}
			redirect('publico/contacto');
/*
			$data['active_menu'] = 'contact';
			$data['content']     = 'contacto';
			$this->load->view('init',$data);*/
		}
		
		/**
		 * [validate_captcha description]
		 * @param  [type] $recaptcha [description]
		 * @return [type]            [description]
		 */
		function validate_captcha() { $recaptcha = trim($this->input->post('g-recaptcha-response')); 
			$userIp= $this->input->ip_address(); 
			$secret='6LehOiMUAAAAALsbB5YBw1rSU5Kg6iMMKA9Egbzw'; 
			$data = array( 'secret' => "$secret", 'response' => "$recaptcha", 'remoteip' =>"$userIp" ); 
			$verify = curl_init(); curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify"); 
			curl_setopt($verify, CURLOPT_POST, true); 
			curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data)); 
			curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false); 
			curl_setopt($verify, CURLOPT_RETURNTRANSFER, true); $response = curl_exec($verify); 
			$status= json_decode($response, true); 
			if(empty($status['success'])){ return FALSE; }else{ return TRUE; } }

			$this->form_validation->set_rules('g-recaptcha-response', 'recaptcha validation', 'required|callback_validate_captcha'); 
			$this->form_validation->set_message('validate_captcha', 'Please check the the captcha form');
	}
}