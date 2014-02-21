<?php
$this -> load -> view('includes/header');
$this -> load -> view('includes/menu');
/*Limpiamos el carrito*/
$this -> cart -> destroy();
?>
<div class="row">
	<h2>CONTENIDO DE LA VENTA</h2>
	<div class="col-md-6" >
		<table class="table table-hover">
			<tr>
				<td><h4>NOMBRE DEL PRODUCTO</h4></td>
				<td><h4>PRECIO</h4></td>
				<td><h4>CANTIDAD</h4></td>
				<td><h4>SUBTOTAL</h4></td>
			</tr>	
			<?php
			$i =1;
			$total=0;
			foreach ($output as $item ):
			?>
			<tr>
				<td><?php
				echo $item['name'];
				?></td>
				<td><?php
				echo number_format($item['price'], 2, ',', '.');
				?></td>
				<td>
				<?php echo $item['qty']; ?>
				</td>
				<td><?php echo number_format($item['subtotal'], 2, ',', '.'); ?></td>
			</tr>
			<?php $total += ($item['price'] * $item['qty']); ?>
			<?php
			$i++;
			endforeach;
			?>
			<tr>
				<td><h4>Total:</h4></td>
				<td><h4><?php echo number_format($total, 2, ',', '.'); ?></h4></td>
			</tr>
		</table>
	</div>
</div>
<?php
$this -> load -> view('includes/footer');
?>