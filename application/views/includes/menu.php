<nav class="navbar navbar-inverse" role="navigation">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse"
		data-target=".navbar-ex1-collapse">
			<span class="sr-only">Desplegar navegación</span>
		</button>
		<a class="navbar-brand" href="inicio">INICIO</a>
	</div>
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav">
			<li>
				<a href="lista_productos">COMPRAR</a>
			</li>
			<li >
				<a href="modulo_clientes">CLIENTES</a>
			</li>
			<li>
				<a href="modulo_productos">PRODUCTOS</a>
			</li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li>
				<form action="mostrar_carrito">
					<button class="btn btn-default btn-sm" type="submit" name="agregar">
						<span class="glyphicon glyphicon-shopping-cart"></span>
						<br>
						Productos: <?php echo $this -> cart -> total_items(); ?>
						<br>
						Total: <?php echo $this -> cart -> format_number($this -> cart -> total()); ?>
						<br>
					</button>
				</form>
			</li>
		</ul>
	</div>
</nav>
