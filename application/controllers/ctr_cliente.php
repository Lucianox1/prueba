<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ctr_cliente extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("m_cliente");
	}


	public function guardar(){

		$rut = $this->input->post("rut");
		$nombre = $this->input->post("nombre");
		$this->m_cliente->guardar($rut,$nombre);
		
	}
	/*
	public function cargar_todo(){
		$r = $this->m_cliente->traer_todo();
		echo json_encode($r);
	}

	public function eliminar(){
		$id = $this->input->post("id");
		$this->m_cliente->eliminar($id);
	}*/

}
