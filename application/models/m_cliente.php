<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class m_cliente extends CI_Model
{
	
	
	function __construct()
	{
	  parent::__construct();
	  $this->load->database();

	}


	public function guardar($rut, $nombre){

		$sql = "INSERT INTO clientes (rut,nombre) values ('".$rut."','".$nombre."')";
		$this->db->query($sql);

	}

	public function eliminar($id){
		$sql = "DELETE FROM clientes WHERE id = ".$id;
		$this->db->query($sql);
	}
	
	public function traer_todo(){
		$query = $this->db->query('SELECT * FROM clientes');
		return $query->result();
	}

	public function modificar($id,$rut,$nombre){
		$sql = "UPDATE clientes set rut = '".$rut."',nombre = '".$nombre."' WHERE id = ".$id;
		$this->db->query($sql);
	}


}
?>