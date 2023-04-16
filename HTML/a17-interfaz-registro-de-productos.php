<!--ALTER TABLE tblname AUTO_INCREMENT = 0;-->

   <?php include"fechas.php";  ?>


  <?php 
  session_start();

   if ($_SESSION['rol']!=1 and $_SESSION['rol']!=2)
    {
   header("location:../HTML/0-inicio-usuario.php");
   }
    ?>

   <?php

if(empty($_SESSION['active']))
{
header('location:../HTML/login.php');
}
  ?>

  <!--/////////////////////////programacion para insertar usuarios///////////////////////////////////////-->
<?php
	include"../HTML/abrir-conexion.php";
	if (!empty($_POST)) 
	{
		
	$alert='';
	if (
		empty($_POST['proveedor']) || 
		empty($_POST['producto'])  || 
		empty($_POST['precio'])    || 
		     $_POST['precio'] <= 0 || 
		empty($_POST['cantidad'])  ||
		     $_POST['cantidad'] <= 0
	)
	 {
		$alert='<p class ="msg_error">Todos los campos son obligatorios</p>';
	 }
	 else
	 {
		
		$proveedor 	= $_POST['proveedor'];
	    $producto   = $_POST['producto'];
	    $precio   = $_POST['precio'];
	    $cantidad  = $_POST['cantidad'];
		$usuario_id = $_SESSION['idUser'];

		$foto  			= $_FILES['foto'];
		$nombre_foto 	= $foto['name'];
		$type  			= $foto['type'];
		$url_temp   	= $foto['tmp_name'];

		$imgProducto  	= 'img_producto.png';


		if ($nombre_foto != '')
		 {
		 	$destino  		= '../IMAGENES';
		 	$img_nombre  	= 'img_'.md5(date('d-m-Y H:m:s'));
			 $imgProducto  	= $img_nombre.'.jpg';
			 $src   		= $destino.$imgProducto;
			  }	  

	  	 	$query_insert = mysqli_query($conection,"INSERT INTO 
			producto
			(
			proveedor,
			descripcion,
			precio,
			existencia,
			usuario_id,
			foto
			)
		 VALUES
		 (
		 	'$proveedor',
		 	'$producto',
		 	'$precio',
		 	'$cantidad',
		 
		 	'$usuario_id',
		 	'$imgProducto'
		 	)");

	  	 		if ($query_insert)
			 {

			if ($nombre_foto != '')
		 	{
		 		move_uploaded_file($url_temp,$src);
		 	}

			$alert='<p class ="msg_save">El Producto fue Guardado con exito</p>';
			}
			else
			{
			$alert='<p class ="msg_error">Error al Guardar el Producto</p>';
			}
	 
	  	
			}
			 
			}
?>
  <!--/////////////////////////terminaprogramacion para insertar usuarios///////////////////////////////////////-->

<!DOCTYPE html>
	<html>
		<head>
 <?php include"scripts.php"; ?>
  			<meta charset="utf-8">
  	
			<title>REGISTRO  DE PRODUCTOS</title>
			<link rel="stylesheet" type="text/css" href="../CSS/a17-interfaz-registro-de-productos22.css">

		</head>
		<body>
 			<header>   
             	<nav class="navegacion">
             	<ul class="menu">
             	<li > <img src="../IMAGENES/medicina.png"></li>
                <li><a  href="#"><h1>Sistema de ventas</h1></a></li>
                <li><a href="#"><h3>Farmacia UDEC V1.0</h3></a></li>
                <li class="fecha"><a href="#">Fusasuga, <?php echo fechaC(); ?></a></li>
                <li class="name"><a href="#"><?php echo $_SESSION['user'].'-'.$_SESSION['rol'] ; ?></a></li>
                <li><a href=""><i class="fas fa-camera"></i></a></li> 
                <li><a href="salir.php"><i class="fas fa-power-off" alt="salir.php" title="salir"></i></a></li>  
               </ul>
              </nav>
     	   </header>


  <!--/////////////////////////////////////////////////////////////AQUI INICIA MENU DE 2CABECERA///////////////////////////////////////-->

			<section class="servis">
  				<form>
   					<table class="menu2">
              			<tr>
                			<td>
                				<a href="0-inicio-usuario.php"><img src="../IMAGENES/home.png" width=80px text="sad"></a>
                			</td>
                  			  <?php
                			if ($_SESSION['rol']==1)
                 			{
                			 ?>
                			<td>
                				<a href="1-interfaz-usuario.php"><img src="../IMAGENES/adduser.png" width="80px"></a>
                			</td>

               					<?php 
           						 }
                				 ?>
               				<td><a href="a16-interfaz-de-productos.php"><img src="../IMAGENES/midicina.png" width="80px"></a>
               				</td>
			                <td>
			                	<a href="6.0-interfaz-de-clientes.php"><img src="../IMAGENES/cliente.png" width="80px"></a>
			                </td>
			        
			              

			                <td>
			                	<a href="a11-interfaz-de-proveedores.php"><img src="../IMAGENES/proveedor.png" width="80px"></a>
			                </td>

			              

			                <td>
			                	<a href="a21-interfaz-ventas.php"><img src="../IMAGENES/venta.png" width="80px"></a>
			                </td>
			                <td>
			                	<a href=""><img src="../IMAGENES/balance.png" width="80px"></a>
			                </td>
              			</tr>

              			<tr>
		               		 <td>
		               		 	INICIO
		               		 </td>
		                    <?php
		                	if ($_SESSION['rol']==1)
		                	 {
		                 	?>
		                <td>USUARIOS</td>
		                <?php 
		                }
		                 ?>
		                <td>PRODUCTOS</td>
		                <td>CLIENTES</td>
		                <td>PROVEEDORES</td>
		                <td>VENTAS</td>
		                <td>BALANCE</td>
		              </tr>

    				</table>       
  				</form>
			</section>
 <!--/////////////////////////////////////////////////////////////AQUI TERMINA NUESTRO MENU DE 2CABECERA///////////////////////////////////////--> 


 
 <!--/////////////////////////////////////////////////////////////AQUI INICIA NUESTRO 2 MENU LATERAL///////////////////////////////////////-->

<section class="OPCIONES">
   <ul>
<a href="a17-interfaz-registro-de-productos.php">NUEVO</a>
<a href="a19-interfaz-modificar-productos-2.php">MODIFICAR</a>
<a href="a20-interfaz-eliminar-productos.php">ELIMINAR</a>
<a href="a18-interfaz-lista-de-productos.php">BUSCAR</a>
 <a class="btn btn btn-danger" href="" role="button">IMPRIMIR</a>

  </ul>
</section>
 
 <!--/////////////////////////////////////////////////////////////AQUI TERMINA NUESTRO 2 MENU LATERAL///////////////////////////////////////-->


        

		<section class="register">
			<H1>GUARDAR PRODUCTO </H1>
				<div 
				class="alert"><?php echo isset($alert)? $alert:''; ?>
				</div>
				<hr>
					<form action="" method="post" enctype="multipart/form-data">
						<div class="layout1">
	<div class="photo" enctype="multipart/form-data">
	<label for="foto">Foto</label>
        <div class="prevPhoto">
        <span class="delPhoto notBlock">X</span>
        <label for="foto"></label>
        </div>
        <div class="upimg">
        <input type="file" name="foto" id="foto">
        </div>
        <div id="form_alert"></div>
</div>

						</div>
	
									

						</div>
						<div class="layout2"action="" method="post">
							<td>
								<label for="proveedor">Proveedor</label>
								<?php 
								$query_proveedor=mysqli_query($conection,"SELECT codproveedor , proveedor FROM proveedor
								 WHERE estado = 1 ORDER BY proveedor ASC");
								$result_proveedor = mysqli_num_rows($query_proveedor);
								mysqli_close($conection);
								 ?>
								<select name="proveedor" id="proveedor">
									<?php 
									if ($result_proveedor > 0) {
									while ($proveedor = mysqli_fetch_array
										($query_proveedor))
										 {
										?>
										<option value="<?php echo $proveedor['codproveedor']; ?>"><?php echo $proveedor['proveedor'];  ?></option>
										<?php  
									}
									}
									 ?>
									
								</select>
							</td>
							<td>
								<label for="producto">Producto</label>
								<input type="text" name="producto" id="producto" placeholder="Nombre del producto">
							</td>	
						</div>
						<div class="layout3">
							<table>						
								<tr>
									<td>
			
									</td>
									<td>

									</td>
								</tr>
								<tr>
									<td>
										<label for="precio">Precio</label>
										<input type="number" name="precio" id="precio" placeholder="	Precio del producto ">
									</td>

									<td>
										<label for="cantidad">Cantidad</label>
										<input type="number" name="cantidad" id="cantidad" placeholder="Cantidad del producto">
									</td>
								</tr>
								<tr>
									<td>
										
									</td>
									<td>	
									</td>
								</tr>	
							</table>
						<input type="submit" value="Guardar Producto" class="btn1">
	</div>
</form>
</section>
  


</body>
</html>

