<?php
/**
 *
 */
class Cliente_modelo extends CI_Model {

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
			$crud -> set_table('cliente');

			/*Le asignamos el idioma español*/
			$crud -> set_language('spanish');

			/*Cambiamos algunos nombres de tablas*/
			$crud -> display_as('idCliente', 'Id del cliente');
			$crud -> display_as('nombreApellido', 'Nombre del cliente');

			/*Aqui le decimos a grocery que estos campos son obligatorios*/
			$crud -> required_fields('idCliente', 'nombreApellido');

			/*Aqui le indicamos que campos deseamos mostrar*/
			$crud -> columns('idCliente', 'nombreApellido', 'direccion', 'telefono');

			/*Generamos la tabla*/
			$tabla = $crud -> render();

		} catch (Exception $e) {
			show_error($e -> getMessage() . '------' . $e -> getTraceAsString());
		}

		return $tabla;
	}

	public function login($id) {
		
		/*Cargamos la base de datos*/
		$this -> load -> database();

		/*Traemos todos los datos de la tabla productos*/
		$query = $this -> db -> query('SELECT nombreApellido FROM CLIENTE WHERE idCliente=' . $id);

		/*Verificamos la cantidad de registros devueltos*/
		if ($query -> num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

}
