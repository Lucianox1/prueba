<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ctr_cliente extends CI_Controller {

	
	public function __construct()
	{

		parent::__construct();
		$this->load->library("xlsxwritter");
		$this->load->model("m_cliente");
		

	}

	public function crearxls(){
		$archivo = new xlsxwritter();
		$datos = self::cargar_todo();

	}

	//ok
	public function guardar(){

		$rut = $this->input->post("rut");
		$nombre = $this->input->post("nombre");
		$id = $this->input->post("id_c");

		if(!empty($rut) && !empty($nombre) && empty($id)) {

			$this->m_cliente->guardar($rut,$nombre);

		}elseif (!empty($rut) && !empty($nombre) && !empty($id)) {

			$this->m_cliente->modificar($id,$rut,$nombre);

		}
		
		
	}
	//ok
	public function cargar_todo(){
		$r = $this->m_cliente->traer_todo();
		echo json_encode($r);
	}

	public function eliminar(){
		$id = $this->input->post("id");
		$this->m_cliente->eliminar($id);
	}

}
