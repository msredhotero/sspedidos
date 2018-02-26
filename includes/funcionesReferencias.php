<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosReferencias {

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}


///**********  PARA SUBIR ARCHIVOS  ***********************//////////////////////////
	function borrarDirecctorio($dir) {
		array_map('unlink', glob($dir."/*.*"));	
	
	}
	
	function borrarArchivo($id,$archivo) {
		$sql	=	"delete from images where idfoto =".$id;
		
		$res =  unlink("./../archivos/".$archivo);
		if ($res)
		{
			$this->query($sql,0);	
		}
		return $res;
	}
	
	
	function existeArchivo($id,$nombre,$type) {
		$sql		=	"select * from images where refproyecto =".$id." and imagen = '".$nombre."' and type = '".$type."'";
		$resultado  =   $this->query($sql,0);
			   
			   if(mysqli_num_rows($resultado)>0){
	
				   return $this->mysqli_result($resultado,0,0);
	
			   }
	
			   return 0;	
	}
	
	function sanear_string($string)
{
 
    $string = trim($string);
 
    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );
 
    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );
 
    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );
 
    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );
 
    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );
 
    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C',),
        $string
    );
 
 
 
    return $string;
}

function crearDirectorioPrincipal($dir) {
	if (!file_exists($dir)) {
		mkdir($dir, 0777);
	}
}

	function subirArchivo($file,$carpeta,$id) {
		
		
		
		$dir_destino = '../archivos/'.$carpeta.'/'.$id.'/';
		$imagen_subida = $dir_destino . $this->sanear_string(str_replace(' ','',basename($_FILES[$file]['name'])));
		
		$noentrar = '../imagenes/index.php';
		$nuevo_noentrar = '../archivos/'.$carpeta.'/'.$id.'/'.'index.php';
		
		if (!file_exists($dir_destino)) {
			mkdir($dir_destino, 0777);
		}
		
		 
		if(!is_writable($dir_destino)){
			
			echo "no tiene permisos";
			
		}	else	{
			if ($_FILES[$file]['tmp_name'] != '') {
				if(is_uploaded_file($_FILES[$file]['tmp_name'])){
					//la carpeta de libros solo los piso
					if ($carpeta == 'galeria') {
						$this->eliminarFotoPorObjeto($id);
					}
					/*echo "Archivo ". $_FILES['foto']['name'] ." subido con éxtio.\n";
					echo "Mostrar contenido\n";
					echo $imagen_subida;*/
					if (move_uploaded_file($_FILES[$file]['tmp_name'], $imagen_subida)) {
						
						$archivo = $this->sanear_string($_FILES[$file]["name"]);
						$tipoarchivo = $_FILES[$file]["type"];
						
						if ($carpeta == 'galeria') {
							if ($this->existeArchivo($id,$archivo,$tipoarchivo) == 0) {
								$sql	=	"insert into images(idfoto,refproyecto,imagen,type) values ('',".$id.",'".str_replace(' ','',$archivo)."','".$tipoarchivo."')";
								$this->query($sql,1);
							}
						} else {
							$sql = "update dblibros set ruta = '".$dir_destino.$archivo."'";
							$this->query($sql,0);	
						}
						echo "";
						
						copy($noentrar, $nuevo_noentrar);
		
					} else {
						echo "Posible ataque de carga de archivos!\n";
					}
				}else{
					echo "Posible ataque del archivo subido: ";
					echo "nombre del archivo '". $_FILES[$file]['tmp_name'] . "'.";
				}
			}
		}	
	}


	
	function TraerFotosRelacion($id) {
		$sql    =   "select 'galeria',s.idproducto,f.imagen,f.idfoto,f.type
							from dbproductos s
							
							inner
							join images f
							on	s.idproducto = f.refproyecto

							where s.idproducto = ".$id;
		$result =   $this->query($sql, 0);
		return $result;
	}
	
	
	function eliminarFoto($id)
	{
		
		$sql		=	"select concat('galeria','/',s.idproducto,'/',f.imagen) as archivo
							from dbproductos s
							
							inner
							join images f
							on	s.idproducto = f.refproyecto

							where f.idfoto =".$id;
		$resImg		=	$this->query($sql,0);
		
		if (mysqli_num_rows($resImg)>0) {
			$res 		=	$this->borrarArchivo($id,$this->mysqli_result($resImg,0,0));
		} else {
			$res = true;
		}
		if ($res == false) {
			return 'Error al eliminar datos';
		} else {
			return '';
		}
	}
	
	function eliminarLibro($id)
	{
		
		$sql		=	"update dblibros set ruta = '' where idlibro =".$id;
		$res		=	$this->query($sql,0);
		
		if ($res == false) {
			return 'Error al eliminar datos';
		} else {
			return '';
		}
	}
	
	
	function eliminarFotoPorObjeto($id)
	{
		
		$sql		=	"select concat('galeria','/',s.idproducto,'/',f.imagen) as archivo,f.idfoto
							from dbproductos s
							
							inner
							join images f
							on	s.idproducto = f.refproyecto

							where s.idproducto =".$id;
		$resImg		=	$this->query($sql,0);
		
		if (mysqli_num_rows($resImg)>0) {
			$res 		=	$this->borrarArchivo($this->mysqli_result($resImg,0,1),$this->mysqli_result($resImg,0,0));
		} else {
			$res = true;
		}
		if ($res == false) {
			return 'Error al eliminar datos';
		} else {
			return '';
		}
	}

