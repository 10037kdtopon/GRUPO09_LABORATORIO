<?php
class recetas{
	private $IdReceta;
    private $IdConsulta;
    private $IdMedicamento;
    private $Cantidad;
    private $con;

    function __construct($cn)
    {
        $this->con = $cn;
    }



		
		
//******** 3.1 METODO update_consulta() *****************


public function update_recetas()
    {
        $this-> IdReceta = $_POST['id'];
		$this->IdConsulta= $_POST['consulta'];
		$this->IdMedicamento = $_POST['medicamento'];
		$this->Cantidad = $_POST['cantidad'];
		
		
		
		
		//exit;
		$sql = "UPDATE recetas SET IdConsulta=$this->IdConsulta,
									IdMedicamento=$this->IdMedicamento,
									Cantidad='$this->Cantidad'
									
									

				WHERE IdReceta=$this->IdReceta;";


        echo $sql;
        //exit;
        if ($this->con->query($sql)) {
            echo $this->_message_ok("modificó");
        } else {
            echo $this->_message_error("al modificar");
        }

    }

	

//******** 3.2 METODO save_consulta() *****************	

public function save_recetas()
{
	$this->IdConsulta = $_POST['IdConsulta'];
        $this->IdMedicamento = $_POST['IdMedicamento'];
        $this->Cantidad = $_POST['Cantidad'];
        
        $sql = "INSERT INTO recetas (IdConsulta, IdMedicamento, Cantidad) 
        VALUES ('$this->IdConsulta', '$this->IdMedicamento', '$this->Cantidad');";

        //echo $sql;
        //exit;
        if ($this->con->query($sql)) {
            echo $this->_message_ok("guardó");
        } else {
            echo $this->_message_error("guardar");
        }

}



//******** 3.3 METODO _get_name_File() *****************	
	
	private function _get_name_file($nombre_original, $tamanio){
		$tmp = explode(".",$nombre_original); //Divido el nombre por el punto y guardo en un arreglo
		$numElm = count($tmp); //cuento el número de elemetos del arreglo
		$ext = $tmp[$numElm-1]; //Extraer la última posición del arreglo.
		$cadena = "";
			for($i=1;$i<=$tamanio;$i++){
				$c = rand(65,122);
				if(($c >= 91) && ($c <=96)){
					$c = NULL;
					 $i--;
				 }else{
					$cadena .= chr($c);
				}
			}
		return $cadena . "." . $ext;
	}
	
	
//************* PARTE I ********************
	
	    
	 //Aquí se agregó el parámetro:  $defecto/
	private function _get_combo_db($tabla,$valor,$etiqueta,$nombre,$defecto){
		$html = '<select name="' . $nombre . '">';
		$sql = "SELECT $valor,$etiqueta FROM $tabla;";
		$res = $this->con->query($sql);
		while($row = $res->fetch_assoc()){
			//ImpResultQuery($row);
			$html .= ($defecto == $row[$valor])?'<option value="' . $row[$valor] . '" selected>' . $row[$etiqueta] . '</option>' . "\n" : '<option value="' . $row[$valor] . '">' . $row[$etiqueta] . '</option>' . "\n";
		}
		$html .= '</select>';
		return $html;
	}
	
	/*Aquí se agregó el parámetro:  $defecto
	private function _get_combo_anio($nombre,$anio_inicial,$defecto){
		$html = '<select name="' . $nombre . '">';
		$anio_actual = date('Y');
		for($i=$anio_inicial;$i<=$anio_actual;$i++){
			$html .= ($i == $defecto)? '<option value="' . $i . '" selected>' . $i . '</option>' . "\n":'<option value="' . $i . '">' . $i . '</option>' . "\n";
		}
		$html .= '</select>';
		return $html;
	}*/
	
	//Aquí se agregó el parámetro:  $defecto
    
	private function _get_radio($arreglo,$nombre,$defecto){
		
		$html = '
		<table border=0 align="left">';
		
		//CODIGO NECESARIO EN CASO QUE EL USUARIO NO SE ESCOJA UNA OPCION
		
		foreach($arreglo as $etiqueta){
			$html .= '
			<tr>
				<td>' . $etiqueta . '</td>
				<td>';
				
				if($defecto == NULL){
					// OPCION PARA GRABAR UN NUEVO consulta (id=0)
					$html .= '<input type="radio" value="' . $etiqueta . '" name="' . $nombre . '" checked/></td>';
				
				}else{
					// OPCION PARA MODIFICAR UN consulta EXISTENTE
					$html .= ($defecto == $etiqueta)? '<input type="radio" value="' . $etiqueta . '" name="' . $nombre . '" checked/></td>' : '<input type="radio" value="' . $etiqueta . '" name="' . $nombre . '"/></td>';
				}
			
			$html .= '</tr>';
		}
		$html .= '
		</table>';
		return $html;
	}
	
	
//************* PARTE II ******************	

