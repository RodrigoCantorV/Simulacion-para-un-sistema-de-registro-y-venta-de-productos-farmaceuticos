<!--ALTER TABLE tblname AUTO_INCREMENT = 0;-->
<script type="text/javascript" src="../js/functions.js"></script>
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
		empty($_POST['contacto']) || 
		empty($_POST['telefono']) || 
	//	empty($_POST['correo']) ||
		empty($_POST['direccion']) 
	   
	)
	 {
		$alert='<p class ="msg_error">Todos los campos son obligatorios</p>';
	 }
	 else
	 {
		
		$proveedor 	= $_POST['proveedor'];
	    $contacto   = $_POST['contacto'];
	    $telefono   = $_POST['telefono'];
	    $direccion  = $_POST['direccion'];
		$correo  	= $_POST['correo'];
		$usuario_id = $_SESSION['idUser'];

	  
	  	 	$query_insert = mysqli_query($conection,"INSERT INTO 
			proveedor
			(
			proveedor,
			contacto,
			telefono,
			correo,
			direccion,
			usuario_id
			)
		 VALUES
		 (
		 	'$proveedor',
		 	'$contacto',
		 	'$telefono',
		 	'$correo',
		 	'$direccion',
		 	'$usuario_id'
		 	)");

	  	 		if ($query_insert)
			 {
			$alert='<p class ="msg_save">El proveedor fue Guardado con exito</p>';
			}
			else
			{
			$alert='<p class ="msg_error">Error al Guardar el proveedor</p>';
			}
	 
	  	
			}
			 mysqli_close($conection);
			}
?>
  <!--/////////////////////////terminaprogramacion para insertar usuarios///////////////////////////////////////-->

<!DOCTYPE html>
	<html>
		<head>
  			<meta charset="utf-8">
			<title>REGISTRO  DE PROVEEDORES</title>
			<link rel="stylesheet" type="text/css" href="../CSS/a12-interfaz-registro-de-proveedores.css">

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
 
<a href="a12-interfaz-registro-de-proveedores.php">NUEVO</a>
<a href="a14-interfaz-modificar-proveedores-2.php">MODIFICAR</a> 
<a href="a15-interfaz-eliminar-proveedores-2.php">ELIMINAR</a>
<a href="a13-interfaz-lista-de-proveedores.php">BUSCAR</a>
 <a class="btn btn btn-danger" href="cerrar_sesion.php" role="button">IMPRIMIR</a>

  </ul>
</section>
 
 <!--/////////////////////////////////////////////////////////////AQUI TERMINA NUESTRO 2 MENU LATERAL///////////////////////////////////////-->


        

		<section class="register">
			<H1>GUARDAR PROVEEDOR </H1>
				<div 
				class="alert"><?php echo isset($alert)? $alert:''; ?>
				</div>
				<hr>
					<form action="" method="post">
						<div class="layout1">
    						<img src="../IMAGENES/foto.png">
						</div>
						<div class="layout2"action="" method="post">
							<td>
								<label for="proveedor">Proveedor</label>
								<input type="text" name="proveedor" id="proveedor" placeholder="Nombre del proveedor">
							</td>
							<td>
								<label for="contacto">Contacto</label>
								<input type="text" name="contacto" id="contacto" placeholder="Nombre completo del contacto">
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
										<label for="telefono">Telefono</label>
										<input type="text" name="telefono" id="telefono" placeholder="Numero de telefono">
									</td>

									<td>
										<label for="correo">Correo</label>
										<input type="email" name="correo" id="correo" placeholder="Correo Electronico">
									</td>
								</tr>
								<tr>
									<td>
										<label for="direccion">direccion</label>
										<input type="text" name="direccion" id="direccion" placeholder="Numero de direccion">
									</td>
									<td>	
									</td>
								</tr>	
							</table>
						<input type="submit" value="Guardar PROVEEDOR" class="btn1">
	</div>
</form>
</section>
  


</body>
</html>

