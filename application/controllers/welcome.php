<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct() {
		parent::__construct();

		/*Cargamos la base de datos*/
		$this -> load -> database();

		/*Cargamos la clase cart, recuerde agregar la clave MD5 en config*/
		$this -> load -> library('cart');

		/*Cargamos la libreria*/
		$this -> load -> library('Grocery_CRUD');

		/*Añadimos el helper al controlador*/
		$this -> load -> helper('url');

		/*Cargamos el modelo de cliente*/
		$this -> load -> model('Cliente_modelo');
	}

	public function index() {

		redirect('welcome/inicio');

	}

	public function inicio() {

		$this -> load -> view('view_welcome');

	}

	public function modulo_clientes() {

		/*Traemos el CRUD generado desde el modelo*/
		$output = $this -> Cliente_modelo -> load_crud();
		/*
		 * Le cargamos en la vista situada en
		 * /applications/views/clientes.php
		 * */

		$this -> load -> view('clientes', $output);
	}

	public function modulo_productos() {

		/*Cargamos el modelo de producto*/
		$this -> load -> model('Producto_modelo');

		/*traemos el crud generado y lo guardamos en $output*/
		$output = $this -> Producto_modelo -> load_crud();

		/*
		 * Le cargamos en la vista situada en
		 * /applications/views/productos.php
		 * */

		$this -> load -> view('productos', $output);

	}

	public function lista_productos() {

		/*Cargamos el modelo de producto*/
		$this -> load -> model('Producto_modelo');

		/*traemos todos los productos*/
		$output = $this -> Producto_modelo -> load_all_products();

		/*
		 * Le cargamos en la vista situada en
		 * /applications/views/compras.php
		 * Creamos una referencia $output
		 * */
		$this -> load -> view('compras', array('output' => $output));

	}

	public function agregar_carrito() {

		/*Comprobamos que la cantidad pedida no supere el stock*/
		if (($this -> input -> post('stock')) < ($this -> input -> post('cantidad'))) {

			$output['mensaje'] = "La cantidad solicitada supera la cantidad de productos existentes, ";
			$output['direccion'] = "lista_productos";
			$this -> load -> view('alerta', $output);

		} elseif (($this -> input -> post('cantidad')) == 0) {

			$output['mensaje'] = "La cantidad a llevar debe ser mayor a cero, ";
			$output['direccion'] = "lista_productos";
			$this -> load -> view('alerta', $output);

		} else {

			/*Llenamos el arreglo con los productos seleccionados en el formulario.
			 * El llamando de los datos se realiza con la clase input de codeIgniter
			 * Luego llamamos a la funcion insert de la clase cart para llenar el carrito
			 * */
			$data = array('id' => $this -> input -> post('codigoProducto'), 'qty' => $this -> input -> post('cantidad'), 'price' => $this -> input -> post('precio'), 'name' => $this -> input -> post('nombre'), );
			$this -> cart -> insert($data);
			redirect('welcome/lista_productos');
		}
	}

	public function mostrar_carrito() {

		$this -> load -> view('carrito');

	}

	public function vaciar_carrito() {

		$this -> cart -> destroy();
		redirect('welcome/mostrar_carrito');

	}

	public function actualizar_carrito() {

		/*Recibimos todos los valores que vienen por POST y lo guardamos en DATA*/
		$data = $this -> input -> post();

		/*Utilizamos el metodo update de la clase cart*/
		$this -> cart -> update($data);

		/*Mostramos el carrito*/
		redirect('welcome/mostrar_carrito');

	}

	public function registrar_venta() {

		/*Guardamos el usuario*/
		$idUsr = $this -> input -> post('idC');

		/*Validamos que el carrito tenga productos*/
		if ($this -> cart -> total_items() == 0) {

			/*Si no tiene mandamos la alerta*/
			$output['mensaje'] = "No ha seleccionado ningun producto, ";
			$output['direccion'] = "lista_productos";
			$this -> load -> view('alerta', $output);
			
		} else {

			/*Validamos que el usuario exista*/
			if ($this -> Cliente_modelo -> login($idUsr)) {

				/*Cargamos el modelo venta*/
				$this -> load -> model('Venta_modelo');

				/* Guardamos el carrito en una variable*/
				$productos = $this -> cart -> contents();

				/*llamamos la funcion para guardar la venta*/
				if ($this -> Venta_modelo -> save_sale($productos, $idUsr)) {
					
					$output=$this->cart->contents();

					$this -> load -> view('factura', array('output' => $output));

				} else {

					/*Mandamos un mensaje indicando que no se pudo guardar la venta*/
					$output['mensaje'] = "No pudimos registrar tu compra, ";
					$output['direccion'] = "mostrar_carrito";
					$this -> load -> view('alerta', $output);
				}
			} else {

				/*Si el usuario no existe mandamos la alerta*/
				$output['mensaje'] = "El ID ingresado no existe, ";
				$output['direccion'] = "mostrar_carrito";
				$this -> load -> view('alerta', $output);
			}
		}

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
