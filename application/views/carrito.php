<?php
$this -> load -> view('includes/header');
$this -> load -> view('includes/menu');
?>
<div class="row">
	<div class="col-md-6">
		<CENTER><h2>CONTENIDO DE MI CARRITO</h2></center>
		<form action="actualizar_carrito" method="post">
			<table class="table table-hover">
					<tr>
						<td><h4>NOMBRE DEL PRODUCTO</h4></td>
						<td><h4>PRECIO</h4></td>
						<td><h4>CANTIDAD</h4></td>
						<td><h4>SUBTOTAL</h4></td>
					</tr>
				<?php
			$i =1;
			foreach ($this->cart->contents() as $item ):
				?>
				<input type="hidden" name="<?php echo $i; ?>[rowid]" value="<?php echo $item['rowid']; ?>" />
				<tr>
					<td><?php
					echo $item['name'];
					?></td>
					<td><?php
					echo number_format($item['price'], 2, ',', '.');
					?></td>
					<td>
					<input type="text" name="<?php echo $i; ?>[qty]" value="<?php echo $item['qty']; ?>" maxlength="3" size="5"/>
					</td>
					<td><?php echo number_format($item['subtotal'], 2, ',', '.'); ?></td>
				</tr>
				<?php
				$i++;
				endforeach;
				?>
			<tr>
				<td colspan="2">
					<button class="btn btn-default" type="submit" name="actualizar">Actualizar Carrito</button>
					<?php echo anchor('welcome/vaciar_carrito', 'Vaciar Carrito'); ?>
				</td>
				<td><h4>Total:</h4></td>
				<td><h4><?php echo $this -> cart -> format_number($this -> cart -> total()); ?></h4></td>
			</tr>
			</table>
		</form>
	</div>
	<div  class="col-md-6">
		<center><h2>REGISTRAR VENTA</h2></center>
		<form action="registrar_venta" method="POST">
			Ingrese su id: <input type="text" name="idC" />
			<button class="btn btn-default" type="submit" name="registrar">Registrar</button>
		</form>
	</div>
</div>
<?php
$this -> load -> view('includes/footer');
?>