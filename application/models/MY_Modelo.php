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

	/**
	 * retorna uma listagem (string) com todas as matriculas armazenadas na base de dados
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public function getListID():string{
		
		$select = $this->tabela.".id";

		$this->db->select($select)
		->from($this->tabela);

		$result= $this->db->get()->result_array();
		$list = array();

		foreach ($result as $key => $id) {
			$list[] = $id["id"];
		}
			//var_dump($list);
		return implode(",", $list); 
	}
}