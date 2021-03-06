<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Automovel_model extends CI_Model { 

	public function __construct(){
		parent::__construct();
		$this->load->database();
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
				$this->db->like("m.nome",$search['modelo']);
			}
			if ($search['matricula'] ?? false) {
				$this->db->like("matricula",$search['matricula']);
			}
			if ($search['fabricante'] ?? false) {
				$this->db->like('f.nome',$search['fabricante']);
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
			->join("automoveis.fabricantes f", "m.fabricante_id = f.id")
			->where("autos.cremovido = 0")
			->order_by("autos.id")
			->limit($limit,$offset);
			
			//return $this->db->get()->result();

			$this->load->library('carro');
			return $this->db->get()->custom_result_object('Carro');
		}



		public function getAutomoveisListCount(array $search=array()):int{

			if ($search['modelo'] ?? false) {
				$this->db->like("m.nome",$search['modelo']);
			}
			if ($search['matricula'] ?? false) {
				$this->db->like("matricula",$search['matricula']);
			}
			if ($search['fabricante'] ?? false) {
				$this->db->like('f.nome', $search['fabricante']);
			}
			$select = "autos.id as id";

			$this->db->select($select)
			->from("automoveis.automoveis autos")
			->join("automoveis.cores c", "autos.cor_id = c.id") //Cores
			->join("automoveis.modelos m", "autos.modelo_id = m.id")//modelo 
			->join("automoveis.fabricantes f", "m.fabricante_id = f.id")
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
	 * { function_description }
	 *
	 * @param      integer  $id     The identifier
	 * @param      array    $data   array asociativo com os valores a atualiza,
	 *                              as key possiveis para o array são:
	 *                              modelo_id, cor_id, disponibilidade,
	 *                              matricula
	 *
	 * @return     <type>   ( description_of_the_return_value )
	 */
	public function editarAutomovel(int $id, array $data){
		//var_dump($data);
		//var_dump($id);
		$this->db->where('id', $id);
		// remover items do array com chaves como id, cremovido ou algo fora das
		// keys possiveis
		$this->db->update('automoveis',$data);
		return $this->db->affected_rows();
	}

	/**
	 * remove um automovel da base de dados alterando o seu booleano de removido
	 *
	 * @param      integer  $id     The identifier
	 *
	 * @return     <type>   ( description_of_the_return_value )
	 */
	public function removerAutomovel(int $id){
		$this->db->where('id', $id);
		$this->db->set('cremovido', 1);
		$this->db->update('automoveis');
		return $this->db->affected_rows();
	}


	public function create($data){
		//echo "estoy en funcion create";
		
		$automovel = array(
			'modelo_id'=>$data['modelo'],
			'cor_id'=>$data['cor'],
			'disponibilidade'=>$data['estado'],
			'matricula'=>strtoupper($data['matricula'])
			);
		$this->db->insert('automoveis', $automovel);
		return $carto_id = $this->db->insert_id();
	}

	public function getCarroById($id){
		$this->db->from("automoveis.automoveis autos")
		->where("autos.id",$id);
			// ->limit($limit,$offset);
		return $this->db->get()->row();
	}  
}
