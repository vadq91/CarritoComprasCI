<?php
class Producto_modelo extends CI_Model {

	function __construct() {
		// Llamar al constructor de CI_Model
		parent::__construct();
	}

	public function load_crud() {
		try {
			/*Creamos el objeto*/
			$crud = new Grocery_CRUD();

			/*Seleccionamos el tema*/
			$crud -> set_theme('flexigrid');

			/*Seleccionamos el nombre de la tabla de nuestra BD*/
			$crud -> set_table('producto');

			/*Le asignamos el idioma español*/
			$crud -> set_language('spanish');

			/*Aqui le decimos a grocery que estos campos son obligatorios*/
			$crud -> required_fields('codigoProducto', 'nombre', 'precio', 'stock');

			/*Aqui le indicamos que campos deseamos mostrar*/
			$crud -> columns('codigoProducto', 'nombre', 'precio', 'imagen', 'stock');

			/*Para subir la imagen*/
			$crud -> set_field_upload('imagen', 'files');

			/*Generamos la tabla*/
			$tabla = $crud -> render();

		} catch (Exception $e) {
			show_error($e -> getMessage() . '------' . $e -> getTraceAsString());
		}
		return $tabla;
	}

	public function load_all_products() {
		/*Cargamos la base de datos*/
		$this -> load -> database();

		/*Traemos todos los datos de la tabla productos*/
		$query = $this -> db -> query('SELECT * FROM PRODUCTO WHERE STOCK >0');

		/*Guardamos los datos en un arreglo*/
		$data = $query -> result_array();

		return $data;
	}

	public function update_stock($idProduct, $qty) {
		/*Cargamos la base de datos*/
		$this -> load -> database();
		
		/*Obtenemos el stock existente*/
		$query = $this -> db -> query('SELECT stock FROM PRODUCTO WHERE codigoProducto='.$idProduct);

		$row = $query -> row() -> stock;
		
		/*Hacemos la resta*/
		$newQty=$row-$qty;
		
		/*Guardamos la cantidad*/
		$query = $this -> db -> query('UPDATE PRODUCTO SET STOCK='.$newQty.' WHERE codigoProducto='.$idProduct);
		
	}

}
