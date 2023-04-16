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
     Pagina principal
    </title>
   <link rel="stylesheet" type="text/css" href="../CSS/0-inicio-usuario.css">
  </head>
  <body>
        <header>
      
               
              <nav class="navegacion">
              <ul class="menu">
               
               <li > <img src="../IMAGENES/medicina.png"></li>

               <li><a  href="#"><h1>Sistema de ventas</h1></a></li>
                <li><a href="#"><h3>Farmacia UDEC V1.0</h3></a></li>

                <li class="fecha"><a href="#">Fusasuga, <?php echo fechaC(); ?></a></li>

               <li class="name"><a href="#"><?php echo $_SESSION['user'] ?></a></li>
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
                <td><a href="1-interfaz-usuario.php"><img src="../IMAGENES/adduser.png" width="80px"></a></td>
                <td><a href=""><img src="../IMAGENES/midicina.png" width="80px"></a></td>
                <td><a href=""><img src="../IMAGENES/cliente.png" width="80px"></a></td>
                <td><a href=""><img src="../IMAGENES/proveedor.png" width="80px"></a></td>
                <td><a href=""><img src="../IMAGENES/venta.png" width="80px"></a></td>
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
<a href="#">NUEVO</a>
<a href="#">MODIFICAR</a>
<a href="#">ELIMINAR</a>
<a href="#">BUSCAR</a>
 <a class="btn btn btn-danger" href="" role="button">IMPRIMIR</a>

  </ul>
</section>
 
 <!--/////////////////////////////////////////////////////////////AQUI TERMINA NUESTRO 2 MENU LATERAL///////////////////////////////////////-->



<section class="inicio">
  
  <H1>INFORMACION PRINCIPAL</H1>
   
  <hr>
<form >
  <H1>  AQUI VA TODO LO DE LA EMPRESA</H1>
</form>
</section>


  </body>
  </html>
 
    









    @import "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css";


/*AQUI EMPIEZA NUESTRO ENCABEZADO PRINCIPAL*/
*{
margin: 0;
padding: 0;

}

body{
  margin: 0;
  padding: 0;
  font-family: sans-serif;
  background:url(../IMAGENES/fondo14.jpg) no-repeat;
  background-size: cover;

}

.navegacion{
  width: 100%;
  height: 35px;
  margin:0px auto;
  background: blue;
  clear: both;


}

.navegacion img{
  padding: 10px;
  position: relative;
  top: -5px;
  width: 40px;
  height: 34px;




}

.navegacion ul{
  list-style: none;
  position: relative;
  top: -5px;
  position: absolute;

}

.menu > li{
  display: inline-block;

  
}

.menu > li a{

  position: relative;
  top: -25px;
  text-decoration: none;
  color: white;
  left: 10px;
  
}

.menu > li a h3{
  
  font-size: 13px;
  color: white;
}

.menu > li a i{
  
position: relative;
left: 600px;
padding: 0px 25px;
}

.name{
position: relative;
left: 600px;

}

.fecha{
  position: relative;
  left: 500px;

}

/*AQUI TERMINA NUESTRO ENCABEZADO PRINCIPAL*/


/*AQUI EMPIEZA NUESTRO 2 ENCABEZADO PRINCIPAL*/

.servis form{
  position: relative;
  background: #F2F2F2;
  width: 100%;
  height: 110px;
    border-radius: 10px;
  
}


.menu2{
  width: 100%;
  text-align: center;
}

.menu2 img{
background: white;
padding: 0px 15px;
}

.menu2 img:hover{
  color: 355784;
  background: #2196f3;
  box-shadow: 0 0 10px #2196f3, 0 0 40px #2196f3, 0 0 80px #2196f3;
}
/*AQUI TERMINA NUESTRO 2 ENCABEZADO PRINCIPAL*/




.OPCIONES{
  width: 15.2%;
  height:600px;
  position: relative;
  background: rgba(0,0,0,.2);
    float: left;
}

.OPCIONES ul{
  padding-top: 40px;
  margin-left: -20px;
  margin-right: 20px;
}

.OPCIONES ul a{
  text-decoration: none;
  color: #f2f2f2;
  font: 15px verdana;
  display: block;
  background: blue;
  margin-bottom: 20px;
  padding: 10px 20px 10px 45px;
  border-radius: 15px;
  transition:background .6s, margin-left .6s, margin-right.6s;
  -webkit-transition:background .6s, margin-left .6s, margin-right.6s;
  -moz-transition:background .6s, margin-left .6s, margin-right.6s;
  -o-transition:background .6s, margin-left .6s, margin-right.6s;
}
.OPCIONES ul a:hover{
  margin-right: -40px;
  margin-left: 25px;
  background: red;

}


/*AQUI LE DAMOS FORMATO A NUESTRO MENU DE INSERTAR USUARIOS*/
.inicio{
  
  width: 1000px;
  margin: auto;
  position: relative;
  left: 70px;
  

}
.inicio > h1{
  
  color: #3c93b0;
}
hr{
  display: block;
  background: #ccc;
  height: 5px;
  margin: 5px 0px;
}

