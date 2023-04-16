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

include"../HTML/abrir-conexion.php";
 
  ?>

 


<!DOCTYPE html>
<html>
<head>
  <title>
  BUSQUEDA DE CLIENTES
  </title>

<link rel="stylesheet" type="text/css" href="../CSS/8-interfaz-lista-de-clientes.css">
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
<?php 
}
 ?>
}
<a href="8-interfaz-lista-de-clientes.php">BUSCAR</a>
 <a class="btn btn btn-danger" href="cerrar_sesion.php" role="button">IMPRIMIR</a>

  </ul>
</section>
 
 <!--/////////////////////////////////////////////////////////////AQUI TERMINA NUESTRO 2 MENU LATERAL///////////////////////////////////////-->

<section class="container">
  
<h1>lista de clientes</h1>
<a href="7-interfaz-registro-de-clientes.php"class="btn_new">GUARDAR CLIENTE</a>
     

      <form action="8-interfaz-busqueda-de-clientes.php"method="get"class="form_search">
        <input type="text" name="busqueda" id="busqueda" placeholder="BUSCAR">
        <input type="submit"value="Buscar"class="btn_search">
      </form>
  <hr>
    <div class="tabla">
      
   <table >
      
      <tr>
        
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Documento</th>
        <th>Numero de documento</th>
        <th>Genero</th>
        <th>Telefono</th>
        <th>Correo</th>
        <th>Direccion</th>
        <th>ACCIONES</th>
      </tr>
      <?php 
      //PAGINADOR


         $sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM cliente WHERE estado=1");
        $result_register = mysqli_fetch_array($sql_registe);
        $total_registro = $result_register['total_registro'];

        $por_pagina = 4;
        if (empty($_GET['pagina']))
         {
         $pagina=1;  
         } else
         {
          $pagina =$_GET['pagina'];
         }

         $desde =($pagina-1)*$por_pagina;
         $total_paginas =  ceil($total_registro/$por_pagina);





      $query= mysqli_query($conection, "SELECT * FROM cliente 
                                         WHERE estado=1 ORDER BY idcliente ASC LIMIT $desde,$por_pagina");

      
      mysqli_close($conection);

       $result = mysqli_num_rows($query);

      if ($result > 0) {
        while ($data = mysqli_fetch_array($query)) {
        if ($data["nit"]==0)
         {
          $nit='C/F';
          # code...
        }else
        {
          $nit = $data["nit"];
        }

       ?>
       <tr>
        <td><?php echo $data["idcliente"]; ?></td>
        <td><?php echo $data["nombre"]; ?></td>
        <td><?php echo $data["apellido"]; ?></td>
        <td><?php echo $data["documento"]; ?></td>
        <td><?php echo $nit; ?></td>
        <td><?php echo $data["genero"]; ?></td>
        <td><?php echo $data["telefono"]; ?></td>
        <td><?php echo $data["correo"]; ?></td>
        <td><?php echo $data["direccion"]; ?></td>
      
<td>
        <a class="link_edit" href="9-interfaz-modificar-clientes.php?id=<?php echo $data["idcliente"] ?>">EDITAR</a>
        |
         
         <?php 
          if ($_SESSION['rol']==1 || $_SESSION['rol']==2 ) {
          ?>
            <a class="link_delete" href="a10-interfaz-eliminar-clientes.php?id=<?php echo $data["idcliente"] ?>">ELIMINAR</a>
            <?php 
          }
             ?>
       
        </td>
      </tr>
<?php 
              }
        }
  ?>

    </table>

    <div class="paginador">
    <ul>
    
    <?php 
if ($pagina!=1) {
  # code...

     ?>
        <li><a href="?pagina=<?php echo 1;  ?>">|<</a></li>
        <li><a href="?pagina=<?php echo $pagina -1; ?>">|<<</a></li>

        <?php
        } 
          for ($i=1; $i <= $total_paginas; $i++)
           {

            if ($i == $pagina)
             {
                echo '<li class="pageselected">'.$i.'</li>'; 
              # code...
            }else
            {
              echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>'; 
            }

           

            # code...
          }

          if ($pagina != $total_paginas)
           {

         ?>
         <li><a href="?pagina=<?php echo $pagina +1; ?>">>></a></li>
         <li><a href="?pagina=<?php echo $total_paginas; ?>">>|</a></li>
      <?php 
        }
       ?>
    </ul>

  </div>
</div>
</section>





</body>
</html>


