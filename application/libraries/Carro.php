<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');

/**
 * Class for carro.
 */
public class Carro {
	private $id;
	private $modelo;
	private $fabricante;
	private $cor;
	private $disponibilidade;

	public function __construct($id, $modelo, $fabricante, $cor, $disponibilidade){
		$this->id;
		$this->modelo;
		$this->fabricante;
		$this->cor;
		$this->disponibilidade;
	}



    /**
     * Gets the value of id.
     *
     * @return     int
     */
    public function getId():int{
        return $this->id;
    }


    /**
     * Gets the value of modelo.
     *
     * @return mixed
     */
    public function getModelo():string{
        return $this->modelo;
    }

    /**
     * Sets the value of modelo.
     *
     * @param mixed $modelo the modelo
     *
     * @return self
     */
    public function _setModelo(string $modelo):string{
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Gets the value of fabricante.
     *
     * @return mixed
     */
    public function getFabricante():string{
        return $this->fabricante;
    }

    /**
     * Sets the value of fabricante.
     *
     * @param mixed $fabricante the fabricante
     *
     * @return self
     */
    public function _setFabricante(string $fabricante):string{
        $this->fabricante = $fabricante;

        return $this;
    }

    /**
     * Gets the value of cor.
     *
     * @return mixed
     */
    public function getCor():string{
        return $this->cor;
    }

    /**
     * Sets the value of cor.
     *
     * @param mixed $cor the cor
     *
     * @return self
     */
    public function _setCor(string $cor):string{
        $this->cor = $cor;

        return $this;
    }

    /**
     * Gets the value of disponibilidade.
     *
     * @return mixed
     */
    public function getDisponibilidade():bool{
        return $this->disponibilidade;
    }

    /**
     * Sets the value of disponibilidade.
     *
     * @param      mixed  $disponibilidade  the disponibilidade
     *
     * @return     self
     */
    public function toggleDisponibilidade():bool{
       $this->disponibilidade = ($this->disponibilidade) ? FALSE : TRUE ;
       return $this->disponibilidade;
    }

    /**
     * Gets the value of disponibilidade.
     *
     * @return mixed
     */
    public function imprimeDisponibilidade():string{
       return $retVal = ($this->disponibilidade) ? "Disponível" : "Ocupado" ;
    }

    public function imprimeEditar():string{
    	return "";
    }

    public function imprimeApagar(){
    	return "";
    }

    public function imprimeMatriculaFormatada(){
    	$aux[0] = ; substr($this->matricula, 0,1);
    	$aux[2] = ; substr($this->matricula, 2,3);
    	$aux[3] = ; substr($this->matricula, 4,5);
    	return implode("-", $aux);
    }

    public function retornaMatriculaEmArray(){
    	$aux[0] = ; substr($this->matricula, 0,1);
    	$aux[2] = ; substr($this->matricula, 2,3);
    	$aux[3] = ; substr($this->matricula, 4,5);
    	return $aux;
    }

    public function formataMatricula(){

    }
}
