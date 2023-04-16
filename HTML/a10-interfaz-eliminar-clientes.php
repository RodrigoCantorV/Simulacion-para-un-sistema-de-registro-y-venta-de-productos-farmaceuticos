<script type="text/javascript" src="../js/functions.js"></script>
   <?php include"fechas.php";  ?>


   <?php
session_start();
if(empty($_SESSION['active']))
{
header('location:../HTML/login.php');
}
  ?>

<?php 
if ($_SESSION['rol'] != 1 and $_SESSION['rol']!=2 ) {
header('location:../HTML/6.0-interfaz-de-clientes.php');
}

 ?>


<?php
  include"../HTML/abrir-conexion.php";

if (!empty($_POST))
 {
  if ($_POST['idcliente'] ==1){
 header("location: ../HTML/8-interfaz-lista-de-clientes.php"); 
  mysqli_close($conection);
   exit;
   
      
  }
  $idcliente=$_POST['idcliente'];

  //$query_delete= mysqli_query($conection,"DELETE FROM usuario WHERE idusuario=$idusuario");
  $query_delete= mysqli_query($conection,"UPDATE cliente SET estado = 0 WHERE idcliente = $idcliente");
   mysqli_close($conection);
  if ($query_delete) {

    header("location: ../HTML/8-interfaz-lista-de-clientes.php");  
  }else
  {
    echo "Error al eliminar usuario";
  }

}

if (empty($_REQUEST['id'])) 
{
header("location: ../HTML/8-interfaz-lista-de-clientes.php");  
 mysqli_close($conection); 
}else
{

  $idcliente=$_REQUEST['id'];
  $query = mysqli_query($conection,"SELECT * FROM cliente
                                            WHERE idcliente =  $idcliente");
   mysqli_close($conection);
  $result = mysqli_num_rows($query);

  if($result >0)
  {
while ($data=mysqli_fetch_array($query))
{
  $nit=$data['nit'];
  $nombre=$data['nombre'];
 
 
}
}else
{
  header("8-interfaz-busqueda-de-clientes.php");  
  }
}

 ?>
  <!DOCTYPE html>
  <html>
  <head>
    <title>
  ELIMINAR CLIENTE
    </title>
   <link rel="stylesheet" type="text/css" href="../CSS/a10-interfaz-eliminar-clientes.css">
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
                <td>USUARIOS</td>
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



<section class="inicio">
  
  <H1>ELIMINAR USUARIO</H1>
   
  <hr>
<form  method="post" action="" >
<div class="data_delete">
  <h2>¿Esta seguro de eliminar el siguiente registro?</h2>
  <img src="../IMAGENES/warning.png">
  <p>Nombre del cliente: <span><?php echo $nombre; ?></span></p>
    <p>nit: <span><?php echo $nit; ?></span></p>
    

      <form>
        <input type="hidden" name="idcliente" value="<?php echo $idcliente; ?>">
        <a href="../HTML/8-interfaz-lista-de-clientes.php" class="btn_cancel">Cancelar</a>
        <input type="submit" name="" value="Eliminar"class="btn_ok">
      </form>

</div>
</form>
</section>


  </body>
  </html>
 
    