	public function get_form($IdReceta = NULL){
		
        if ($IdReceta == NULL) {
        
			$this->IdConsulta = NULL;
			$this->IdMedicamento = NULL;
			$this->Cantidad = NULL;
	
			$flag = "enabled";
			$op = "new";
	
		} else {
	
			$sql = "SELECT * FROM recetas WHERE IdReceta=$IdReceta;";
			$res = $this->con->query($sql);
			$row = $res->fetch_assoc();
	
			$num = $res->num_rows;
			if ($num == 0) {
				$mensaje = "tratar de actualizar la consulta con IdReceta= " . $IdReceta;
				echo $this->_message_error($mensaje);
			} else {
	
				$this->Cantidad = $row['Cantidad'];
	
				$flag = "enabled";
				$op = "update";
			}
		}
		
		
		$html = '
		<form name="recetas" method="POST" action="recetas.php" enctype="multipart/form-data" >
		
		<input type="hidden" name="$IdReceta" value="' . $IdReceta  . '"> 
		<input type="hidden" name="op" value="' . $op  . '">
		<div class="container mt-3"> 
    	<div class="table-responsive">
		
		<div  class="table table-hover" align="center">
		<table border="2" align="center" class=" table-secondary" >
		<tr align="center">
						<th colspan="2"><button class="btn btn-outline-success"><a href="recetas.php">Regresar</a></button></th>
					</tr>	
				<tr>
					<th colspan="2" class="text-center align-middle  table-info">DATOS DE LAS RECETAS</th>
				</tr>

				<tr>
                            <td>Consulta Id:</td>
                            <td>' . $this->_get_combo_db("consultas", "IdConsulta", "IdConsulta", "IdConsulta", $this->IdConsulta) . '</td>
                        </tr>
                        <tr>
                        <td>Medicamentos:</td>
                        <td>' . $this->_get_combo_db("medicamentos", "IdMedicamento", "Nombre", "IdMedicamento", $this->IdMedicamento) . '</td>
                    </tr>
                    <tr>
                    <td>Cantidad:</td>
                    <td><input type="text" size="12" name="Cantidad" value="' . $this->Cantidad . '" required></td>
                </tr>
				<tr>
						 <th colspan="2" class="text-center">
							 <input type="submit" class="btn btn-primary" name="Guardar" value="GUARDAR">
						 </th>
					 </tr>												
			</table>
			</div>
			</div>
			</div>
			</form>';
		return $html;
	}
	
	

