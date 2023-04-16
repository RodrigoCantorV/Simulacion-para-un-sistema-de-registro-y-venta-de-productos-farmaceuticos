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
		empty($_POST['proveedor'])  || 
		empty($_POST['producto'])   || 
		empty($_POST['precio'])     || 
		empty($_POST['id'])  	    ||
		empty($_POST['foto_actual'])||
		empty($_POST['foto_remove'])
	)
	 {
		$alert='<p class ="msg_error">Todos los campos son obligatorios</p>';
	 }
	 else
	 {
		
	 	$codproducto = $_POST['id'];
		$proveedor 	 = $_POST['proveedor'];
	    $producto    = $_POST['producto'];
	    $precio  	 = $_POST['precio'];
	    $imgProducto = $_POST['foto_actual'];
	    $imgRemove   = $_POST['foto_remove'];
		$usuario_id  = $_SESSION['idUser'];

		$foto  			= $_FILES['foto'];
		$nombre_foto 	= $foto['name'];
		$type  			= $foto['type'];
		$url_temp   	= $foto['tmp_name'];

		$upd  	= '';


		if ($nombre_foto != '')
		 {
		 	$destino  		= '../IMAGENES';
		 	$img_nombre  	= 'img_'.md5(date('d-m-Y H:m:s'));
			 $imgProducto  	= $img_nombre.'.jpg';
			 $src   		= $destino.$imgProducto;
			  }	  else
			  {
			  	if ($_POST['foto_actual'] != $_POST['foto_remove'] )
			  	 {
			  	$imgProducto = 'img_producto.png';
			  	}
			  }

	  	 	$query_update = mysqli_query($conection,"UPDATE 
			producto
			SET
			
			descripcion = '$producto',
			proveedor   = $proveedor,
			precio      = $precio,
			foto        = '$imgProducto'
			
		 WHERE codproducto = $codproducto");

	  	 		if ($query_update)
			 {
			 	if (($nombre_foto != '' && ($_POST['foto_actual'] != 'img_producto.png'))
			 	 || ($_POST['foto_actual'] != $_POST['foto_remove']))
			 	 {
			 		unlink('../IMAGENES'.$_POST['foto_actual']);
			 	}

			if ($nombre_foto != '')
		 	{
		 		move_uploaded_file($url_temp, $src);
		 	}

			$alert='<p class ="msg_save">El Producto fue Actualizado con exito</p>';
			}
			else
			{
			$alert='<p class ="msg_error">Error al Actualizar el Producto</p>';
			}
	 		}		 
			}
			//validar producto
			if (empty($_REQUEST['id']))
			 {
			header("location:a18-interfaz-lista-de-productos.php");	 			
			}
			else
			{
				$id_producto = $_REQUEST['id'];
				if (!is_numeric($id_producto))
				 {
					header("location:a18-interfaz-lista-de-productos.php");
				}
			$query_producto= mysqli_query($conection,"SELECT
			 p.codproducto,
			 p.descripcion,
			 p.precio,
			 p.foto,
			 pr.codproveedor,
			 pr.proveedor
			 FROM  producto p
			 INNER JOIN Proveedor pr
			 ON p.proveedor = pr.codproveedor
			 WHERE p.codproducto = $id_producto AND p.estado =1");
				$result_producto = mysqli_num_rows($query_producto);

				$foto='';
				$classRemove ='notBlock';

				if ($result_producto > 0)
				 {
				$data_producto= mysqli_fetch_assoc($query_producto);


				if ($data_producto['foto'] != "img_producto.png")
				 {
				$classRemove='';
				$foto ='<img id="img" src="../IMAGENES'.$data_producto['foto'].'" alt="Producto">';
				}

				
				}else
				{
				header("location:a18-interfaz-lista-de-productos.php");
				}

			}
?>
  <!--/////////////////////////terminaprogramacion para insertar usuarios///////////////////////////////////////-->

<!DOCTYPE html>
	<html>
		<head>
<?php include"scripts.php"; ?>
  			<meta charset="utf-8">
			<title>Actualizar productos</title>
			<link rel="stylesheet" type="text/css" href="../CSS/a19-interfaz-modificar-productos.css">

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
 <H1>ACTUALIZAR PRODUCTO </H1>
 <div 
 class="alert"><?php echo isset($alert)? $alert:''; ?>
 </div>
<hr>
	<form action="" method="post" enctype="multipart/form-data">
	
	<input type="hidden" name="id" value="<?php echo $data_producto['codproducto']; ?>">
	<input type="hidden" id="foto_actual" name="foto_actual" value="<?php echo $data_producto['foto']; ?>">
	<input type="hidden" id="foto_remove" name="foto_remove" value="<?php echo $data_producto['foto']; ?>">

	<div class="layout1">
		<div class="photo" >
		<label for="foto">Foto</label>
		<div class="prevPhoto">
		<span class="delPhoto <?php echo $classRemove; ?>">X</span>
		<label for="foto"></label>
		<?php  echo $foto; ?>
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
								<select name="proveedor" id="proveedor" class="notItemOne">
									 <option value="<?php echo $data_producto['codproveedor']; ?>" selected><?php echo $data_producto['proveedor']; ?></option>
									<?php 
									if ($result_proveedor > 0) {
									while ($proveedor = mysqli_fetch_array($query_proveedor))
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
								<input type="text" name="producto" id="producto" placeholder="Nombre del producto" value="<?php echo $data_producto['descripcion']; ?>">
							</td>	
							<td>
										<label for="precio">Precio</label>
										<input type="number" name="precio" id="precio" placeholder="	Precio del producto " value="<?php echo $data_producto['precio']; ?>">
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
										
									</td>
								</tr>
								<tr>
									<td>
										
									</td>
									<td>	
									</td>
								</tr>	
							</table>
						<input type="submit" value="Actualizar Producto" class="btn1">
	</div>
	</form>
</section>
  


</body>
</html>

