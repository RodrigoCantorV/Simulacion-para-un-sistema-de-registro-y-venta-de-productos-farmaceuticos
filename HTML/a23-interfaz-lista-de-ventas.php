
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
  <?php include"scripts.php"; ?>
  <title>
  BUSQUEDA DE CLIENTES
  </title>

<link rel="stylesheet" type="text/css" href="../CSS/a23-interfaz-lista-de-ventas.css">
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
<div class="modal">
  <div class="bodyModal">
  

  </div>

</div>




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
<a href="a22-interfaz-registro-de-ventas.php">NUEVO</a>
<a href="">MODIFICAR</a>
<a href="">ELIMINAR</a>
<a href="a23-interfaz-lista-de-ventas.php">BUSCAR</a>
<a class="btn btn btn-danger" href="cerrar_sesion.php" role="button">IMPRIMIR</a>

  </ul>
</section>
 
 <!--/////////////////////////////////////////////////////////////AQUI TERMINA NUESTRO 2 MENU LATERAL///////////////////////////////////////-->

<section class="container">
  
<h1><i class="far fa-newspaper"></i>lista de ventas</h1>
<a href="a22-interfaz-registro-de-ventas.php"class="btn_new"><i class="fas fa-plus"></i>NUEVA VENTA</a>
     

      <form action="a24-interfaz-busqueda-de-ventas.php"method="get"class="form_search">
        <input type="text" name="busqueda" id="busqueda" placeholder="N°. Factura">
        <button type="submit"value="Buscar"class="btn_search"><i class="fas fa-search"></i></button>
      </form>
  <hr>
  <div>
    <h5>Buscar por fecha</h5>
    <form action="a24-interfaz-busqueda-de-ventas.php" method="get" class="form_search_date">
      <label>De:</label>
      <input type="date" name="decha_de" id="fecha_de" required>
      <label>A</label>
      <input type="date" name="fecha_a" id="fecha_a" required>
      <button type="submit" class="btn_view"><i class="fas fa-search"></i></button>
      
    </form>
  </div>
    <div class="tabla">
      
   <table >
      
      <tr>
        
        <th>N°.</th>
        <th>Fecha / Hora</th>
        <th>Cliente</th>
        <th>Vendedor</th>
        <th>Estado</th>
        <th class="textright">Total Factura</th>
        <th class="textright">Acciones</th> 
       
      </tr>
      <?php 
      //PAGINADOR


         $sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM factura WHERE estado !=10");
        $result_register = mysqli_fetch_array($sql_registe);
        $total_registro = $result_register['total_registro'];

        $por_pagina = 5;
        if (empty($_GET['pagina']))
         {
         $pagina=1;  
         } else
         {
          $pagina =$_GET['pagina'];
         }

         $desde =($pagina-1)*$por_pagina;
         $total_paginas =  ceil($total_registro/$por_pagina);





      $query= mysqli_query($conection, "SELECT f.nofactura,
                                               f.fecha,
                                               f.totalfactura,
                                               f.codcliente,
                                               f.estado,
                                               u.nombre as vendedor,
                                               cl.nombre as cliente
                                               FROM factura f
                                               INNER JOIN usuario u 
                                               ON f.usuario = u.idusuario
                                               INNER JOIN cliente cl
                                               ON f.codcliente = cl.idcliente
                                               WHERE f.estado != 10
                                               ORDER BY f.fecha DESC LIMIT $desde,$por_pagina");

      
      mysqli_close($conection);

       $result = mysqli_num_rows($query);

      if ($result > 0) {

        while ($data = mysqli_fetch_array($query)) {

          if ($data["estado"] == 1 ) {
            $estado = '<span class="pagada">Pagada</span>';
          }else{
            $estado = '<span class="anulada">Anulada</span>';
          }
      
       ?>
       <tr id="row_<?php echo $data["nofactura"];?>">
        <td><?php echo $data["nofactura"]; ?></td>
        <td><?php echo $data["fecha"]; ?></td>
        <td><?php echo $data["cliente"]; ?></td>
        <td><?php echo $data["vendedor"]; ?></td>
        <td class="estado"><?php echo $estado; ?></td>
        <td class="textright totalfactura"><span>$.</span><?php echo $data["totalfactura"]; ?></td>
        <td>
       <div class="div_acciones">
        <div>
          <button class="btn_view view_factura" type="button" cl="<?php echo $data["codcliente"]; ?>" f="<?php echo $data["nofactura"];?>"><i class="fas fa-eye"></i></button>
        </div>         
       
       <?php  if ($_SESSION['rol'] ==1 || $_SESSION['rol']==2) {
         if ($data["estado"]==1) 
         {
          ?>
       <div class="div_factura">
         <button class="btn_anular anular_factura" fac="<?php echo $data["nofactura"]; ?>"> <i class="fas fa-ban"></i></button>



       </div> 
     <?php }else{ ?>
       <div class="div_factura">
        <button type="button" class="btn_anular inactive"><i class="fas fa-ban"></i></button>
       </div> 
     <?php } 
   }
   ?>
       </div> 
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


