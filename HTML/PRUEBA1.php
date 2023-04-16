if (!empty($_POST['passActual']) && !empty($_POST['passNuevo']))
	 			 {
	 			$password = md5($_POST['passActual']);
	 			$newPass  = md5($_POST['passNuevo']);
	 			$idUser   =$_SESSION['idUser'];
	 			$code = '';
	 			$msg  = '';
	 			$arrData = array();

	 			$query_user = mysqli_query($conection,"SELECT * FROM usuario
	 												 WHERE clave = '$password' and idusuario = $idUser ");

	 			  	$result = mysqli_num_rows($query_user);
	 			  	if ($result > 0) 
	 			  		{
	 			  		$query_update = mysqli_query($conection,"SELECT * FROM usuario 
	 			  									 SET clave = '$newpass'
	 												 WHERE idusuario = $idUser ");
	 			  		mysqli_close($conection);
	 			  	
	 			  		if ($query_update)
	 			  		 {
	 			  		$code = '00';
	 			  		$msg = "Su contraseña ha sido actalizada con exito";
	 			  		}else{
	 			  			$code ="2";
	 			  			$msg = "no ha sifo posible cambiar su contraseña"; 
	 			  		}

			 			}else{
							 $code='1';
							 $msg ="La contrasela actual es incorrecta.";
						 }
						 $arrData=array('cod' => $code, 'msg' => $msg);
						 echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			 			}else{
							echo "error";
						}	