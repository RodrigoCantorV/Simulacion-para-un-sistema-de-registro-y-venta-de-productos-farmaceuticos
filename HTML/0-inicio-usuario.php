
   <?php include "fechas.php";  ?>
   


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
    <meta charset="UTF-8">
    <?php include"scripts.php"; ?>

    <title>
     Pagina principal
    </title>
    
    <script>

$(document).on('ready', function() {
  $('#show-hide-passwd').on('click', function(e) {
    e.preventDefault();

    var current = $(this).attr('action');

    if (current == 'hide') {
      $(this).prev().attr('type','text');
      $(this).removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close').attr('action','show');
    }

    if (current == 'show') {
      $(this).prev().attr('type','password');
      $(this).removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open').attr('action','hide');
    }
  })
})
	</script>

    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
   <link rel="stylesheet" type="text/css" href="../CSS/0-inicio-usuario3.css">
  </head>
  <body>
        <header>
      
               
              <nav class="navegacion">
              <ul class="menu">
               
               <li > <img src="../IMAGENES/medicina.png"></li>

               <li><a  href="#"><h1>Sistema de ventas</h1></a></li>
                <li><a href="#"><h3>Farmacia UDEC V1.0</h3></a></li>

                <li class="fecha"><a href="#">Fusasuga, <?php echo fechaC(); ?></a></li>

               <li class="name"><a href="#"><?php echo $_SESSION['user'].'-'.$_SESSION['rol'].' - '.$_SESSION['nombre'] ; ?></a></li>
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
<!--
<section class="OPCIONES">
   <ul>
<a href="#">NUEVO</a>
<a href="#">MODIFICAR</a>
<a href="#">ELIMINAR</a>
<a href="#">BUSCAR</a>
 <a class="btn btn btn-danger" href="" role="button">IMPRIMIR</a>

  </ul>
</section>
 -->
 <!--/////////////////////////////////////////////////////////////AQUI TERMINA NUESTRO 2 MENU LATERAL///////////////////////////////////////-->



<section class="inicio">
  
  <H1>INFORMACION PRINCIPAL</H1>
   
  <hr>
<form >
  <?php 

  include"../HTML/abrir-conexion.php";
