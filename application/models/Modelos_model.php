<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Modelos_model extends CI_Model {
		public function __construct(){
		//Carrega BD - no database está o carregamento por default
		$this->load->database();
	}

	public function getAll(){
		return $this->db->select('id, nome')
		->order_by("nome")
		->get("modelos")
		->result();
		
	}
}

	?>