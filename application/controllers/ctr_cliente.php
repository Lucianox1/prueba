<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ctr_cliente extends CI_Controller {

	
	public function __construct()
	{

		parent::__construct();
		$this->load->library("XLSXWriter");
		$this->load->model("m_cliente");
	}


	public function crearxls(){
		
		$datos = $this->m_cliente->traer_todo();
		//var_dump($datos);
		$arraypadre = array();
		$arrayhijo = array();
		foreach ($datos as $key ) {
			$arrayhijo = array($key->id,$key->rut,$key->nombre);
			//array_push($arraypadre,$arrayhijo);
			//unset($arrayhijo);
			$arraypadre[] = $arrayhijo;
			unset($arrayhijo);
		}
		/*
		echo var_dump($arraypadre);
		echo "</br></br>";
		$rows = array(
    	array('2003','1','-50.5','2010-01-01 23:00:00','2012-12-31 23:00:00'),
    	array('2003','=B1', '23.5','2010-01-01 00:00:00','2012-12-31 00:00:00'),);
    	echo var_dump($rows);
    	echo "</br></br>";
    	foreach ($rows as $row) {
    		echo "</br></br>".var_dump($row);
    	}
    	echo "</br></br>";
    	foreach ($arraypadre as $row) {
    		echo "</br></br>".var_dump($row);
    	}*/


		ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);
$filename = "example.xlsx";
header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');
$encabezado = array('id'=>'integer','rut'=>'string','nombre'=>'string');


$writer = new XLSXWriter();
$writer->setAuthor('Some Author'); 
$writer->writeSheetHeader('clientes',$encabezado);
foreach($arraypadre as $row)
	$writer->writeSheetRow('clientes', $row);
$writer->writeToStdOut();
exit(0);


}

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
