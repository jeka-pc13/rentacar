	<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Authors_model extends CI_Model {
		public function __construct(){
		//Carrega BD - no database está o carregamento por default
		$this->load->database();
		//$this->pdo = $this->db->conn_id;
		//var_dump($this->db);
	}

	public function getAll(){
		return $this->db->select('idautor, nome')
		->order_by("nome")
		->get("autores")
		->result();
	}
	// --------------------------------------------------------------------

	/**
	 * [getAuthorsBuilder description]
	 * @param  [type] $idCountry [description]
	 * @return [type]            [description]
	 */
	public function getAuthorsBuilder($idCountry){
			/*$this->db->where("paises_idpaís", $idCountry);
			$this->db->or_where("paises_idpaís", 1);
			$this->db->select("nome");
			$this->db->from("autores");
			$this->db->order_by("nome", "ASC");
			$this->db->like('nome', 'a','before'); // nome LIKE '%a%'*/
			//$this->db->limit(2,1);

			$this->db->select("aut.nome as nome_autor, p.nome as nome_pais")
			->where("aut.paises_idpais", $idCountry)
			->from("autores as aut")
			->join('paises as p','aut.paises_idpais = p.idpais'); // nome LIKE '%a%'*/
			return $this->db->get()->result(); //Ele faz o SELECT * e o from LIvros de uma so vez
		}

	// --------------------------------------------------------------------

	/**
	 * [getEditorBuilder description]
	 * @return [type] [description]
	 */
	public function getEditorBuilder(){		
		$this->db->select("livros.titulo as nome_livro, editoras.nome as nome_editora")
		->from("livros")
			->join('editoras','livros.editoras_idEditora = editoras.ideditora','left'); // nome LIKE '%a%'*/
			return $this->db->get()->result(); //Ele faz o SELECT * e o from LIvros de uma so vez
		}

	// --------------------------------------------------------------------

	/**
	 * [createAuthor description]
	 * @param  [type] $id     [description]
	 * @param  [type] $nome   [description]
	 * @param  [type] $data   [description]
	 * @param  [type] $idPais [description]
	 * @return [type]         [description]
	 */
	public function createAuthor($id, $nome, $data, $idPais){		
		$data = array(
			'idautor'=> $id,
			'nome' => $nome,
			'data_nascimento'=> $data,
			'paises_idpais'=> $idPais);

		//return $this->db->insert('autores', $data);
		
		#outra forma para saber o id inserido
		$this->db->insert('autores', $data);
		return $this->db->insert_id();
	}

	public function createBatch($data_batch){		
		return $this->db->insert_batch('autores', $data_batch);
	}

	public function createWithSet($id, $nome, $data, $idPais){			
			$this->db->set('idautor', $id);
			$this->db->set('nome', $nome);
			$this->db->set('data_nascimento', $data);
			$this->db->set('paises_idpais', $idPais);

		return $this->db->insert('autores');
	}

	public function updateAuthor($id, $data){
		$this->db->where('idautor', $id);
		$this->db->update('autores',$data);
		return $this->db->affected_rows();
	}

	public function updateAuthorsBatch($ref_column, $data){		
		return $this->db->update_batch('autores', $data, $ref_column);
	}

	public function removeAuthors($id){		
		 $this->db->delete('autores', array('idautor'=>$id));
		 return $this->db->affected_rows();
	}


}