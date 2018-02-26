<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Generador de Ajax y Includes</title>
</head>

<body>
<?php
function mysqli_result($res,$row=0,$col=0){
	    $numrows = mysqli_num_rows($res);
	    if ($numrows && $row <= ($numrows-1) && $row >=0){
	        mysqli_data_seek($res,$row);
	        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
	        if (isset($resrow[$col])){
	            return $resrow[$col];
	        }
	    }
	    return false;
	}

	function query($sql,$accion) {
		
		
		
		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();	
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
		
		//$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		$conex = mysqli_connect($hostname,$username,$password, $database);

		if (!$conex) {
		    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
		    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
		    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
		    exit;
		}
		//mysql_select_db($database);
		
		$error = 0;
		mysqli_query($conex,"BEGIN");
		$result=mysqli_query($conex,$sql);
		if ($accion && $result) {
			$result = mysqli_insert_id($conex);
		}
		if(!$result){
			$error=1;
		}
		if($error==1){
			mysqli_query($conex,"ROLLBACK");
			return false;
		}
		 else{
			mysqli_query($conex,"COMMIT");
			return $result;
		}

		mysqli_close($conex);
		
	}




$tablasAr	= array("clientes"        => "dbclientes",        
"marcas"=> "tbmarcas",
"productos"         => "dbproductos",         
"pedidos"        => "dbpedidos",        
"detallepedidos"       => "dbdetallepedidos",       
"tipoclientes"     => "tbtipoclientes",       
"grupoproductos"         => "tbgrupoproductos",
"listaprecios" => "dblistaprecios",
"detallelistaprecios" => "dbdetallelistaprecios");


function recursiveTablas($ar, $tabla, $aliasTablaMadre) {
	
	$tablasArAux2	= array("clientes"        => "dbclientes",        
"marcas"=> "tbmarcas",
"productos"         => "dbproductos",         
"pedidos"        => "dbpedidos",        
"detallepedidos"       => "dbdetallepedidos",       
"tipoclientes"     => "tbtipoclientes",       
"grupoproductos"         => "tbgrupoproductos",
"listaprecios" => "dblistaprecios",
"detallelistaprecios" => "dbdetallelistaprecios");

	$tablasArAux	= array("clientes"        => 2,        
"marcas"=> 1,
"productos"         => 2,         
"pedidos"        => 1,        
"detallepedidos"       => 3,       
"tipoclientes"     => 1,       
"grupoproductos"         => 1,
"listaprecios" => 1,
"detallelistaprecios" => 3);
	
	$inner= '';
	$sql	=	"show columns from ".$tabla;
	$res 	=	query($sql,0);
	
	while ($row = mysqli_fetch_array($res)) {
		if ($row[3] == 'MUL') {
			$TableReferencia 	= str_replace('ref','',$row[0]);
			//if ($tablasArAux[$TableReferencia] == 1) {
				recursiveTablas($tablasArAux2, $ar[$TableReferencia], $aliasTablaMadre);
			//}
			//recursiveTablas($ar, $ar[$TableReferencia], $aliasTablaMadre);
			
			$sqlTR	=	"show columns from ".$ar[$TableReferencia];
			//die(var_dump($tablasAr['clientes']));
			$resTR 	=	query($sqlTR,0);
			$inner .= " inner join ".$ar[$TableReferencia]." ".substr($TableReferencia,0,2)." ON ".substr($TableReferencia,0,2).".".mysqli_result($resTR,0,0)." = ".$aliasTablaMadre.".".$row[0]." <br>";
			
		}
	}
	
	return $inner;
}

$ajaxFunciones = '';
$ajaxFuncionesController = '';

$servicios	= "Referencias";

$sqlMapaer	= "SHOW FULL TABLES FROM fullescabio";
$resMapeo 	=	query($sqlMapaer,0);

$aliasTablaMadre = '';

