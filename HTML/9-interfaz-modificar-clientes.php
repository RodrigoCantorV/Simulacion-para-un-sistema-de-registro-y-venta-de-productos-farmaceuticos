
<script type="text/javascript" src="../js/functions.js"></script>
   <?php include"fechas.php";  ?>


   <?php
session_start();
if(empty($_SESSION['active']))
{
header('location:../HTML/login.php');
}
  ?>






  <!--/////////////////////////programacion para modificar //////////////////////////////////////-->
<?php
include"../HTML/abrir-conexion.php";
if (!empty($_POST)) 
{
	$alert='';
	if
	(
		empty($_POST['nombre']) ||
		empty($_POST['apellido']) ||
		empty($_POST['documento'])||
	//	empty($_POST['nit']) ||
		empty($_POST['genero']) ||
		empty($_POST['telefono'])||
		empty($_POST['correo']) ||
		empty($_POST['direccion'])
	 
		)
	 {
	$alert='<p class ="msg_error">Todos los campos son obligatorios</p>';
	}else{
		 $idcliente = $_POST['id'];
		 $documento = $_POST['documento'];
		 $nit 	= $_POST['nit'];
		 $nombre 	= $_POST['nombre'];
	     $apellido 	= $_POST['apellido'];
	     $genero 	= $_POST['genero'];
	     $telefono = $_POST['telefono'];
	     $direccion = $_POST['direccion'];
	     $correo = $_POST['correo'];
	   
	   
	
			$result=0;
			if (is_numeric($nit) and $nit !=0)
			 {
		 	$query = mysqli_query($conection,"SELECT * FROM cliente
		 	WHERE 
			 ( 
		  nit = '$nit'AND
		  idcliente != '$idcliente')");	
		  $result=mysqli_fetch_array($query);
		//  $result = count($result);
	
			# code...
		}


		if ($result > 0) 
		{
		$alert='<p class ="msg_error">El nit ya existe, ingrese otro</p>';
		}else
		{

			if ($nit=='')
			 {
			 	$nit=0;
				# code...
			}
			
			$sql_update = mysqli_query($conection,"UPDATE cliente
				SET nombre='$nombre',
					apellido='$apellido',
					documento='$documento',
					nit='$nit',
					genero='$genero',
					telefono='$telefono',
					correo='$correo',
					direccion='$direccion'
				WHERE idcliente ='$idcliente'  ");
			

			if ($sql_update) {

						$alert='<p class ="msg_save">El cliente fue actualizado correctamente </p>';
			}else

			{
			$alert='<p class ="msg_error">Error al actualizar el cliente</p>';
			}

		}

	} //mysqli_close($conection);	


}


// Mostrar datos
if (empty($_GET['id']))
 {
 	header('location:../HTML/8-interfaz-lista-de-clientes.php');
 	mysqli_close($conection);
}
$idcliente = $_GET['id'];
$sql=mysqli_query($conection,"SELECT * FROM cliente WHERE idcliente = $idcliente and estado = 1 ");
mysqli_close($conection);

$result_sql = mysqli_num_rows($sql);
 if ($result_sql == 0) 
 {
 		header('location:../HTML/8-interfaz-lista-de-clientes.php');
 }else
 {
 	
 	while ($data = mysqli_fetch_array($sql)) {

 $idcliente = $data['idcliente'];
 $documento = $data['documento'];
 $nit 		= $data['nit'];
 $nombre 	= $data['nombre'];
 $apellido 	= $data['apellido'];
 $genero 	= $data['genero'];
 $telefono 	= $data['telefono'];
 $correo 	= $data['correo'];
 $direccion = $data['direccion'];




 	}
 }
  ?>
  <!--/////////////////////////terminaprogramacion para insertar usuarios///////////////////////////////////////-->

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">

	<title>ACTUALIZAR CLIENTE</title>
<link rel="stylesheet" type="text/css" href="../CSS/9-interfaz-modificar-clientes.css">

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
                <td><a href="0-inicio-usuario.php"><img src="../IMAGENES/home.png" width=80px text="sad"></a></td>
                    <?php
                if ($_SESSION['rol']==1)
                 {

                 ?>
                <td><a href="1-interfaz-usuario.php"><img src="../IMAGENES/adduser.png" width="80px"></a></td>
                <?php 
            }
                 ?>
                <td><a href="a16-interfaz-de-productos.php"><img src="../IMAGENES/midicina.png" width="80px"></a></td>
                <td><a href="6.0-interfaz-de-clientes.php"><img src="../IMAGENES/cliente.png" width="80px"></a></td>
                <td><a href="a11-interfaz-de-proveedores.php"><img src="../IMAGENES/proveedor.png" width="80px"></a></td>
                <td><a href="a21-interfaz-ventas.php"><img src="../IMAGENES/venta.png" width="80px"></a></td>
                <td><a href=""><img src="../IMAGENES/balance.png" width="80px"></a></td>
              </tr>

              <tr>
                <td>INICIO</td>
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
<a href="7-interfaz-registro-de-clientes.php">NUEVO</a>
<a href="9-interfaz-modificar-clientes-2.php">MODIFICAR</a>
 <?php 
          if ($_SESSION['rol']==1 || $_SESSION['rol']==2 ) {
          ?>
<a href="a10-interfaz-eliminar-clientes-2.php">ELIMINAR</a>
<?php }
 ?>
<a href="8-interfaz-lista-de-clientes.php">BUSCAR</a>
 <a class="btn btn btn-danger" href="cerrar_sesion.php" role="button">IMPRIMIR</a>

  </ul>
</section>
 
 <!--/////////////////////////////////////////////////////////////AQUI TERMINA NUESTRO 2 MENU LATERAL///////////////////////////////////////-->


        

<section class="register">
	
	<H1>MODIFICAR CLIENTE </H1>
		<div class="alert"><?php echo isset($alert)? $alert:''; ?></div>
	<hr>
<form action="" method="post">
	<div class="layout1">
    <img src="../IMAGENES/foto.png">
	</div>

	<div class="layout2"action="" method="post">

	
		<td><label for="nombre">Nombre</label>
		<input type="text" name="nombre" id="nombre" placeholder="Nombre completo"value="<?php echo $nombre; ?>"></td>
		<td>
		<label for="apellido">Apellido</label>
		<input type="text" name="apellido" id="apellido" placeholder="apellido completo" value="<?php echo $apellido; ?>">
	</td>
	<td>
		<input type="hidden" name="id" value="<?php echo $idcliente; ?>">
	</td>
	
		

	</div>
	<div class="layout3">

<table>
	<tr>
		
		
	</tr>
	<tr>
		<td><label for="documento">Tipo de documento</label>
		<select name="documento" id="documento">
			<option value="cedula"> Cedula   </option>
			<option value="tarjeta de id">Tarjeta de id</option>
			<option value="tarjeta de ex">Tarjeta de ex</option>
		</select></td>
		<td>
	<label for="nit">N° Documento</label>
		<input type="number" name="nit" id="nit" placeholder="Numero de documento" value="<?php echo $nit; ?>"></td>
	</tr>

	<tr>
		<td>
		<label for="genero">Genero</label>
		<select name="genero" id="genero">
			<option value="M">Masculino</option>
			<option value="F">Femenino </option>			
		</select>

		<td>
		<label for="telefono">Telefono</label>
		<input type="text" name="telefono" id="telefono" placeholder="Numero de telefono"value="<?php echo $telefono; ?>">
</td>
	</tr>
	<tr>
		<td>
			<label for="direccion">direccion</label>
		<input type="text" name="direccion" id="direccion" placeholder="Numero de direccion"value="<?php echo $direccion; ?>">
			</td>

		<td>	<label for="correo">Correo</label>
		<input type="email" name="correo" id="correo" placeholder="Correo Electronico"value="<?php echo $correo; ?>">
		</td>

	</tr>	
</table>
	<input type="submit" value="Actualizar cliente" class="btn1">
	</div>
</form>
</section>
  


</body>
</html>

