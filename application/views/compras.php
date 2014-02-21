<?php

$this -> load -> view('includes/header');
$this -> load -> view('includes/menu');

echo "<center><h1>SELECCIONE SUS PRODUCTOS</h1></center>";
echo "<div class='row'>";
foreach ($output as $arreglo) {
	echo '<div class="col-lg-4">';
	echo "<form action ='agregar_carrito' method='POST'>";
	echo "<br>";
	/*Para mostrar la imagen del producto*/
	echo "<img src=" . base_url('files/' . $arreglo['imagen']) . " class='img-thumbnail'>";
	echo "<br>";
	echo "Codigo: " . $arreglo['codigoProducto'];
	/*Para enviar el codigo del producto*/
	echo "<input type='hidden' name='codigoProducto' value='" . $arreglo['codigoProducto'] . "'>";
	echo "<br>";
	echo "Nombre: " . $arreglo['nombre'];
	echo "<input type='hidden' name='nombre' value='" . $arreglo['nombre'] . "'>";
	echo "<br>";
	echo "Precio: $ " . number_format($arreglo['precio'],2,',','.');
	echo "<input type='hidden' name='precio' value='" . $arreglo['precio'] . "'>";
	echo "<br>";
	echo "Existencias: " . $arreglo['stock'];
	echo "<input type='hidden' name='stock' value='" . $arreglo['stock'] . "'>";
	echo "<br>";
	echo "<input type='text' name='cantidad' maxlength='3' size='5'>";
	echo '   <button class="btn btn-default" type="submit" name="agregar" value="agregar">';
	echo '      <span class="glyphicon glyphicon-shopping-cart"></span>Agregar';
	echo '   </button>';
	echo "</form>";
	echo "<br><br>";
	echo '</div>';
}
echo "</div>";
$this -> load -> view('includes/footer');
?>

