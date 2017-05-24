<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class MY_Modelo extends CI_Model {

	protected $tabela;

	abstract function init(array $param);

	public function getAll(){
		return $this->db->get($this->tabela)->result();
	}

	public function getById($id){
		return $this->db->where("id", $id)->from($this->tabela)->get()->result();
	}
}