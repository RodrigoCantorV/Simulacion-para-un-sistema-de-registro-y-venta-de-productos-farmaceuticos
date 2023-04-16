<?php	
$host = 'localhost';
//$user = 'UDEC';
//$password ='123456';
$user = 'root';
$password ='';
$db = 'linea-p3';

$conection = @mysqli_connect($host,$user,$password,$db);
//mysql_close($conection);
if(!$conection){
	echo "Error de conexion";
}else{
	echo "";
}

?>