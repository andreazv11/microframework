<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>MVC - Modelo, Vista, Controlador - Jourmoly</title>
</head>

<body>


	<form action="index.php">

		<input type="hidden" name="controlador" value="item">
		<input type="hidden" name="accion" value="editar">

		<label for="codigo">Codigo</label>
		<input type="text" name="codigo" value="<?php echo $item->getCodigo(); ?>">
		</br>

		<?php echo isset($errores["item"]) ? "*" : "" ?>
		<label for="item">Item</label>
		<input type="text" name="item" value="<?php echo $item->getItem(); ?>">
		</br>

		<input type="submit" name="submit" value="Aceptar">
	</form>
	</br>
	<?php
    if (isset($errores)):
	    foreach ($errores as $key => $error):
		    echo $error . "</br>";
	    endforeach;
    endif;
    ?>

</body>

</html>