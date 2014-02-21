<?php
$this -> load -> view('includes/header');
$this -> load -> view('includes/menu');
?>
<div class="container">
	<div class="alert alert-danger">
		<strong>¡Algo salio mal! </strong><?php echo $mensaje; ?><a href="<?php echo $direccion; ?>" class="alert-link"> intentalo de nuevo</a>
	</div>
</div>
<?php
$this -> load -> view('includes/footer');
?>