while ($rowM = mysqli_fetch_array($resMapeo)) {

$sql	=	"show columns from ".$rowM[0];
$res 	=	query($sql,0);

$aliasTablaMadre = substr(str_replace('tb','',str_replace('db','',$rowM[0])),0,1);

$tabla 		= $rowM[0];
$nombre 	= ucwords(str_replace('tb','',str_replace('db','',$rowM[0])));


if ($res == false) {
	return 'Error al traer datos';
} else {

	$ajax		=	'';
	$includes	=	'';
	
	$cuerpoVariableComunes = "";
	$cuerpoVariable = "'',";
	$cuerpoSQL = '';
	
	$cuerpoVariableUpdate = "";
	$cuerpoVariablePOST = "";
	
	$ajaxFunciones .= "
	
		case 'insertar".$nombre."': <br>
			insertar".$nombre."("."$"."servicios".$servicios."); <br>
			break; <br>
		case 'modificar".$nombre."': <br>
			modificar".$nombre."("."$"."servicios".$servicios."); <br>
			break; <br>
		case 'eliminar".$nombre."': <br>
			eliminar".$nombre."("."$"."servicios".$servicios."); <br>
			break; <br>
	
	";
	
	
	
	/*
	case 'insertarJugadores':
		insertarTorneo($serviciosJugadores);
		break;
	case 'modificarJugadores':
		modificarTorneo($serviciosJugadores);
		break;
	case 'eliminarJugadores':
		eliminarTorneo($serviciosJugadores);
		break;
	*/
	$inner = '';
	while ($row = mysqli_fetch_array($res)) {
		if ($row[3] == 'PRI') {
			$clave = $row[0];			
		} else {
			
			
			// trato las tablas con referencias
			
			if ($row[3] == 'MUL') {
				$TableReferencia 	= str_replace('ref','',$row[0]);
				$sqlTR	=	"show columns from ".$tablasAr[$TableReferencia];
				//die(var_dump($tablasAr['clientes']));
				$resTR 	=	query($sqlTR,0);
				$inner .= " inner join ".$tablasAr[$TableReferencia]." ".substr($TableReferencia,0,3)." ON ".substr($TableReferencia,0,3).".".mysqli_result($resTR,0,0)." = ".$aliasTablaMadre.".".$row[0]." <br>";
				/*if ($TableReferencia == 'clientevehiculos') {
					die(var_dump('aca'));
				}*/
				$inner .= recursiveTablas($tablasAr, $tablasAr[$TableReferencia], substr($TableReferencia,0,3));
			}
			
			
			switch ($row[1]) {
				case "date":
					$cuerpoVariablePOST 	= $cuerpoVariablePOST."$".$row[0]." = "."$"."_POST['".$row[0]."']; <br>";
					$cuerpoVariable 		= $cuerpoVariable."'".'".utf8_decode($'.$row[0].')."'."',";
					$cuerpoVariableComunes	= $cuerpoVariableComunes."$".$row[0].",";
					$cuerpoSQL 				= $cuerpoSQL.$row[0].",";
					
					$cuerpoVariableUpdate = $cuerpoVariableUpdate.$row[0].' = '."'".'".utf8_decode($'.$row[0].')."'."',";
					break;
				case "datetime":
					$cuerpoVariablePOST 	= $cuerpoVariablePOST."$".$row[0]." = "."$"."_POST['".$row[0]."']; <br>";
					$cuerpoVariable = $cuerpoVariable."'".'".utf8_decode($'.$row[0].')."'."',";
					$cuerpoVariableComunes = $cuerpoVariableComunes."$".$row[0].",";
					$cuerpoSQL = $cuerpoSQL.$row[0].",";
					$cuerpoVariableUpdate = $cuerpoVariableUpdate.$row[0].' = '."'".'".utf8_decode($'.$row[0].')."'."',";
					break;
				default:
					if (strpos($row[1],"varchar") !== false) {
						$cuerpoVariablePOST 	= $cuerpoVariablePOST."$".$row[0]." = "."$"."_POST['".$row[0]."']; <br>";
						$cuerpoVariable = $cuerpoVariable."'".'".utf8_decode($'.$row[0].')."'."',";
						$cuerpoVariableComunes = $cuerpoVariableComunes."$".$row[0].",";
						$cuerpoSQL = $cuerpoSQL.$row[0].",";
						$cuerpoVariableUpdate = $cuerpoVariableUpdate.$row[0].' = '."'".'".utf8_decode($'.$row[0].')."'."',";	
					} else {
						if (strpos($row[1],"bit") !== false) {
							$cuerpoVariablePOST 	= $cuerpoVariablePOST."
									if (isset("."$"."_POST['".$row[0]."'])) { <br>
										"."$".$row[0]."	= 1; <br>
									} else { <br>
										"."$".$row[0]." = 0; <br>
									} <br>
							
							";	
							//$cuerpoSQL = $cuerpoSQL."(case when ".$row[0]." = 1 then 'Si' else 'No' end) as ".$row[0].",";
						} else {
							$cuerpoVariablePOST 	= $cuerpoVariablePOST."$".$row[0]." = "."$"."_POST['".$row[0]."']; <br>";	
							//$cuerpoSQL = $cuerpoSQL.$row[0].",";
						}
						$cuerpoVariable = $cuerpoVariable.'".$'.$row[0].'.",';
						$cuerpoVariableComunes = $cuerpoVariableComunes."$".$row[0].",";
						$cuerpoSQL = $cuerpoSQL.$row[0].",";
						$cuerpoVariableUpdate = $cuerpoVariableUpdate.$row[0].' = '.'".$'.$row[0].'."'.",";
					}
					
					break;
			}
			
		}
		
	}
	

	
	$cuerpoVariable			= substr($cuerpoVariable,0,strlen($cuerpoVariable)-1);
	$cuerpoVariableUpdate	= substr($cuerpoVariableUpdate,0,strlen($cuerpoVariableUpdate)-1);
	$cuerpoVariableComunes	= substr($cuerpoVariableComunes,0,strlen($cuerpoVariableComunes)-1);
	$cuerpoSQL				= substr($cuerpoSQL,0,strlen($cuerpoSQL)-1);
	
	
	//$ajaxFuncionesController = '';
	
	$ajaxFuncionesController .= "
	
		function insertar".$nombre."("."$"."servicios".$servicios.") { <br>
			".$cuerpoVariablePOST."
			
			"."$"."res = "."$"."servicios".$servicios."->insertar".$nombre."(".$cuerpoVariableComunes."); <br>
			
			if ((integer)"."$"."res > 0) { <br>
				echo ''; <br>
			} else { <br>
				echo 'Huvo un error al insertar datos';	 <br>
			} <br>
		
		} <br>
		
		function modificar".$nombre."("."$"."servicios".$servicios.") { <br>
			
			"."$"."id = 	"."$"."_POST['id']; <br>
			".$cuerpoVariablePOST."
			
			"."$"."res = "."$"."servicios".$servicios."->modificar".$nombre."("."$"."id,".$cuerpoVariableComunes."); <br>
			
			if ("."$"."res == true) { <br>
				echo ''; <br>
			} else { <br>
				echo 'Huvo un error al modificar datos'; <br>
			} <br>
		} <br>

		function eliminar".$nombre."("."$"."servicios".$servicios.") { <br>
			"."$"."id = 	"."$"."_POST['id']; <br>
			
			"."$"."res = "."$"."servicios".$servicios."->eliminar".$nombre."("."$"."id); <br>
			echo "."$"."res; <br>
		} <br>
	
	";





	//$includes = '';

	$includes = $includes.'
	
		function insertar'.$nombre.'('.$cuerpoVariableComunes.') { <br>		
			$sql = "insert into '.$tabla.'('.$clave.','.$cuerpoSQL.') <br>		
											values ('.$cuerpoVariable.')"; <br>		
			$res = $this->query($sql,1); <br>		
			return $res; <br>
		} <br>
	
	
		<br>
		<br>
		function modificar'.$nombre.'($id,'.$cuerpoVariableComunes.') { <br>
			$sql = "update '.$tabla.' <br>
					set <br>
						'.$cuerpoVariableUpdate.' <br>
						where '.$clave.' =".$id; <br>
			$res = $this->query($sql,0); <br>
			return $res; <br>
		} <br>
		<br>
		<br>
		function eliminar'.$nombre.'($id) { <br>
			$sql = "delete from '.$tabla.' where '.$clave.' =".$id; <br>
			$res = $this->query($sql,0); <br>
			return $res; <br>
		} <br>
		 <br>
		  <br>
		function traer'.$nombre.'() { <br>
			$sql = "select <br>'.$aliasTablaMadre.".".$clave.',<br>'.$aliasTablaMadre.".".str_replace(",",",<br>".$aliasTablaMadre.".",$cuerpoSQL).'<br> from '.$tabla." ".$aliasTablaMadre." <br>".$inner.' order by 1"; <br>
			$res = $this->query($sql,0); <br>
			return $res; <br>	
		} <br>
		 <br>
		  <br>
		function traer'.$nombre.'PorId($id) { <br>
			$sql = "select '.$clave.','.$cuerpoSQL.' from '.$tabla.' where '.$clave.' =".$id; <br>
			$res = $this->query($sql,0); <br>
			return $res; <br>	
		} <br>
	';
	

	
//	echo "<br><br>/*   PARA ".$nombre." */<br><br>".$includes."<br>/* Fin */<br>/*   PARA ".$nombre." */<br>".$ajaxFunciones."<br>/* Fin */<br><br>/*   PARA ".$nombre." */<br>".$ajaxFuncionesController."<br>/* Fin */";
	
	echo "<br><br>/*   PARA ".$nombre." */<br><br>".$includes."<br>/* Fin */<br>/*";
	
}
	
	//echo '<hr>';
	echo ' /* Fin de la Tabla: '.$rowM[0]."*/<br>";
	
}
echo "********************************************************************************<br>";
echo "<br><br>/*   PARA ".$nombre." */<br><br>".$ajaxFunciones."<br>/* Fin */<br>/*";
echo "<br><br>/*   PARA ".$nombre." */<br><br>".$ajaxFuncionesController."<br>/* Fin */<br>/*";

?>
</body>
</html>