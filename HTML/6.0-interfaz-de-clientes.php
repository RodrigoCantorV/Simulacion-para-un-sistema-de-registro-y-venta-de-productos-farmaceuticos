<script type="text/javascript" src="../js/functions.js"></script>
   <?php include"fechas.php";  ?>


   <?php
session_start();
if(empty($_SESSION['active']))
{
header('location:../HTML/login.php');
}
  ?>


  <!DOCTYPE html>
  <html>
  <head>
    <title>
    Sesion de usuario
    </title>
    <link rel="stylesheet" type="text/css" href="../CSS/6.0-interfaz-de-clientes.css">
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
                <td><a href="1-interfaz-usuario.php"><img src="../IMAGENES/adduser.png" width="80px"></a>
                </td>
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
                if ($_SESSION['rol']==1) {
                   # code...
                 
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
<?php
}
 ?>
<a href="8-interfaz-lista-de-clientes.php">BUSCAR</a>
 <a class="btn btn btn-danger" href="" role="button">IMPRIMIR</a>

  </ul>
</section>
 
 <!--/////////////////////////////////////////////////////////////AQUI TERMINA NUESTRO 2 MENU LATERAL///////////////////////////////////////-->



<section class="inicio">
  
  <H1>INFORMACION PRINCIPAL</H1>
   
  <hr>
<form >
<H1>  AQUI VA TODO LO DE CLIENTES</H1>
  
</form>
</section>


  </body>
  </html>
 
    