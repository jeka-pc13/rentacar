<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('getConfigValidationForm'))
{	
	/**
	 * Sets the menu item active
	 *
	 * @return  string  add a css class to the item
	 */
	function getConfigValidationForm():array
	{	
		$this->load->model('cores_model');
		$this->cores_model->init(array('tabela' =>"cores"));
		$this->load->model('modelos_model');
		$this->modelos_model->init(array('tabela' =>"modelos"));
		$whiteListModelos = $this->modelos_model->getListID();
		$whiteListCores = $this->cores_model->getListID();
		$config = array(
			array(
				'field' => 'modelo',
				'label' => 'Modelo',
				'rules' => 'required|in_list['.$whiteListModelos.']',
				'errors' => array(
					'required' => 'É obrigatório indicar um %s.',
					'in_list' => 'É obrigatório indicar um %s da lista.',
					'alpha_numeric_spaces' => 'Contém caracteres inválidos'
					)
				),
			array(
				'field' => 'matricula',
				'label' => 'Matrícula',
				'rules' => 'required|exact_length[8]|is_unique[automoveis.matricula]|validateMatricula',
				'errors' => array(
					'required' => 'É obrigatório inserir uma %s.',
					'exact_length' => 'Verifique o número de caracteres(XX-XX-XX)',
					'is_unique' => 'Ops! Esta %s já está registrada!',
					'validateMatricula' => 'Ops! Este formato de %s não é válido!'
					)
				),
			array(
				'field' => 'cor',
				'label' => 'Cor',
				'rules' => 'required|in_list['.$whiteListCores.']',
				'errors' => array(
					'required' => 'É obrigatório escolher uma %s.',
					'in_list' => 'É obrigatório escolher uma %s da lista.',
					)
				),
			array(
				'field' => 'estado',
				'label' => 'Disponilidade',
				'rules' => 'required',
				'errors' => array(
					'required' => 'É obrigatório indicar a %s do automóvel.',
					)
				)
			);
		return $config;
	}   
}