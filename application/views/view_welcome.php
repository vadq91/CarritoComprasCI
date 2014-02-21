<?php
$this -> load -> view('includes/header');
$this -> load -> view('includes/menu');
?>
<div class="row">
	<center>
		<h1>Bienvenido al carrito de compras</h1>
	</center>
	<div class="col-md-6" >
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">ASIGNATURA:</H3>
			</div>
			<div class="panel-body">
				BASE DE DATOS III
			</div>
			<div class="panel-heading">
				<h3 class="panel-title">PROFESOR:</h3>
			</div>
			<div class="panel-body">
				Jhon Cano
			</div>
			<div class="panel-heading">
				<h3 class="panel-title">GRUPO:</h3>
			</div>
			<div class="panel-body">
				611
			</div>
			<div class="panel-heading">
				<h3 class="panel-title">DESARROLLADORES:</h3>
			</div>
			<div class="panel-body">
				Fabian Diez Cortez - Victor Andres David Quiñones
			</div>
		</div>
	</div>
	<div class="col-md-6" >
		<img height="150" src="<?=base_url('/files/codeIgniterLogo.png'); ?>" />
		<img height="200" src="<?=base_url('/files/bootstrap-logo.png'); ?>" />
		<br>
		<img height="150" src="<?=base_url('/files/logoGrocery.png'); ?>" />
		<img height="90" src="<?=base_url('/files/xampp-logo.jpg'); ?>" />
	</div>
</div><!-- /container -->
<?php
$this -> load -> view('includes/footer');
?>