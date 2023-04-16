
   <?php include"fechas.php";  ?>



   <?php
session_start();
include "../HTML/abrir-conexion.php";
if(empty($_SESSION['active']))
{
header('location:../HTML/login.php');
}
  ?>


  <!DOCTYPE html>
  <html>
  <head>
      <?php include"scripts.php"; ?>
    <title>
    Sesion de usuario
    </title>
    <link rel="stylesheet" type="text/css" href="../CSS/a22-interfaz-registro-de-ventas21.css">
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
<a href="a22-interfaz-registro-de-ventas.php">NUEVO</a>
<a href="">MODIFICAR</a>
<a href="">ELIMINAR</a>
<a href="a23-interfaz-lista-de-ventas.php">BUSCAR</a>
 <a class="btn btn btn-danger" href="" role="button">IMPRIMIR</a>

  </ul>
</section>
 
 <!--/////////////////////////////////////////////////////////////AQUI TERMINA NUESTRO 2 MENU LATERAL///////////////////////////////////////-->



<section class="inicio">
  
 <!-- <H1>INFORMACION PRINCIPAL</H1> -->
   
  <hr>

<div class="title_page">
 <!-- <h1><i class="fas fa-cube"></i>Nueva venta</h1> -->
</div>
<div class="datos_cliente">
  <div class="action_cliente">
    <h4>Datos del cliente</h4>
    <a href="#" class="btn_new btn_new_cliente"><i class="fas fa-plus"></i>Nuevo cliente</a>
  </div>

  <form name="form_new_cliente_venta" id="form_new_cliente_venta" class="datos">
  <input type="hidden" name="action" value="addCliente">
  <input type="hidden" name="idcliente" id="idcliente" value="" required>
  <div class="wd30">
    <label>Docum.</label>
    <input type="text" name="nit_cliente" id="nit_cliente">
  </div>
  <div class="wd30">
    <label>Nombre</label>
    <input type="text" name="nom_cliente" id="nom_cliente" disabled required>
  </div>

   <div class="wd30">
    <label>Apellido</label>
    <input type="text" name="ape_cliente" id="ape_cliente" disabled required>
  </div>

   <div class="wd30">
    <label>tip_docu</label>
    <input type="text" name="tip_cliente" id="tip_cliente" disabled required>
  </div>

   <div class="wd30">
    <label>Genero</label>
    <input type="text" name="gen_cliente" id="gen_cliente" disabled required>
  </div>

   <div class="wd30">
    <label>correo</label>
    <input type="text" name="cor_cliente" id="cor_cliente" disabled required>
  </div>

  <div class="wd30">
    <label>Telefono</label>
    <input type="number" name="tel_cliente" id="tel_cliente" disabled required>
  </div>
  <div class="wd100">
    <label>Direccion</label>
    <input type="text" name="dir_cliente" id="dir_cliente" disabled required>
  </div>
  <div id="div_registro_cliente" class="wd100">
    <button type="submit" class="btn_save"><i class="far fa-save fa-lg"></i>Guardar</button>
    
  </div>

  </form>

</div>

<div class="datos_venta">
  <h4>Datos de venta</h4>
  <div class="datos_2">
    <div class="wd50">
      <label>Vendedor</label>
      <p><?php echo $_SESSION['nombre']; ?></p>
    </div>
    <div class="wd50">
      <label>Acciones</label>
      <div id="acciones_venta">
        <a href="#" class="btn_ok textcenter" id="btn_anular_venta"><i class="fas fa-ban"></i>Anular</a>
        <a href="#" class="btn_new textcenter" id="btn_facturar_venta" style="display: none;"><i class="far fa-edit"></i>Procesar</a>
      </div>
    </div>
  </div>
</div>

<table class="tbl_venta">
  <thead>
    <tr>
      <th width="100px">Codigo</th>
      <th>Descripcion</th>
      <th>Existencias</th>
      <th width="100px">Cantidad</th>
      <th class="textright">Precio</th>
      <th class="textright">Precio total</th>
      <th>Accion</th>
    </tr>
    <tr>
      <td><input type="text" name="txt_cod_producto" id="txt_cod_producto"></td>
      <td id="txt_descripcion">-</td>
      <td id="txt_existencia">-</td>
      <td><input type="text" name="txt_cant_producto" id="txt_cant_producto" value="0" min="1" disabled></td>
      <td id="txt_precio" class="textright">0.00</td>
      <td id="txt_precio_total" class="textright">0.00</td>
      <td><a href="#" id="add_product_venta" class="link_add"><i class="fas fa-plus"></i>Agregar</a></td>
    </tr>
    <tr>
      <th>Codigo</th>
      <th colspan="2">Descripcion</th>
      <th>Cantidad</th>
      <th class="textright">Precio</th>
      <th class="textright">Precio Total</th>
      <th>Accion</th>
    </tr>
  </thead>
  <tbody id="detalle_venta">
   <!--CONTENIDO AJAX-->
  </tbody>
  <tfoot id="detalle_totales">
    <!--CONTENIDO AJAX-->
  </tfoot>
</table>
  
</section>

<script type="text/javascript">
  $(document).ready(function(){
 var usuarioid = '<?php echo $_SESSION['idUser']; ?>';
 serchForDetalle(usuarioid);
  });
</script>

  </body>
  </html>
 
    