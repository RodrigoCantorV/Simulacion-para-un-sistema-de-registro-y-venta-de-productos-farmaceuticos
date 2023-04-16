

<?php
$alert = '';
session_start();



if(!empty($_SESSION['active']))
{
header('location:../HTML/0-inicio-usuario.php');
}
//else
//{
if(!empty($_POST)) 
{
if(empty($_POST['usuario']) || empty($_POST['clave']))
{
$alert = 'Ingrese su usuario y su clave';
} else
{
require_once "abrir-conexion.php";
$user= mysqli_real_escape_string($conection, $_POST['usuario']);
$pass= md5(mysqli_real_escape_string($conection,$_POST['clave']));
$query = mysqli_query($conection,"SELECT 
	u.idusuario,
	u.nombre,
	u.correo,
	u.usuario,
	r.idrol,
	r.rol
	 FROM usuario u
	 INNER JOIN rol r
	 ON u.rol = r.idrol
	  WHERE u.usuario='$user' AND u.clave = '$pass' AND u.estado=1");
mysqli_close($conection);
$result =mysqli_num_rows($query);
if ($result > 0) {
$data = mysqli_fetch_array($query);
$_SESSION['active']=true;
$_SESSION['idUser']=$data['idusuario'];
$_SESSION['nombre']=$data['nombre'];
$_SESSION['email'] =$data['correo'];
$_SESSION['user']=$data['usuario'];
$_SESSION['rol']=$data['idrol'];
$_SESSION['rol_name']=$data['rol'];
header('location:../HTML/0-inicio-usuario.php');
}else
{
$alert = 'El usuario o la clave son incorrectos';
session_destroy(); 
}
}
}
//}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>LOGIN | SISTEMA VENTAS </title>
		<link rel="stylesheet" type="text/css" href="../CSS/login.css">
    </head>
	<body>
		<form action=""method="post">
 			<div  class="box">
 			<h2>INICIAR SESION</h2>
 			<form>
 				<div class="inputBox">
 					<input type="text" name="usuario" required="">
 					<label>
 					<i class="fas fa-user"></i> Usuario
 					</label>
 				</div>
 				<div class="inputBox">
 					<input type="password" name="clave" required="">
 					<label>
 					<i class="fas fa-lock"></i>	 Contraseña
 					</label>
 				</div>
 				<div class="alert"><?php echo isset($alert) ? $alert : ''; ?>
 				</div>
 				<input type="submit" name="" value="INGRESAR">
 			</form>
 		</div>
	    </form>
	</body>| 
</html>