	public function get_list(){
		$d_new = "new/0";
		$d_new_final = base64_encode($d_new);
		$html = '
		<div class="container mt-10"> 
  <div class="table-responsive">
    <table class="table table-hover table-bordered text-center align-middle">
      <tr>
        <th colspan="8" class="text-center align-middle custom-table-title">LISTA DE LAS RECETAS</th>
      </tr>
			<tr>
			<th colspan="8" class="text-center align-middle" ><a class="btn btn-outline-success" href="recetas.php?d=' . $d_new_final . '">Nuevo</a></th>
			</tr>
			<tr>   
				<th class="text-center">Id Receta</th>
				<th class="text-center">IdConsulta</th>
				<th class="text-center">IdMedicamento</th>
				<th class="text-center">Cantidad</th>
				<th class="text-center">Nombre del Paciente</th>
				<th colspan="3">Acciones</th>
			</tr>
			</div>
			</div>';
			$sql = "SELECT r.IdReceta, r.IdConsulta, r.IdMedicamento, c.FechaConsulta, c.Diagnostico, 
            m.Nombre AS NombreMedicamento, m.Tipo AS TipoMedicamento, p.Nombre AS NombrePaciente, r.Cantidad
            FROM recetas r
            JOIN consultas c ON r.IdConsulta = c.IdConsulta
            JOIN medicamentos m ON r.IdMedicamento = m.IdMedicamento
            JOIN pacientes p ON c.IdPaciente = p.IdPaciente";
			$res = $this->con->query($sql);
		// Sin codificar <td><a href="index.php?op=del&id=' . $row['id'] . '">Borrar</a></td>
		while($row = $res->fetch_assoc()){
			$d_del = "del/" . $row['IdReceta'];
			$d_del_final = base64_encode($d_del);
			$d_act = "act/" . $row['IdReceta'];
			$d_act_final = base64_encode($d_act);
			$d_det = "det/" . $row['IdReceta'];
			$d_det_final = base64_encode($d_det);					
			$html .= '
				<tr>
					<td class="text-center">' . $row['IdReceta'] . '</td>
            		<td class="text-center">' . $row['IdConsulta'] . '</td>
           	    	<td class="text-center">' . $row['NombreMedicamento'] . '</td>
           	    	<td class="text-center">' . $row['Cantidad'] . '</td>
           	    	<td class="text-center">' . $row['NombrePaciente'] . '</td>
					<td><button class="btn btn-outline-danger"><a href="recetas.php?d=' . $d_del_final . '">Borrar</a></button></td>
					<td><button class="btn btn-outline-primary"><a href="recetas.php?d=' . $d_act_final . '">Actualizar</a></button></td>
					<td><button class="btn btn-outline-dark"><a href="recetas.php?d=' . $d_det_final . '">Detalle</a></button></td>
				</tr>';
		}
		$html .= '  
		</table>';
		
		return $html;
		
	}
	
	
	public function get_detail_recetas($IdReceta){
		$sql = "SELECT r.IdReceta, r.IdConsulta, r.IdMedicamento, c.FechaConsulta, c.Diagnostico, 
            m.Nombre AS NombreMedicamento, r.Cantidad
            FROM recetas r
            JOIN consultas c ON r.IdConsulta = c.IdConsulta
            JOIN medicamentos m ON r.IdMedicamento = m.IdMedicamento
            WHERE r.IdReceta = $IdReceta";

		$res = $this->con->query($sql);
		$row = $res->fetch_assoc();
		
		$num = $res->num_rows;


        //Si es que no existiese ningun registro debe desplegar un mensaje 
        //$mensaje = "tratar de eliminar el consulta con id= ".$id;
        //echo $this->_message_error($mensaje);
        //y no debe desplegarse la tablas
        
        if($num==0){
            $mensaje = "tratar de editar el consulta con IdReceta= ".$IdReceta;
            echo $this->_message_error($mensaje);
        }else{ 
				$html = '
				<div class="container mt-5"> 
    			<div class="table-responsive" align="center">
				<div class="table table-hover" >
				<table  border="2" align="center" class=" table-secondary" >
                <tr>
						<th colspan="2"  class="text-center table-info">DATOS DE LA RECETA</th>
					</tr>
					<tr>
                        <td>Id Receta: </td>
                        <td>' . $row['IdReceta'] . '</td>
                    </tr>
                    <tr>
                        <td>Nombre del Medicamento: </td>
                        <td>' . $row['NombreMedicamento'] . '</td>
                    </tr>
                    <tr>
                        <td>Cantidad: </td>
                        <td>' . $row['Cantidad'] . '</td>
                    </tr>
                    <tr>
                        <td>Fecha de Consulta: </td>
                        <td>' . $row['FechaConsulta'] . '</td>
                    </tr>
                    <tr>
                        <td>Diagnóstico: </td>
                        <td>' . $row['Diagnostico'] . '</td>
                    </tr>
					<tr align="center">
						<th colspan="2"><button class="btn btn-outline-success"><a href="recetas.php">Regresar</a></button></th>
					</tr>																						
				</table>
				</div>
				</div>
		</div>';
				
				return $html;
		}
	}
	
	
	public function delete_recetas($IdReceta){
		$sql = "DELETE FROM recetas WHERE IdReceta=$IdReceta;";
			if($this->con->query($sql)){
			echo $this->_message_ok("ELIMINÓ");
		}else{
			echo $this->_message_error("eliminar");
		}	
	}
	

	
//*************************	
	
	private function _message_error($tipo){
		$html = '
		<table border="0" align="center">
			<tr>
				<th>Error al ' . $tipo . '. Favor contactar a .................... </th>
			</tr>
			<tr>
				<th><a href="recetas.php">Regresar</a></th>
			</tr>
		</table>';
		return $html;
	}
	
	
	private function _message_ok($tipo){
		$html = '
		<table border="0" align="center">
			<tr>
				<th>El registro se  ' . $tipo . ' correctamente</th>
			</tr>
			<tr>
				<th><a href="recetas.php">Regresar</a></th>
			</tr>
		</table>';
		return $html;
	}
	
//**************************	
	
} // FIN SCRPIT
?>