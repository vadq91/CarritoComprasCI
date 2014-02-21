<?php
/**
 *
 */
class Venta_modelo extends CI_Model {

	function __construct() {

		parent::__construct();

		/*Cargamos la base de datos*/
		$this -> load -> database();

	}

	public function save_sale($products, $userId) {

		/*Establecemos la zona horaria*/
		date_default_timezone_set('America/Bogota');

		/*Preparamos la insercion*/
		$sql = "INSERT INTO VENTA (cliente,fecha) VALUES (" . $userId . ",'" . date('j-m-y,H:i:s') . "')";

		/*Mandamos la consulta*/
		$this -> db -> query($sql);

		/*Verificamos que se hayan modificado registros*/
		if ($this -> db -> affected_rows() > 0) {

			/*Obtenemos el ultimo codigo que se genero en la tabla*/
			$query = $this -> db -> query('SELECT MAX(codigoVenta) as codigo FROM VENTA');

			$row = $query -> row() -> codigo;

			if ($this -> save_detail($products, $row)) {
				return TRUE;
			} else {
				return false;
				
			}

		} else {
			return false;
			
		}

	}

	public function save_detail($products, $idSale) {
		/*Un contador para saber cuantos registros se guardaron*/
		$cont = 0;

		/*Recorremos el arreglo de productos*/
		foreach ($products as $item) {

			/*Obtenemos el codigo y cantidad del producto*/
			$idProduct = $item['id'];
			$quProduct = $item['qty'];

			/*Preparamos la insercion*/
			$sql = "INSERT INTO DETALLEVENTA (codigoVenta,codigoProducto,cantidad) VALUES (" . $idSale . "," . $idProduct . "," . $quProduct . ")";

			/*Mandamos la consulta*/
			$this -> db -> query($sql);

			/*Verificamos que se hayan modificado registros*/
			if ($this -> db -> affected_rows() > 0) {

				$cont++;

				/*Actualizamos el Stock*/
				$this -> load -> model('Producto_modelo');
				$this -> Producto_modelo -> update_stock($idProduct, $quProduct);
			}
		}

		/*Verificamos que la cantidad de registros guardados sea la misma que la cantidad que tenia el carrito*/
		if ($cont == count($products)) {
			return TRUE;
			
		} else {

			/*Eliminamos los registros que se alcanzaron a guardar en detalle venta*/
			$sql = "DELETE DETALLEVENTA WHERE codigoVenta =" . $idSale;
			$this -> db -> query($sql);

			/*Eliminamos el registro de la venta*/
			$sql = "DELETE VENTA WHERE codigoVenta =" . $idSale;
			$this -> db -> query($sql);

			return FALSE;
		}
	}

}
?>