<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		
		<link rel="icon" type="image/x-icon" href="../assets/logo-vt.svg" />
		<title>Login </title>
		<link
		href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
		rel="stylesheet"
		integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
		crossorigin="anonymous"
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<meta charset="UTF-8">
		<style>
        .page_wrapper {
            height: 100vh;
        }

        .content {
            height: 100%;
        }

        .custom-form {
            width: 25rem;
        }

        .login-icon {
            height: 6rem;
        }

        .custom-btn {
            background-color: red;
            border-color: red;
        }

        .custom-btn:hover {
            background-color: darkred;
            border-color: darkred;
        }

        .return-btn {
            background-color: red;
            border-color: red;
        }

        .return-btn:hover {
            background-color: darkred;
            border-color: darkred;
        }
    </style>
    <title>Login Authenticator</title>
		
	</head>

	<body>

	<?php
		
		require_once("../constantes.php");

		$cn = conectar();
		
		// Obtener los nombres de usuario de la base de datos que tengan rol 1
		$query = "SELECT Nombre FROM usuarios WHERE Rol IN (1)";
		$resultado = $cn->query($query);
		
		// Generar las opciones del select con los nombres de usuario que tengan rol 1
		$options = '';
		while ($row = $resultado->fetch_assoc()) {
			$nombre = $row['Nombre'];
			$options .= "<option value='$nombre'>$nombre</option>";
		}
		
		$html = '
	
<form action="validar.php" method="POST" class="page_wrapper">
<div class="content d-flex justify-content-center align-items-center">
	<div class="bg-white p-5 rounded-5 text-secondary shadow custom-form">
		<div class="d-flex justify-content-center">
			<!-- Eliminé la imagen -->
		</div>
		<div class="text-center fs-1 fw-bold">Login Authenticator</div>
		<div class="input-group mt-4">
			<div class="input-group-prepend">
				<div class="input-group-text bg-info">
					<!-- Eliminé la imagen -->
				</div>
			</div>
			<select class="form-control" name="usuario" required>
				<option value="" disabled selected>Selecciona un usuario</option>
				' . $options . '
			</select>
		</div>
		<div class="input-group mt-1">
			<div class="input-group-prepend">
				<div class="input-group-text bg-info">
					<!-- Eliminé la imagen -->
				</div>
			</div>
			<input type="password" class="form-control" name="clave" placeholder="Ejemplo: 123" required>
		</div>
		<div class="d-flex justify-content-around mt-1">
			<!-- Eliminé la sección de Remember me -->
		</div>
		<button type="submit" class="btn custom-btn text-white btn-block mt-4 fw-semibold shadow-sm" name="login">Login</button>
		<a href="../index.html" class="btn return-btn text-white btn-block mt-4 fw-semibold shadow-sm">Regresar</a>
	</div>
</div>
</form>
		
		';
		echo $html;
		session_start();
	
		function conectar(){

			$c = new mysqli(SERVER,USER,PASS,BD);
			
			if($c->connect_errno) {
				die("Error de conexión: " . $c->mysqli_connect_errno() . ", " . $c->connect_error());
			}else{
			}
			
			$c->set_charset("utf8");
			return $c;
		}

	?>

		
	  
    </div>
		<div class="footer">
			
			<div class=" table">
			</div>
		</div>
		<script>
		//Hack to fix hover on element with inline color set on child element for facebook and email buttons
		var fb_button = document.getElementById("facebook_button_initial");
		var fb_text = document.getElementById("fbchkintxt");
		var email_button = document.getElementById("email_button_initial");
		var email_text = document.getElementById("emchkintxt");
		
		if(fb_button){
			fb_button.onmouseover = function(){
				fb_text.style.color = "#fff";
				
			};
			fb_button.onmouseout = function(){
				fb_text.style.color = "#000)";
				
			};
		}
		
		if(email_button){
			email_button.onmouseover = function(){
				email_text.style.color = "#000)";
				
			};
			email_button.onmouseout = function(){
				email_text.style.color = "#fff";
				
			};
		}
		</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	</body>
</html>