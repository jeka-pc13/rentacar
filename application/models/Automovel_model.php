<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Automovel_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->pdo = $this->db->conn_id;
		//var
		//
		//_dump($this->db);
	}

	public function obterTodosAutomoveis(){


			$select = "autos.id as id,
			m.nome as modelo,
			f.nome as fabricante,
			c.nome as cor,
			autos.disponibilidade as disponibilidade
			";


			$this->db->select($select)
			->from("automoveis.automoveis autos")

			->join("automoveis.cores c", "autos.cor_id = c.id") //Cores
			->join("automoveis.modelos m", "autos.modelo_id = m.id")//modelo 
			->join("automoveis.fabricantes f", "m.fabricante-id = f.id")
			->group_by("autos.id");
			// ->limit($limit,$offset);


			return $this->db->get()->result();
	}
}
