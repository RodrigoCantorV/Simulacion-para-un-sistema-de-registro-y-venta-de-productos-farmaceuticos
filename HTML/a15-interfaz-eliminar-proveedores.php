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
header('location:../HTML/0-inicio-usuario.php');
}

 ?>


<?php
  include"../HTML/abrir-conexion.php";

if (!empty($_POST))
 {
  if ($_POST['idproveedor'] ==1){
 header("location: ../HTML/a13-interfaz-lista-de-proveedores.php"); 
  mysqli_close($conection);
   exit;
   
      
  }
  $idproveedor=$_POST['idproveedor'];

  //$query_delete= mysqli_query($conection,"DELETE FROM usuario WHERE idusuario=$idusuario");
  $query_delete= mysqli_query($conection,"UPDATE proveedor SET estado = 0 WHERE codproveedor = $idproveedor");
   mysqli_close($conection);
  if ($query_delete) {

    header("location: ../HTML/a13-interfaz-lista-de-proveedores.php");  
  }else
  {
    echo "Error al eliminar proveedor";
  }

}

if (empty($_REQUEST['id'])) 
{
header("location: ../HTML/a13-interfaz-lista-de-proveedores.php");  
 mysqli_close($conection); 
}else
{

  $idproveedor=$_REQUEST['id'];
  $query = mysqli_query($conection,"SELECT * FROM proveedor
                                            WHERE codproveedor =  $idproveedor");
   mysqli_close($conection);
  $result = mysqli_num_rows($query);

  if($result >0)
  {
while ($data=mysqli_fetch_array($query))
{
  $proveedor=$data['proveedor'];
  
 
 
}
}else
{
  header("a13-interfaz-lista-de-proveedores.php");  
  }
}

 ?>
  <!DOCTYPE html>
  <html>
  <head>
    <title>
  ELIMINAR PROVEEDOR
    </title>
   <link rel="stylesheet" type="text/css" href="../CSS/a15-interfaz-eliminar-proveedores.css">
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
<a href="a12-interfaz-registro-de-proveedores.php">NUEVO</a>
<a href="a14-interfaz-modificar-proveedores-2.php">MODIFICAR</a>
 <?php 
          if ($_SESSION['rol']==1 || $_SESSION['rol']==2 ) {
          ?>
<a href="a15-interfaz-eliminar-proveedores-2.php">ELIMINAR</a>
<?php 
}
 ?>

<a href="a13-interfaz-lista-de-proveedores.php">BUSCAR</a>
 <a class="btn btn btn-danger" href="cerrar_sesion.php" role="button">IMPRIMIR</a>

  </ul>
</section>
 
 <!--/////////////////////////////////////////////////////////////AQUI TERMINA NUESTRO 2 MENU LATERAL///////////////////////////////////////-->



<section class="inicio">
  
  <H1>ELIMINAR PROVEEDOR</H1>
   
  <hr>
<form  method="post" action="" >
<div class="data_delete">
  <h2>¿Esta seguro de eliminar el siguiente registro?</h2>
  <img src="../IMAGENES/warning.png">
  <p>Nombre del proveedor: <span><?php echo $proveedor; ?></span></p>
    

      <form>
        <input type="hidden" name="idproveedor" value="<?php echo $idproveedor; ?>">
        <a href="../HTML/a13-interfaz-lista-de-proveedores.php" class="btn_cancel">Cancelar</a>
        <input type="submit" name="" value="Eliminar"class="btn_ok">
      </form>

</div>
</form>
</section>


  </body>
  </html>
 
    
 