//DATOS DE LA EMPRESA
  $nit ='';
  $nombreEmpresa ='';
  $razonSocial ='';
  $telEmpresa ='';
  $emailEmpresa ='';
  $dirEmpresa ='';
  $iva ='';

  $query_empresa = mysqli_query($conection,"SELECT * FROM configuracion");
  $row_empresa = mysqli_num_rows($query_empresa);
  if ($row_empresa = 1)
   {
    while ($arrInfoEmpresa = mysqli_fetch_assoc($query_empresa)) {
        $nit           ='';$arrInfoEmpresa['nit'];
        $nombreEmpresa ='';$arrInfoEmpresa['nombre'];
        $razonSocial   ='';$arrInfoEmpresa['razon_social'];
        $telEmpresa    ='';$arrInfoEmpresa['telefono'];
        $emailEmpresa  ='';$arrInfoEmpresa['email'];
        $dirEmpresa    ='';$arrInfoEmpresa['direccion'];
        $iva           ='';$arrInfoEmpresa['iva'];
    }
   }



  $query_dash = mysqli_query($conection,"CALL dataDashboard();");
  $result_dash = mysqli_num_rows($query_dash);
  if ($result_dash >0)
   {
  $data_dash = mysqli_fetch_assoc($query_dash);
  mysqli_close($conection);
  }
   ?>
  <div class="divContainer">
    <div>
      <h1 class="titlePanelControl">Panel de control</h1>
    </div>
    <div class="dashboard">
     <?php if ($_SESSION['rol'] ==1 || $_SESSION['rol'] ==2) 
     {
     ?>
      <a href="3-interfaz-lista-de-usuarios.php">
        <i class="fas fa-users"></i>
        <p>
          <strong> Usuarios </strong>
          <span><?= $data_dash['usuarios'] ?></span>
        </p>
      </a>

      <?php 
       }
       ?>


      <a href="8-interfaz-lista-de-clientes.php">
        <i class="fas fa-users"></i>
        <p>
          <strong>Clientes</strong>
          <span><?= $data_dash['clientes'] ?></span>
        </p>
      </a>

    <?php if ($_SESSION['rol'] ==1 || $_SESSION['rol'] ==2) 
     {
     ?>
      <a href="a13-interfaz-lista-de-proveedores.php">
        <i class="fas fa-building"></i>
        <p>
          <strong>Proveedores</strong>
          <span><?= $data_dash['proveedores'] ?></span>
        </p>
      </a>

    <?php 
    }
    ?>
        <a href="a18-interfaz-lista-de-productos.php">
        <i class="fas fa-cubes"></i>
        <p>
          <strong>Productos</strong>
          <span><?= $data_dash['productos'] ?></span>
        </p>
      </a>

        <a href="a23-interfaz-lista-de-ventas.php">
        <i class="far fa-file-alt"></i>
        <p>
          <strong>Ventas</strong>
          <span><?= $data_dash['ventas'] ?></span>
        </p>
      </a>

    </div>
  </div>


  <div class="divInfoSistema">
    <div>
      <h1 class="titlePanelControl">Configuracion</h1>
    </div>
    <div class="containerPerfil">
      <div class="containerDataUser">
        <div class="logoUser">
            <img src="../IMAGENES/logoUser.png">         
        </div>
        <div class="divDataUser">
          <h4>Informacion Personal</h4>

         
           <div>
             <label>Nombre:</label> <span><?= $_SESSION['nombre'];?></span>
           </div>
           <div>
             <label>Correo:</label> <span><?= $_SESSION['email'];?></span>
           </div>
           <h4>Datos del usuario</h4>
           <div>
             <label>Rol:</label> <span><?= $_SESSION['rol_name'];?></span>
           </div>
           <div>
             <label>Usuario:</label> <span><?= $_SESSION['user'];?></span>
           </div>

           <h4>Cambiar Contraseña</h4>
           
           <form action="" method="post" name="frmChangePass" id="frmChangePass" >
            <div>
      
              <input type="password" name="txtPassUser" id="txtPassUser"
              placeholder="Contraseña actual" required>
            </div>
            <div>

              <input class="newPass" type="password" name="txtNewPassUser" id="txtNewPassUser"
              placeholder="Nueva Contraseña" required>
              <button id="show-hide-passwd" action="hide" class="input-group-addon glyphicon glyphicon glyphicon-eye-open"></button>
            </div>
          
            <div>
              <input class="newPass" type="password" name="txtPassConfirm" id="txtPassConfirm"
              placeholder="Confirmar Contraseña" required>
              
            </div>
           
            <div class="alertChangePass" style="display:none;">
            </div>
            <div>
               <button type="submit"  class="btn_save btnChangePass" > <i class="fas fa-key"></i>Cambiar contraseña</button>
              
            </div>
            <div class="alertMedPass" style="display:none;"> </div> 

           </form>

        </div>
      </div>
      <div class="containerDataEmpresa">
          <div class="logoEMP">
            <img src="../IMAGENES/logoEmp.png">         
        </div>
        <h4>Datos de la empresa</h4>


        <form action="" method="post" name="frmEmpresa" id="frmEmpresa">
          <input type="hidden" name="action" value="updateDataEmpresa">
          
          <div>
            <label><?=$nit; ?></label><input type="text" name="txtNit" id="txtNit" placeholder="Nit" value="<?= $nit;  ?>" required> 
          </div>
          <div>
            <label>Nombre:</label> <input type="text" name="txtNombre" id="txtNombre" placeholder="Nombre de la empresa" value="<?=$nombreEmpresa;?>" required>
          </div>
          <div>
            <label>Razon social:</label><input type="text" name="txtRsocial" id="txtRsocial" placeholder="Razon social" value="<?=$razonSocial;?>">
          </div>
          <div>
            <label>Telefono:</label><input type="text" name="txtTelEmpresa" id="txtTelEmpresa" placeholder="Numero de telefono" value="<?= $telEmpresa;?>" required>
          </div>
          <div>
            <label>Correo electronico:</label><input type="email" name="txtEmailEmpresa" id="txtEmailEmpresa" placeholder="Correo electronico" value="<?=$emailEmpresa;?>" required>
          </div>
          <div>
            <label>Direccion:</label><input type="text" name="txtDirEmpresa" id="txtDirEmpresa" placeholder="Direccion de la empresa" value="<?=$dirEmpresa;?>" required>
          </div>
          <div>
            <label>IVA (%):</label><input type="text" name="txtIva" id="txtIva" placeholder="Impuesto al valor agregado (IVA)" value="<?=$iva;?>" required>
          </div>
           <div class="alertFormEmpresa" style="display:none;"></div>
           <div>
             <button type="submit" class="btn_save btn_ChangePass"><i class="far fa-save fa-lg"></i>Guardar datos</button>
           </div>
          
        </form>




      </div>
    </div>


  </div>

</form>
</section>

  </body>
  </html>
 
    