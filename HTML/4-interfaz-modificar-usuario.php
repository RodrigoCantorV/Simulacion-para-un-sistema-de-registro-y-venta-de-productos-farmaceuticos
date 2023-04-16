
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
	if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario'])
	 || empty($_POST['rol']) || empty($_POST['apellido']) || empty($_POST['documento'])
	 || empty($_POST['numdoc']) || empty($_POST['cumpleaños']) || empty($_POST['telefono'])
	 || empty($_POST['genero']))
	 {
	$alert='<p class ="msg_error">Todos los campos son obligatorios</p>';
	}else{
		$idusuario = $_POST['idusuario'];
		$nombre = $_POST['nombre'];
	    $apellido = $_POST['apellido'];
	    $documento = $_POST['documento'];
	     $num_doc = $_POST['numdoc'];
	     $cumpleaños = $_POST['cumpleaños'];
	     $telefono = $_POST['telefono'];
	     $genero = $_POST['genero'];
		$correo = $_POST['correo'];
	    $usuario = $_POST['usuario'];
	    $clave = md5($_POST['clave']);
	     $rol = $_POST['rol'];
	
		

		$query = mysqli_query($conection,"SELECT * FROM usuario
		 WHERE 
		 ( 
		  usuario = '$usuario'AND
		  idusuario != $idusuario) OR
		  (num_doc ='$num_doc' AND
		  idusuario != $idusuario) "
		);
		$result = mysqli_fetch_array($query);

		if ($result > 0) 
		{
		$alert='<p class ="msg_error">El usuario ya existe</p>';
		}else
		{
			if (empty($_POST['clave']) || empty(!$_POST['clave']))
			 {
			$sql_update = mysqli_query($conection,"UPDATE usuario
				SET nombre='$nombre',
					apellido='$apellido',
					documento='$documento',
					num_doc='$num_doc',
					cumpleaños='$cumpleaños',
					telefono='$telefono',
					genero='$genero',
					correo='$correo',
					usuario='$usuario',
					rol='$rol',
					clave ='$clave'
				WHERE idusuario ='$idusuario'  ");
			}else
			{
			//	
			$sql_update = mysqli_query($conection,"UPDATE usuarios
			 	SET nombre='$nombre',
			 		apellido='$apellido',
			 		documento='$documento',
			 		num_doc='$num_doc',
			 		cumpleaños='$cumpleaños',
			 		telefono='$telefono',
			 		genero='$genero',
			 		correo='$correo',
			 		usuario='$usuario',
			 		rol='$rol',
			 		clave='$clave'
			 		WHERE idusuario ='$idusuario'  ");

			}

			if ($sql_update) {

						$alert='<p class ="msg_save">El usuario fue actualizado correctamente con exito</p>';
			}else

			{
			$alert='<p class ="msg_error">Error al actualizar el usuario</p>';
			}

		}

	} //mysqli_close($conection);	


}


// Mostrar datos
if (empty($_GET['id']))
 {
 	header('location:../HTML/3-interfaz-lista-de-usuarios.php');
 	mysqli_close($conection);
}
$iduser = $_GET['id'];
$sql=mysqli_query($conection,"SELECT
                              u.idusuario,
                              u.nombre,
                              u.apellido,
                              u.documento,
                              u.num_doc,
                              u.cumpleaños,
                              u.genero,
                              u.telefono,
                              u.usuario,
                              u.correo ,(u.rol)
                              as idrol,(r.rol) as rol
                              FROM usuario u 
                              INNER JOIN rol r ON u.rol =r.idrol
                              WHERE idusuario =$iduser and estado = 1");
mysqli_close($conection);

$result_sql = mysqli_num_rows($sql);
 if ($result_sql == 0) 
 {
 		header('location:../HTML/3-interfaz-lista-de-usuarios.php');
 }else
 {
 	$option ='';
 	while ($data = mysqli_fetch_array($sql)) {

 $iduser = $data['idusuario'];

 $usuario = $data['usuario'];
 $nombre = $data['nombre'];
 $apellido = $data['apellido'];
 $documento = $data['documento'];
 $num_doc = $data['num_doc'];
 $nacimiento = $data['cumpleaños'];
 $genero = $data['genero'];
 $telefono = $data['telefono'];
 $correo = $data['correo'];
 $idrol = $data['idrol'];
 $rol = $data['rol'];


if ($idrol ==1) {
	$option ='<option value="'.$idrol.'"select>'.$rol.'</option>';
}else if ($idrol ==2)
{
	$option ='<option value="'.$idrol.'"select>'.$rol.'</option>';
}else if ($idrol ==3) {
	$option ='<option value="'.$idrol.'"select>'.$rol.'</option>';
}

 	}
 }
  ?>
  <!--/////////////////////////terminaprogramacion para insertar usuarios///////////////////////////////////////-->

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">

	<title>MODIFICAR USUARIO</title>
<link rel="stylesheet" type="text/css" href="../CSS/4-interfaz-modificar-usuario.css">

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
<a href="2-interfaz-registro-de-usuarios.php">NUEVO</a>
<a href="4-interfaz-modificar-usuario-2.php">MODIFICAR</a>
<a href="5-interfaz-eliminar-usuario-2.php">ELIMINAR</a>
<a href="3-interfaz-lista-de-usuarios.php">BUSCAR</a>
 <a class="btn btn btn-danger" href="cerrar_sesion.php" role="button">IMPRIMIR</a>

  </ul>
</section>
 
 <!--/////////////////////////////////////////////////////////////AQUI TERMINA NUESTRO 2 MENU LATERAL///////////////////////////////////////-->


        

<section class="register">
	
	<H1>MODIFICAR USUARIO </H1>
		<div class="alert"><?php echo isset($alert)? $alert:''; ?></div>
	<hr>
<form action="" method="post">
	<div class="layout1">
    <img src="../IMAGENES/foto.png">
	</div>

	<div class="layout2"action="" method="post">

	<label for="codigo" width="80px">Codigo</label>
		<input type="text" name="idusuario" id="idusuario" placeholder="idusuario" value="<?php echo $iduser; ?>">
		
		
		<label for="rol">Tipo de usuario</label>
		          <?php
		          include"../HTML/abrir-conexion.php";
                 	$query_rol=mysqli_query($conection,"SELECT * FROM rol");
                 	mysqli_close($conection);
                 	$result_rol =mysqli_num_rows($query_rol);

                 	

		            ?>
		<select name="rol" id="rol"class="notItemOne">
			<?php 
			echo $option;
if ($result_rol >0) {
                 while ($rol =mysqli_fetch_array($query_rol)) {
                 	?>
                 	<option value="<?php echo $rol["idrol"] ?>
                 	"><?php echo $rol["rol"]; ?></option>

                 	<?php 
                 		# code...
                 	}
                 	}
			 ?>
			
		
		</select>

		<label for="usuario">Usuario</label>
		<input type="text" name="usuario" id="usuario" placeholder="Usuaro" value="<?php  echo$usuario;  ?>">
		
		<label for="clave">Contraseña</label>
		<input type="password" name="clave" id="clave" placeholder="Contraseña"   >

	</div>
	<div class="layout3">

<table>
	<tr>
		<td><label for="nombre">Nombre</label>
		<input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="<?php  echo$nombre;  ?>">
	</td>
		<td>
		<label for="apellido">Apellido</label>
		<input type="text" name="apellido" id="apellido" placeholder="apellido completo" value="<?php  echo$apellido;  ?>" ></td>
	</tr>
	<tr>
		<td><label for="documento">Tipo de documento</label>
		<select name="documento" id="documento"value="<?php  echo$documento;  ?>">
			<option value="1"> Cedula   </option>
			<option value="2">Tarjeta de id</option>
			<option value="3">Tarjeta de ex</option>
		</select></td>
		<td>
	<label for="numdoc">N° Documento</label>
		<input type="text" name="numdoc" id="numdoc" placeholder="Numero de documento" value="<?php  echo$num_doc; ?>"></td>
	</tr>

	<tr>
		<td>
		<label for="cumpleaños">Fecha-nacimiento</label>
		<input type="date" name="cumpleaños" id="cumpleaños" placeholder="Fecha-nacimiento"value="<?php  echo$nacimiento;  ?>"></td>

		<td>
		<label for="genero">Genero</label>
		<select name="genero" id="genero" value="<?php  echo$genero;  ?>">
			<option value="M">Masculino</option>
			<option value="F">Femenino </option>			
		</select>
</td>
	</tr>
	<tr>
		<td>
			<label for="telefono">Telefono</label>
		<input type="text" name="telefono" id="telefono" placeholder="Numero de telefono"value="<?php  echo$telefono;  ?>"></td>

		<td>	<label for="correo">Correo</label>
		<input type="email" name="correo" id="correo" placeholder="Correo Electronico"value="<?php  echo$correo;  ?>">
		</td>

	</tr>	
</table>
	<input type="submit" value="MODIFICAR USUARIO" class="btn1">
	</div>
</form>
</section>
  


</body>
</html>

