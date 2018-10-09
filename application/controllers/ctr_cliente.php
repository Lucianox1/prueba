<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ctr_cliente extends CI_Controller {

	
	public function __construct()
	{

		parent::__construct();
		//$this->load->library("XLSXWriter");
		$this->load->model("m_cliente");


		

	}

	//public function crearxls(){

		//$datos = self::cargar_todo();
/*
		$data = array(
    	array('year','month','amount'),
    	array('2003','1','220'),
    	array('2003','2','153.5'),
		);

		$writer = new XLSXWriter();
		$writer->writeSheet($data);
		$writer->writeToFile('output.xlsx');
*/
	//}

	//ok
	public function guardar(){

		$rut = $this->input->post("rut");
		$nombre = $this->input->post("nombre");
		$id = $this->input->post("id_c");

		//$validacion = $this->m_cliente->get_rut($rut);
		//echo $validacion;
		/*if ($rut == $validacion ) {//si el rut ingresado ya esta registrado
			
		}else{
			
		}*/

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