/* fin archivos */

/* PARA Clientes */

function insertarClientes($CodCliente,$Nombre,$Telefono,$FechaAlta,$Localidad,$Direccion,$Piso,$Depto,$CodLocal,$EntreCalle1,$EntreCalle2,$reftipoclientes,$Ubicacion,$DireccionMail,$Facebook,$Estado,$CodZona,$Numero) { 
$sql = "insert into dbclientes(idcliente,CodCliente,Nombre,Telefono,FechaAlta,Localidad,Direccion,Piso,Depto,CodLocal,EntreCalle1,EntreCalle2,reftipoclientes,Ubicacion,DireccionMail,Facebook,Estado,CodZona,Numero) 
values ('',".$CodCliente.",'".utf8_decode($Nombre)."','".utf8_decode($Telefono)."','".utf8_decode($FechaAlta)."','".utf8_decode($Localidad)."','".utf8_decode($Direccion)."','".utf8_decode($Piso)."','".utf8_decode($Depto)."',".$CodLocal.",'".utf8_decode($EntreCalle1)."','".utf8_decode($EntreCalle2)."',".$reftipoclientes.",'".utf8_decode($Ubicacion)."','".utf8_decode($DireccionMail)."','".utf8_decode($Facebook)."','".utf8_decode($Estado)."',".$CodZona.",'".utf8_decode($Numero)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarClientes($id,$CodCliente,$Nombre,$Telefono,$FechaAlta,$Localidad,$Direccion,$Piso,$Depto,$CodLocal,$EntreCalle1,$EntreCalle2,$reftipoclientes,$Ubicacion,$DireccionMail,$Facebook,$Estado,$CodZona,$Numero) { 
$sql = "update dbclientes 
set 
CodCliente = ".$CodCliente.",Nombre = '".utf8_decode($Nombre)."',Telefono = '".utf8_decode($Telefono)."',FechaAlta = '".utf8_decode($FechaAlta)."',Localidad = '".utf8_decode($Localidad)."',Direccion = '".utf8_decode($Direccion)."',Piso = '".utf8_decode($Piso)."',Depto = '".utf8_decode($Depto)."',CodLocal = ".$CodLocal.",EntreCalle1 = '".utf8_decode($EntreCalle1)."',EntreCalle2 = '".utf8_decode($EntreCalle2)."',reftipoclientes = ".$reftipoclientes.",Ubicacion = '".utf8_decode($Ubicacion)."',DireccionMail = '".utf8_decode($DireccionMail)."',Facebook = '".utf8_decode($Facebook)."',Estado = '".utf8_decode($Estado)."',CodZona = ".$CodZona.",Numero = '".utf8_decode($Numero)."' 
where idcliente =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarClientes($id) { 
$sql = "delete from dbclientes where idcliente =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerClientes() { 
$sql = "select 
c.idcliente,
c.CodCliente,
c.Nombre,
c.Telefono,
c.FechaAlta,
c.Localidad,
c.Direccion,
c.Piso,
c.Depto,
c.CodLocal,
c.EntreCalle1,
c.EntreCalle2,
c.reftipoclientes,
c.Ubicacion,
c.DireccionMail,
c.Facebook,
c.Estado,
c.CodZona,
c.Numero
from dbclientes c 
inner join tbtipoclientes tip ON tip.idtipocliente = c.reftipoclientes 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerClientesPorId($id) { 
$sql = "select idcliente,CodCliente,Nombre,Telefono,FechaAlta,Localidad,Direccion,Piso,Depto,CodLocal,EntreCalle1,EntreCalle2,reftipoclientes,Ubicacion,DireccionMail,Facebook,Estado,CodZona,Numero from dbclientes where idcliente =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbclientes*/


/* PARA Detallelistaprecios */

function insertarDetallelistaprecios($reflistaprecios,$refproductos,$Precio,$VigenciaDesde,$VigenciaHasta) { 
$sql = "insert into dbdetallelistaprecios(iddetallelistaprecio,reflistaprecios,refproductos,Precio,VigenciaDesde,VigenciaHasta) 
values ('',".$reflistaprecios.",".$refproductos.",".$Precio.",'".utf8_decode($VigenciaDesde)."','".utf8_decode($VigenciaHasta)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarDetallelistaprecios($id,$reflistaprecios,$refproductos,$Precio,$VigenciaDesde,$VigenciaHasta) { 
$sql = "update dbdetallelistaprecios 
set 
reflistaprecios = ".$reflistaprecios.",refproductos = ".$refproductos.",Precio = ".$Precio.",VigenciaDesde = '".utf8_decode($VigenciaDesde)."',VigenciaHasta = '".utf8_decode($VigenciaHasta)."' 
where iddetallelistaprecio =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarDetallelistaprecios($id) { 
$sql = "delete from dbdetallelistaprecios where iddetallelistaprecio =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerDetallelistaprecios() { 
$sql = "select 
d.iddetallelistaprecio,
d.reflistaprecios,
d.refproductos,
d.Precio,
d.VigenciaDesde,
d.VigenciaHasta
from dbdetallelistaprecios d 
inner join dblistaprecios lis ON lis.idlistaprecio = d.reflistaprecios 
inner join dbproductos pro ON pro.idproducto = d.refproductos 
inner join tbmarcas ma ON ma.idmarca = pro.refmarcas 
inner join tbgrupoproductos gr ON gr.idgrupoproducto = pro.refgrupoproductos 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerDetallelistapreciosPorId($id) { 
$sql = "select iddetallelistaprecio,reflistaprecios,refproductos,Precio,VigenciaDesde,VigenciaHasta from dbdetallelistaprecios where iddetallelistaprecio =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbdetallelistaprecios*/


/* PARA Detallepedidos */

function insertarDetallepedidos($refpedidos,$refproductos,$CodProducto,$Cantidad,$Anulados,$EnvasesACobrar,$PrecioUnitario,$Descuento,$TotalEnvases,$PrecioEnvase,$CantidadOriginal,$EnvasesOriginal) { 
$sql = "insert into dbdetallepedidos(iddetallepedido,refpedidos,refproductos,CodProducto,Cantidad,Anulados,EnvasesACobrar,PrecioUnitario,Descuento,TotalEnvases,PrecioEnvase,CantidadOriginal,EnvasesOriginal) 
values ('',".$refpedidos.",".$refproductos.",".$CodProducto.",".$Cantidad.",".$Anulados.",".$EnvasesACobrar.",".$PrecioUnitario.",".$Descuento.",".$TotalEnvases.",".$PrecioEnvase.",".$CantidadOriginal.",".$EnvasesOriginal.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarDetallepedidos($id,$refpedidos,$refproductos,$CodProducto,$Cantidad,$Anulados,$EnvasesACobrar,$PrecioUnitario,$Descuento,$TotalEnvases,$PrecioEnvase,$CantidadOriginal,$EnvasesOriginal) { 
$sql = "update dbdetallepedidos 
set 
refpedidos = ".$refpedidos.",refproductos = ".$refproductos.",CodProducto = ".$CodProducto.",Cantidad = ".$Cantidad.",Anulados = ".$Anulados.",EnvasesACobrar = ".$EnvasesACobrar.",PrecioUnitario = ".$PrecioUnitario.",Descuento = ".$Descuento.",TotalEnvases = ".$TotalEnvases.",PrecioEnvase = ".$PrecioEnvase.",CantidadOriginal = ".$CantidadOriginal.",EnvasesOriginal = ".$EnvasesOriginal." 
where iddetallepedido =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarDetallepedidos($id) { 
$sql = "delete from dbdetallepedidos where iddetallepedido =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerDetallepedidos() { 
$sql = "select 
d.iddetallepedido,
d.refpedidos,
d.refproductos,
d.CodProducto,
d.Cantidad,
d.Anulados,
d.EnvasesACobrar,
d.PrecioUnitario,
d.Descuento,
d.TotalEnvases,
d.PrecioEnvase,
d.CantidadOriginal,
d.EnvasesOriginal
from dbdetallepedidos d 
inner join dbpedidos ped ON ped.idpedido = d.refpedidos 
inner join dbproductos pro ON pro.idproducto = d.refproductos 
inner join tbmarcas ma ON ma.idmarca = pro.refmarcas 
inner join tbgrupoproductos gr ON gr.idgrupoproducto = pro.refgrupoproductos 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerDetallepedidosPorId($id) { 
$sql = "select iddetallepedido,refpedidos,refproductos,CodProducto,Cantidad,Anulados,EnvasesACobrar,PrecioUnitario,Descuento,TotalEnvases,PrecioEnvase,CantidadOriginal,EnvasesOriginal from dbdetallepedidos where iddetallepedido =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbdetallepedidos*/


/* PARA Listaprecios */

function insertarListaprecios($Descripcion,$Estado) { 
$sql = "insert into dblistaprecios(idlistaprecio,Descripcion,Estado) 
values ('','".utf8_decode($Descripcion)."',".$Estado.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarListaprecios($id,$Descripcion,$Estado) { 
$sql = "update dblistaprecios 
set 
Descripcion = '".utf8_decode($Descripcion)."',Estado = ".$Estado." 
where idlistaprecio =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarListaprecios($id) { 
$sql = "delete from dblistaprecios where idlistaprecio =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerListaprecios() { 
$sql = "select 
l.idlistaprecio,
l.Descripcion,
l.Estado
from dblistaprecios l 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerListapreciosPorId($id) { 
$sql = "select idlistaprecio,Descripcion,Estado from dblistaprecios where idlistaprecio =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dblistaprecios*/


/* PARA Pedidos */

function insertarPedidos($NroPedido,$Fecha,$Estado,$Usuario,$NroLista,$HoraEntrega,$TarjetaDelivery,$ImporteTotal,$ImportePagado,$Descuento,$HoraSalida,$HoraCarga,$NroDespacho,$Origen,$GastosEnvio,$FechaCaja,$Consignacion,$ImportePagadoOriginal) { 
$sql = "insert into dbpedidos(idpedido,NroPedido,Fecha,Estado,Usuario,NroLista,HoraEntrega,TarjetaDelivery,ImporteTotal,ImportePagado,Descuento,HoraSalida,HoraCarga,NroDespacho,Origen,GastosEnvio,FechaCaja,Consignacion,ImportePagadoOriginal) 
values ('',".$NroPedido.",'".utf8_decode($Fecha)."','".utf8_decode($Estado)."','".utf8_decode($Usuario)."',".$NroLista.",'".utf8_decode($HoraEntrega)."','".utf8_decode($TarjetaDelivery)."',".$ImporteTotal.",".$ImportePagado.",".$Descuento.",'".utf8_decode($HoraSalida)."','".utf8_decode($HoraCarga)."',".$NroDespacho.",".$Origen.",".$GastosEnvio.",'".utf8_decode($FechaCaja)."',".$Consignacion.",".$ImportePagadoOriginal.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarPedidos($id,$NroPedido,$Fecha,$Estado,$Usuario,$NroLista,$HoraEntrega,$TarjetaDelivery,$ImporteTotal,$ImportePagado,$Descuento,$HoraSalida,$HoraCarga,$NroDespacho,$Origen,$GastosEnvio,$FechaCaja,$Consignacion,$ImportePagadoOriginal) { 
$sql = "update dbpedidos 
set 
NroPedido = ".$NroPedido.",Fecha = '".utf8_decode($Fecha)."',Estado = '".utf8_decode($Estado)."',Usuario = '".utf8_decode($Usuario)."',NroLista = ".$NroLista.",HoraEntrega = '".utf8_decode($HoraEntrega)."',TarjetaDelivery = '".utf8_decode($TarjetaDelivery)."',ImporteTotal = ".$ImporteTotal.",ImportePagado = ".$ImportePagado.",Descuento = ".$Descuento.",HoraSalida = '".utf8_decode($HoraSalida)."',HoraCarga = '".utf8_decode($HoraCarga)."',NroDespacho = ".$NroDespacho.",Origen = ".$Origen.",GastosEnvio = ".$GastosEnvio.",FechaCaja = '".utf8_decode($FechaCaja)."',Consignacion = ".$Consignacion.",ImportePagadoOriginal = ".$ImportePagadoOriginal." 
where idpedido =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarPedidos($id) { 
$sql = "delete from dbpedidos where idpedido =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerPedidos() { 
$sql = "select 
p.idpedido,
p.NroPedido,
p.Fecha,
p.Estado,
p.Usuario,
p.NroLista,
p.HoraEntrega,
p.TarjetaDelivery,
p.ImporteTotal,
p.ImportePagado,
p.Descuento,
p.HoraSalida,
p.HoraCarga,
p.NroDespacho,
p.Origen,
p.GastosEnvio,
p.FechaCaja,
p.Consignacion,
p.ImportePagadoOriginal
from dbpedidos p 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerPedidosPorId($id) { 
$sql = "select idpedido,NroPedido,Fecha,Estado,Usuario,NroLista,HoraEntrega,TarjetaDelivery,ImporteTotal,ImportePagado,Descuento,HoraSalida,HoraCarga,NroDespacho,Origen,GastosEnvio,FechaCaja,Consignacion,ImportePagadoOriginal from dbpedidos where idpedido =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbpedidos*/


/* PARA Productos */

function insertarProductos($CodProducto,$Descripcion,$FechaAlta,$Estado,$StockCritico,$ControlaStock,$AvisarStock,$refmarcas,$Envase,$refgrupoproductos,$Stock,$TipoProducto,$CodProductoBarra,$StockComprometido,$PrecioEnvase) { 
$sql = "insert into dbproductos(idproducto,CodProducto,Descripcion,FechaAlta,Estado,StockCritico,ControlaStock,AvisarStock,refmarcas,Envase,refgrupoproductos,Stock,TipoProducto,CodProductoBarra,StockComprometido,PrecioEnvase) 
values ('',".$CodProducto.",'".utf8_decode($Descripcion)."','".utf8_decode($FechaAlta)."','".utf8_decode($Estado)."',".$StockCritico.",".$ControlaStock.",".$AvisarStock.",".$refmarcas.",".$Envase.",".$refgrupoproductos.",".$Stock.",'".utf8_decode($TipoProducto)."','".utf8_decode($CodProductoBarra)."',".$StockComprometido.",".$PrecioEnvase.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarProductos($id,$CodProducto,$Descripcion,$FechaAlta,$Estado,$StockCritico,$ControlaStock,$AvisarStock,$refmarcas,$Envase,$refgrupoproductos,$Stock,$TipoProducto,$CodProductoBarra,$StockComprometido,$PrecioEnvase) { 
$sql = "update dbproductos 
set 
CodProducto = ".$CodProducto.",Descripcion = '".utf8_decode($Descripcion)."',FechaAlta = '".utf8_decode($FechaAlta)."',Estado = '".utf8_decode($Estado)."',StockCritico = ".$StockCritico.",ControlaStock = ".$ControlaStock.",AvisarStock = ".$AvisarStock.",refmarcas = ".$refmarcas.",Envase = ".$Envase.",refgrupoproductos = ".$refgrupoproductos.",Stock = ".$Stock.",TipoProducto = '".utf8_decode($TipoProducto)."',CodProductoBarra = '".utf8_decode($CodProductoBarra)."',StockComprometido = ".$StockComprometido.",PrecioEnvase = ".$PrecioEnvase." 
where idproducto =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarProductos($id) { 
$sql = "delete from dbproductos where idproducto =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerProductos() { 
$sql = "select 
p.idproducto,
p.CodProducto,
p.Descripcion,
p.FechaAlta,
p.Estado,
p.StockCritico,
p.ControlaStock,
p.AvisarStock,
p.refmarcas,
p.Envase,
p.refgrupoproductos,
p.Stock,
p.TipoProducto,
p.CodProductoBarra,
p.StockComprometido,
p.PrecioEnvase,
mar.descripcion as marca,
gru.descripcion as grupo
from dbproductos p 
inner join tbmarcas mar ON mar.idmarca = p.refmarcas 
inner join tbgrupoproductos gru ON gru.idgrupoproducto = p.refgrupoproductos 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 



function traerProductosPorGrupo($idgrupo) { 
$sql = "select 
p.idproducto,
p.CodProducto,
p.Descripcion,
p.FechaAlta,
p.Estado,
p.StockCritico,
p.ControlaStock,
p.AvisarStock,
p.refmarcas,
p.Envase,
p.refgrupoproductos,
p.Stock,
p.TipoProducto,
p.CodProductoBarra,
p.StockComprometido,
p.PrecioEnvase,
mar.descripcion as marca,
gru.descripcion as grupo
from dbproductos p 
inner join tbmarcas mar ON mar.idmarca = p.refmarcas 
inner join tbgrupoproductos gru ON gru.idgrupoproducto = p.refgrupoproductos 
where gru.idgrupoproducto = ".$idgrupo."
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerProductosFaltantes() {
	$sql = "select 
p.idproducto,
p.CodProducto,
p.Descripcion,
p.FechaAlta,
p.Estado,
p.StockCritico,
p.ControlaStock,
p.AvisarStock,
p.refmarcas,
p.Envase,
p.refgrupoproductos,
p.Stock,
p.TipoProducto,
p.CodProductoBarra,
p.StockComprometido,
p.PrecioEnvase,
p.AvisarStock as cantidad
from dbproductos p 
inner join tbmarcas mar ON mar.idmarca = p.refmarcas 
inner join tbgrupoproductos gru ON gru.idgrupoproducto = p.refgrupoproductos 
where StockCritico <= Stock
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
}

function traerDetallepedidoaux() {
$sql = "select
d.iddetallepedido,
d.refproductos,
p.descripcion,
d.cantidad,
p.stock
from dbdetallepedidos d
inner
join	dbproductos p
on		p.idproducto = d.refproductos
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerProductosPorId($id) { 
$sql = "select idproducto,CodProducto,Descripcion,FechaAlta,Estado,StockCritico,ControlaStock,AvisarStock,refmarcas,Envase,refgrupoproductos,Stock,TipoProducto,CodProductoBarra,StockComprometido,PrecioEnvase from dbproductos where idproducto =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbproductos*/


/* PARA Predio_menu */

function insertarPredio_menu($url,$icono,$nombre,$Orden,$hover,$permiso) { 
$sql = "insert into predio_menu(idmenu,url,icono,nombre,Orden,hover,permiso) 
values ('','".utf8_decode($url)."','".utf8_decode($icono)."','".utf8_decode($nombre)."',".$Orden.",'".utf8_decode($hover)."','".utf8_decode($permiso)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarPredio_menu($id,$url,$icono,$nombre,$Orden,$hover,$permiso) { 
$sql = "update predio_menu 
set 
url = '".utf8_decode($url)."',icono = '".utf8_decode($icono)."',nombre = '".utf8_decode($nombre)."',Orden = ".$Orden.",hover = '".utf8_decode($hover)."',permiso = '".utf8_decode($permiso)."' 
where idmenu =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarPredio_menu($id) { 
$sql = "delete from predio_menu where idmenu =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerPredio_menu() { 
$sql = "select 
p.idmenu,
p.url,
p.icono,
p.nombre,
p.Orden,
p.hover,
p.permiso
from predio_menu p 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerPredio_menuPorId($id) { 
$sql = "select idmenu,url,icono,nombre,Orden,hover,permiso from predio_menu where idmenu =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: predio_menu*/


/* PARA Grupoproductos */

function insertarGrupoproductos($Descripcion,$TipoProducto) { 
$sql = "insert into tbgrupoproductos(idgrupoproducto,Descripcion,TipoProducto) 
values ('','".utf8_decode($Descripcion)."','".utf8_decode($TipoProducto)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarGrupoproductos($id,$Descripcion,$TipoProducto) { 
$sql = "update tbgrupoproductos 
set 
Descripcion = '".utf8_decode($Descripcion)."',TipoProducto = '".utf8_decode($TipoProducto)."' 
where idgrupoproducto =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarGrupoproductos($id) { 
$sql = "delete from tbgrupoproductos where idgrupoproducto =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerGrupoproductos() { 
$sql = "select 
g.idgrupoproducto,
g.Descripcion,
g.TipoProducto
from tbgrupoproductos g 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerGrupoproductosPorId($id) { 
$sql = "select idgrupoproducto,Descripcion,TipoProducto from tbgrupoproductos where idgrupoproducto =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbgrupoproductos*/


/* PARA Marcas */

function insertarMarcas($Descripcion) { 
$sql = "insert into tbmarcas(idmarca,Descripcion) 
values ('','".utf8_decode($Descripcion)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarMarcas($id,$Descripcion) { 
$sql = "update tbmarcas 
set 
Descripcion = '".utf8_decode($Descripcion)."' 
where idmarca =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarMarcas($id) { 
$sql = "delete from tbmarcas where idmarca =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerMarcas() { 
$sql = "select 
m.idmarca,
m.Descripcion
from tbmarcas m 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerMarcasPorId($id) { 
$sql = "select idmarca,Descripcion from tbmarcas where idmarca =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbmarcas*/


/* PARA Tipoclientes */

function insertarTipoclientes($Descripcion,$MontoMinimo,$activo) { 
$sql = "insert into tbtipoclientes(idtipocliente,Descripcion,MontoMinimo,activo) 
values ('','".utf8_decode($Descripcion)."',".$MontoMinimo.",".$activo.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarTipoclientes($id,$Descripcion,$MontoMinimo,$activo) { 
$sql = "update tbtipoclientes 
set 
Descripcion = '".utf8_decode($Descripcion)."',MontoMinimo = ".$MontoMinimo.",activo = ".$activo." 
where idtipocliente =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarTipoclientes($id) { 
$sql = "delete from tbtipoclientes where idtipocliente =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTipoclientes() { 
$sql = "select 
t.idtipocliente,
t.Descripcion,
t.MontoMinimo,
t.activo
from tbtipoclientes t 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTipoclientesPorId($id) { 
$sql = "select idtipocliente,Descripcion,MontoMinimo,activo from tbtipoclientes where idtipocliente =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbtipoclientes*/

function query_p($sql,$accion) {
		
		
		
		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();	
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
		
		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		mysql_select_db($database);
		
		        $error = 0;
		mysql_query("BEGIN");
		$result=mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		if(!$result){
			$error=1;
		}
		if($error==1){
			mysql_query("ROLLBACK");
			return false;
		}
		 else{
			mysql_query("COMMIT");
			return $result;
		}
		
	}

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

}

?>