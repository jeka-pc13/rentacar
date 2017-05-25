<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'MY_Modelo.php';
class Cores_model extends MY_Modelo {
	
	public function init(array $param){
		if($param['tabela']??false)
		$this->tabela = $param['tabela'];
	}

}