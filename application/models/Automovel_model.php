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

	/**
	 * Retorna todos os automoveis da base de dados com as suas tuplas legiveis
	 *
	 * @return     array  array de objetos, onde cada objeto é um automovel
	 */
	public function obterTodosAutomoveis():array{

		$select = "autos.id as id,
		m.nome as modelo,
		f.nome as fabricante,
		matricula,
		c.nome as cor,
		autos.disponibilidade as disponibilidade";

		$this->db->select($select)
		->from("automoveis.automoveis autos")
			->join("automoveis.cores c", "autos.cor_id = c.id") //Cores
			->join("automoveis.modelos m", "autos.modelo_id = m.id")//modelo 
			->join("automoveis.fabricantes f", "m.fabricante-id = f.id")
			->group_by("autos.id");
			// ->limit($limit,$offset);
			return $this->db->get()->result();
		}

		/**
		 * dado um array associativo (com chaves possieveis: modelo, matricula e
		 * fabricante) esta funcao retorna um array de objetos com todos os
		 * automoveis que satizfagam esse filtro
		 *
		 * @param      array    $search  array associativo (com chaves: modelo,
		 *                               matricula e/ou fabricante)
		 * @param      integer  $offset  The offset
		 * @param      integer  $limit   The limit
		 *
		 * @return     array    array de objetos resultante da pesquisa na base de dados
		 */
		public function obterAutomoveisPorFiltro(array $search = array(), int $offset=0, int $limit=ITEMS_PER_PAGE):array{

			if ($search['modelo'] ?? false) {
				$this->db->like("modelo",$search['modelo']);
			}
			if ($search['matricula'] ?? false) {
				$this->db->like("matricula",$search['matricula']);
			}
			if ($search['fabricante'] ?? false) {
				$this->db->like('fabricante',$search['fabricante']);
			}

			$select = "autos.id as id,
			m.nome as modelo,
			f.nome as fabricante,
			matricula,
			c.nome as cor,
			autos.disponibilidade as disponibilidade";

			$this->db->select($select)
			->from("automoveis.automoveis autos")
			->join("automoveis.cores c", "autos.cor_id = c.id") //Cores
			->join("automoveis.modelos m", "autos.modelo_id = m.id")//modelo 
			->join("automoveis.fabricantes f", "m.fabricante-id = f.id")
			->where("autos.cremovido = 0")
			->order_by("autos.id");
			// ->limit($limit,$offset);
			return $this->db->get()->result();
		}



		public function getAutomoveisListCount(array $search=array()):int{

			if ($search['modelo'] ?? false) {
				$this->db->like("modelo",$search['modelo']);
			}
			if ($search['matricula'] ?? false) {
				$this->db->like("matricula",$search['matricula']);
			}
			if ($search['fabricante'] ?? false) {
				$this->db->like('fabricante', $search['fabricante']);
			}
			$select = "autos.id as id";

			$this->db->select($select)
			->from("automoveis.automoveis autos")
			->join("automoveis.cores c", "autos.cor_id = c.id") //Cores
			->join("automoveis.modelos m", "autos.modelo_id = m.id")//modelo 
			->join("automoveis.fabricantes f", "m.fabricante-id = f.id")
			->where("autos.cremovido = 0")
			->group_by("autos.id");
			return $this->db->count_all_results();
		}

	/**
	 * retorna todas as matriculas dos carros
	 *
	 * @return     <array>  array de objetos contendo todas as matriculos 
	 */
	public function obterMatriculas():array{
		$select = "autos.matricula";

		$this->db->select($select)
		->from("automoveis.automoveis autos")
		->where("autos.matricula IS NOT NULL")
		->order_by("autos.id");
			// ->limit($limit,$offset);
		return $this->db->get()->result();
	}

	/**
	 * retorna uma listagem (string) com todas as matriculas armazenadas na base de dados
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public function obterListaMatriculas():string{
		$select = "autos.matricula";

		$this->db->select($select)
		->from("automoveis.automoveis autos")
		->where("autos.matricula IS NOT NULL")
		->order_by("autos.id");
			// ->limit($limit,$offset);
		$result= $this->db->get()->result_array();
			//var_dump($result);
		$list = array();

		foreach ($result as $key => $matricula) {
			$list[] = $matricula["matricula"];
		}
			//var_dump($list);
		return implode(",", $list);
	}
}
