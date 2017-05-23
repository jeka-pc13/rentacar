<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Books_model extends CI_Model {

	public function __construct(){
		//Carrega BD - no database está o carregamento por default
		$this->load->database();
		$this->pdo = $this->db->conn_id;
		//var_dump($this->db);
	}

	// --------------------------------------------------------------------

	 /**
     * Retorna um array com a lista de lisvros
     * @return [type] [description]
     */
	public function getBooksPDO():array{
		$stmt = $this->pdo->prepare("SELECT * FROM livros");
		$stmt->execute();
		return $stmt->fetchAll();
	}

	// --------------------------------------------------------------------

    /**
     * [getBooksActiveRecord description]
     * @return [type] [description]
     */
	public function getBooksActiveRecord(){
		return $this->db->get('livros')->result_array();
	}

	// --------------------------------------------------------------------

    /**
     * [getBooksARQuery description]
     * @return [type] [description]
     */
	public function getBooksARQuery(){
		return $this->db->query("SELECT * FROM livros")->result();
	}

	// --------------------------------------------------------------------

	/**
	 * [getBooksARSimpleQuery description]
	 * @return [type] [description]
	 */
	public function getBooksARSimpleQuery(){
		return $this->db->simple_query("UPDATE livros SET data_publicacao = '2015-01-01' WHERE idlivro=2");
	}

	// --------------------------------------------------------------------
    
    /**
     * [getBooksById description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
	public function getBooksById($id){
		$sql = "SELECT *FROM livros WHERE idlivro = ?";
		return $this->db->query($sql, array($id))->row();
	}

	// --------------------------------------------------------------------

    /**
     * [getBooksBuilder description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
	public function getBooksBuilder($id){
		//return $this->db->where("idlivro", $id)->get("livros")->row();
		$this->db->where("idlivro", $id);
		$this->db->where("data_publicacao", '2015-01-01');
		return $this->db->get("livros")->row(); //Ele faz o SELECT * e o from LIvros de uma so vez
	}

	// --------------------------------------------------------------------

    /**
     * [getBooksBuilder2 description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
	public function getBooksBuilder2($id){
		$this->db->where("idlivro", $id);
		$this->db->where("data_publicacao", '2015-01-01');
		$this->db->select("titulo, isbn");
		$this->db->from("livros");
		return $this->db->get()->row(); //Ele faz o SELECT * e o from LIvros de uma so vez
	}

	// --------------------------------------------------------------------
 
    /**
     * [getBookList description]
     * @param  array  $search [description]
     * @return [type]         [description]
     */
	public function getBookList(array $search=array(),int $offset = 0, int $limit = ITEMS_PER_PAGE):array{
		if($search['title'] ?? false){
			$this->db->like('titulo', $search['title']); // nome LIKE '%a%'*/
		}

		if($search['author'] ?? false){
			$this->db->having('nome LIKE', '%'.$search['author'].'%'); // nome LIKE '%a%'*/
		}
		$this->db->select("idlivro,titulo, data_publicacao, GROUP_CONCAT(aut.nome ) as nome");/**/
		$this->db->from("livros as liv");
		$this->db->join('livros_has_autores as lha','lha.livros_idLivro = liv.idlivro'); // nome LIKE '%a%'*/
		$this->db->join('autores as aut','aut.idautor = lha.autores_idAutor'); // nome LIKE '%a%'*/
		$this->db->group_by('idlivro'); // nome LIKE '%a%'*/
        $this->db->limit($limit, $offset);
		return $this->db->get()->result();

	}

	public function getBookListCount(array $search=array()):int{
		if($search['title'] ?? false){
			$this->db->like('titulo', $search['title']); // nome LIKE '%a%'*/
		}

		if($search['author'] ?? false){
			$this->db->having('nome LIKE', '%'.$search['author'].'%'); // nome LIKE '%a%'*/
		}
		
		$this->db->select("idlivro,titulo, data_publicacao, GROUP_CONCAT(aut.nome) as nome");/**/
		$this->db->from("livros as liv");
		$this->db->join('livros_has_autores as lha','lha.livros_idLivro = liv.idlivro'); // nome LIKE '%a%'*/
		$this->db->join('autores as aut','aut.idautor = lha.autores_idAutor'); // nome LIKE '%a%'*/
		$this->db->group_by('idlivro'); // nome LIKE '%a%'*/

		return $this->db->count_all_results();

	}


	public function create($data){

		$livro = array(
			'isbn'=>$data['isbn'],
			'titulo'=>$data['title'],
			'data_publicacao'=>$data['data_publicacao'],
			'editoras_idEditora'=>$data['editoras']
			);
		$this->db->insert('livros', $livro);
		$livro_id = $this->db->insert_id();

		//Add author relations
		$batch=array();
		foreach ($data['authors'] as $autor_id){
			$batch[]=array(
				"livros_idlivro" => $livro_id,
				"autores_idautor" => $autor_id 
				);
		}
		return $this->db->insert_batch('livros_has_autores', $batch);
	}   	
}	

?>