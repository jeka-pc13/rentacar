<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Editors_model extends CI_Model {
		public function __construct(){
		//Carrega BD - no database está o carregamento por default
		$this->load->database();
		//$this->pdo = $this->db->conn_id;
		//var_dump($this->db);
	}

	public function getAll(){
		return $this->db->select('ideditora, nome')
		->order_by("nome")
		->get("editoras")
		->result();
		
	}
}

	?>