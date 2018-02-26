<?php

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesReferencias.php');


$serviciosUsuarios  		= new ServiciosUsuarios();
$serviciosFunciones 		= new Servicios();
$serviciosHTML				= new ServiciosHTML();
$serviciosReferencias		= new ServiciosReferencias();


$accion = $_POST['accion'];


switch ($accion) {
    case 'login':
        enviarMail($serviciosUsuarios);
        break;
	case 'entrar':
		entrar($serviciosUsuarios);
		break;
	case 'insertarUsuario':
        insertarUsuario($serviciosUsuarios);
        break;
	case 'modificarUsuario':
        modificarUsuario($serviciosUsuarios);
        break;
	case 'registrar':
		registrar($serviciosUsuarios);
        break;
    case 'registrarUsuario':
    	registrarUsuario($serviciosUsuarios);
    	break;
    case 'ingresarCrovan':
        ingresarCrovan($serviciosUsuarios);
        break;
    case 'logoutCrovan':
        logoutCrovan($serviciosUsuarios);
        break;


/* PARA Tipoclientes */

case 'insertarClientes': 
insertarClientes($serviciosReferencias); 
break; 
case 'modificarClientes': 
modificarClientes($serviciosReferencias); 
break; 
case 'eliminarClientes': 
eliminarClientes($serviciosReferencias); 
break; 
case 'insertarDetallelistaprecios': 
insertarDetallelistaprecios($serviciosReferencias); 
break; 
case 'modificarDetallelistaprecios': 
modificarDetallelistaprecios($serviciosReferencias); 
break; 
case 'eliminarDetallelistaprecios': 
eliminarDetallelistaprecios($serviciosReferencias); 
break; 
case 'insertarDetallepedidos': 
insertarDetallepedidos($serviciosReferencias); 
break; 
case 'modificarDetallepedidos': 
modificarDetallepedidos($serviciosReferencias); 
break; 
case 'eliminarDetallepedidos': 
eliminarDetallepedidos($serviciosReferencias); 
break; 
case 'insertarListaprecios': 
insertarListaprecios($serviciosReferencias); 
break; 
case 'modificarListaprecios': 
modificarListaprecios($serviciosReferencias); 
break; 
case 'eliminarListaprecios': 
eliminarListaprecios($serviciosReferencias); 
break; 
case 'insertarPedidos': 
insertarPedidos($serviciosReferencias); 
break; 
case 'modificarPedidos': 
modificarPedidos($serviciosReferencias); 
break; 
case 'eliminarPedidos': 
eliminarPedidos($serviciosReferencias); 
break; 
case 'insertarProductos': 
insertarProductos($serviciosReferencias); 
break; 
case 'modificarProductos': 
modificarProductos($serviciosReferencias); 
break; 
case 'eliminarProductos': 
eliminarProductos($serviciosReferencias); 
break; 
case 'insertarPredio_menu': 
insertarPredio_menu($serviciosReferencias); 
break; 
case 'modificarPredio_menu': 
modificarPredio_menu($serviciosReferencias); 
break; 
case 'eliminarPredio_menu': 
eliminarPredio_menu($serviciosReferencias); 
break; 
case 'insertarGrupoproductos': 
insertarGrupoproductos($serviciosReferencias); 
break; 
case 'modificarGrupoproductos': 
modificarGrupoproductos($serviciosReferencias); 
break; 
case 'eliminarGrupoproductos': 
eliminarGrupoproductos($serviciosReferencias); 
break; 
case 'insertarMarcas': 
insertarMarcas($serviciosReferencias); 
break; 
case 'modificarMarcas': 
modificarMarcas($serviciosReferencias); 
break; 
case 'eliminarMarcas': 
eliminarMarcas($serviciosReferencias); 
break; 
case 'insertarTipoclientes': 
insertarTipoclientes($serviciosReferencias); 
break; 
case 'modificarTipoclientes': 
modificarTipoclientes($serviciosReferencias); 
break; 
case 'eliminarTipoclientes': 
eliminarTipoclientes($serviciosReferencias); 
break; 

/* Fin */

/* llamadas ajax */

case 'traerProductosPorGrupo':
    traerProductosPorGrupo($serviciosReferencias, $serviciosFunciones);
    break;

/* fin */

}

/* Fin */

function traerProductosPorGrupo($serviciosReferencias, $serviciosFunciones) {
    $idgrupo = $_POST['id'];

    $resGrupo = $serviciosReferencias->traerGrupoproductosPorId($idgrupo);

    if ($idgrupo == 0) {
        echo $lstProductos  = $serviciosFunciones->devolverSelectBoxArray( $serviciosReferencias->traerProductos(),array(17,1,2,16),array('Grupo: ',' - Cod: ',' - Prod: ',' - Marca: '),'-- Todos --');
    } else {
        echo $lstProductos  = $serviciosFunciones->devolverSelectBoxArray( $serviciosReferencias->traerProductosPorGrupo($idgrupo),array(17,1,2,16),array('Grupo: ',' - Cod: ',' - Prod: ',' - Marca: '),'-- '.$serviciosReferencias->mysqli_result($resGrupo,0,1).' --');
    }
    
}

/* PARA Tipoclientes */

function insertarClientes($serviciosReferencias) { 
$CodCliente = $_POST['CodCliente']; 
$Nombre = $_POST['Nombre']; 
$Telefono = $_POST['Telefono']; 
$FechaAlta = $_POST['FechaAlta']; 
$Localidad = $_POST['Localidad']; 
$Direccion = $_POST['Direccion']; 
$Piso = $_POST['Piso']; 
$Depto = $_POST['Depto']; 
$CodLocal = $_POST['CodLocal']; 
$EntreCalle1 = $_POST['EntreCalle1']; 
$EntreCalle2 = $_POST['EntreCalle2']; 
$reftipoclientes = $_POST['reftipoclientes']; 
$Ubicacion = $_POST['Ubicacion']; 
$DireccionMail = $_POST['DireccionMail']; 
$Facebook = $_POST['Facebook']; 
$Estado = $_POST['Estado']; 
$CodZona = $_POST['CodZona']; 
$Numero = $_POST['Numero']; 
$res = $serviciosReferencias->insertarClientes($CodCliente,$Nombre,$Telefono,$FechaAlta,$Localidad,$Direccion,$Piso,$Depto,$CodLocal,$EntreCalle1,$EntreCalle2,$reftipoclientes,$Ubicacion,$DireccionMail,$Facebook,$Estado,$CodZona,$Numero); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Huvo un error al insertar datos';	 
} 
} 
function modificarClientes($serviciosReferencias) { 
$id = $_POST['id']; 
$CodCliente = $_POST['CodCliente']; 
$Nombre = $_POST['Nombre']; 
$Telefono = $_POST['Telefono']; 
$FechaAlta = $_POST['FechaAlta']; 
$Localidad = $_POST['Localidad']; 
$Direccion = $_POST['Direccion']; 
$Piso = $_POST['Piso']; 
$Depto = $_POST['Depto']; 
$CodLocal = $_POST['CodLocal']; 
$EntreCalle1 = $_POST['EntreCalle1']; 
$EntreCalle2 = $_POST['EntreCalle2']; 
$reftipoclientes = $_POST['reftipoclientes']; 
$Ubicacion = $_POST['Ubicacion']; 
$DireccionMail = $_POST['DireccionMail']; 
$Facebook = $_POST['Facebook']; 
$Estado = $_POST['Estado']; 
$CodZona = $_POST['CodZona']; 
$Numero = $_POST['Numero']; 
$res = $serviciosReferencias->modificarClientes($id,$CodCliente,$Nombre,$Telefono,$FechaAlta,$Localidad,$Direccion,$Piso,$Depto,$CodLocal,$EntreCalle1,$EntreCalle2,$reftipoclientes,$Ubicacion,$DireccionMail,$Facebook,$Estado,$CodZona,$Numero); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Huvo un error al modificar datos'; 
} 
} 
function eliminarClientes($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarClientes($id); 
echo $res; 
} 
function insertarDetallelistaprecios($serviciosReferencias) { 
$reflistaprecios = $_POST['reflistaprecios']; 
$refproductos = $_POST['refproductos']; 
$Precio = $_POST['Precio']; 
$VigenciaDesde = $_POST['VigenciaDesde']; 
$VigenciaHasta = $_POST['VigenciaHasta']; 
$res = $serviciosReferencias->insertarDetallelistaprecios($reflistaprecios,$refproductos,$Precio,$VigenciaDesde,$VigenciaHasta); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Huvo un error al insertar datos';	 
} 
} 
function modificarDetallelistaprecios($serviciosReferencias) { 
$id = $_POST['id']; 
$reflistaprecios = $_POST['reflistaprecios']; 
$refproductos = $_POST['refproductos']; 
$Precio = $_POST['Precio']; 
$VigenciaDesde = $_POST['VigenciaDesde']; 
$VigenciaHasta = $_POST['VigenciaHasta']; 
$res = $serviciosReferencias->modificarDetallelistaprecios($id,$reflistaprecios,$refproductos,$Precio,$VigenciaDesde,$VigenciaHasta); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Huvo un error al modificar datos'; 
} 
} 
function eliminarDetallelistaprecios($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarDetallelistaprecios($id); 
echo $res; 
} 
function insertarDetallepedidos($serviciosReferencias) { 
$refpedidos = $_POST['refpedidos']; 
$refproductos = $_POST['refproductos']; 
$CodProducto = $_POST['CodProducto']; 
$Cantidad = $_POST['Cantidad']; 
$Anulados = $_POST['Anulados']; 
$EnvasesACobrar = $_POST['EnvasesACobrar']; 
$PrecioUnitario = $_POST['PrecioUnitario']; 
$Descuento = $_POST['Descuento']; 
$TotalEnvases = $_POST['TotalEnvases']; 
$PrecioEnvase = $_POST['PrecioEnvase']; 
$CantidadOriginal = $_POST['CantidadOriginal']; 
$EnvasesOriginal = $_POST['EnvasesOriginal']; 
$res = $serviciosReferencias->insertarDetallepedidos($refpedidos,$refproductos,$CodProducto,$Cantidad,$Anulados,$EnvasesACobrar,$PrecioUnitario,$Descuento,$TotalEnvases,$PrecioEnvase,$CantidadOriginal,$EnvasesOriginal); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Huvo un error al insertar datos';	 
} 
} 
function modificarDetallepedidos($serviciosReferencias) { 
$id = $_POST['id']; 
$refpedidos = $_POST['refpedidos']; 
$refproductos = $_POST['refproductos']; 
$CodProducto = $_POST['CodProducto']; 
$Cantidad = $_POST['Cantidad']; 
$Anulados = $_POST['Anulados']; 
$EnvasesACobrar = $_POST['EnvasesACobrar']; 
$PrecioUnitario = $_POST['PrecioUnitario']; 
$Descuento = $_POST['Descuento']; 
$TotalEnvases = $_POST['TotalEnvases']; 
$PrecioEnvase = $_POST['PrecioEnvase']; 
$CantidadOriginal = $_POST['CantidadOriginal']; 
$EnvasesOriginal = $_POST['EnvasesOriginal']; 
$res = $serviciosReferencias->modificarDetallepedidos($id,$refpedidos,$refproductos,$CodProducto,$Cantidad,$Anulados,$EnvasesACobrar,$PrecioUnitario,$Descuento,$TotalEnvases,$PrecioEnvase,$CantidadOriginal,$EnvasesOriginal); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Huvo un error al modificar datos'; 
} 
} 
function eliminarDetallepedidos($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarDetallepedidos($id); 
echo $res; 
} 
function insertarListaprecios($serviciosReferencias) { 
$Descripcion = $_POST['Descripcion']; 
if (isset($_POST['Estado'])) { 
$Estado	= 1; 
} else { 
$Estado = 0; 
} 
$res = $serviciosReferencias->insertarListaprecios($Descripcion,$Estado); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Huvo un error al insertar datos';	 
} 
} 
function modificarListaprecios($serviciosReferencias) { 
$id = $_POST['id']; 
$Descripcion = $_POST['Descripcion']; 
if (isset($_POST['Estado'])) { 
$Estado	= 1; 
} else { 
$Estado = 0; 
} 
$res = $serviciosReferencias->modificarListaprecios($id,$Descripcion,$Estado); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Huvo un error al modificar datos'; 
} 
} 
function eliminarListaprecios($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarListaprecios($id); 
echo $res; 
} 
function insertarPedidos($serviciosReferencias) { 
$NroPedido = $_POST['NroPedido']; 
$Fecha = $_POST['Fecha']; 
$Estado = $_POST['Estado']; 
$Usuario = $_POST['Usuario']; 
$NroLista = $_POST['NroLista']; 
$HoraEntrega = $_POST['HoraEntrega']; 
$TarjetaDelivery = $_POST['TarjetaDelivery']; 
$ImporteTotal = $_POST['ImporteTotal']; 
$ImportePagado = $_POST['ImportePagado']; 
$Descuento = $_POST['Descuento']; 
$HoraSalida = $_POST['HoraSalida']; 
$HoraCarga = $_POST['HoraCarga']; 
$NroDespacho = $_POST['NroDespacho']; 
if (isset($_POST['Origen'])) { 
$Origen	= 1; 
} else { 
$Origen = 0; 
} 
$GastosEnvio = $_POST['GastosEnvio']; 
$FechaCaja = $_POST['FechaCaja']; 
if (isset($_POST['Consignacion'])) { 
$Consignacion	= 1; 
} else { 
$Consignacion = 0; 
} 
$ImportePagadoOriginal = $_POST['ImportePagadoOriginal']; 
$res = $serviciosReferencias->insertarPedidos($NroPedido,$Fecha,$Estado,$Usuario,$NroLista,$HoraEntrega,$TarjetaDelivery,$ImporteTotal,$ImportePagado,$Descuento,$HoraSalida,$HoraCarga,$NroDespacho,$Origen,$GastosEnvio,$FechaCaja,$Consignacion,$ImportePagadoOriginal); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Huvo un error al insertar datos';	 
} 
} 
function modificarPedidos($serviciosReferencias) { 
$id = $_POST['id']; 
$NroPedido = $_POST['NroPedido']; 
$Fecha = $_POST['Fecha']; 
$Estado = $_POST['Estado']; 
$Usuario = $_POST['Usuario']; 
$NroLista = $_POST['NroLista']; 
$HoraEntrega = $_POST['HoraEntrega']; 
$TarjetaDelivery = $_POST['TarjetaDelivery']; 
$ImporteTotal = $_POST['ImporteTotal']; 
$ImportePagado = $_POST['ImportePagado']; 
$Descuento = $_POST['Descuento']; 
$HoraSalida = $_POST['HoraSalida']; 
$HoraCarga = $_POST['HoraCarga']; 
$NroDespacho = $_POST['NroDespacho']; 
if (isset($_POST['Origen'])) { 
$Origen	= 1; 
} else { 
$Origen = 0; 
} 
$GastosEnvio = $_POST['GastosEnvio']; 
$FechaCaja = $_POST['FechaCaja']; 
if (isset($_POST['Consignacion'])) { 
$Consignacion	= 1; 
} else { 
$Consignacion = 0; 
} 
$ImportePagadoOriginal = $_POST['ImportePagadoOriginal']; 
$res = $serviciosReferencias->modificarPedidos($id,$NroPedido,$Fecha,$Estado,$Usuario,$NroLista,$HoraEntrega,$TarjetaDelivery,$ImporteTotal,$ImportePagado,$Descuento,$HoraSalida,$HoraCarga,$NroDespacho,$Origen,$GastosEnvio,$FechaCaja,$Consignacion,$ImportePagadoOriginal); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Huvo un error al modificar datos'; 
} 
} 
function eliminarPedidos($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarPedidos($id); 
echo $res; 
} 
function insertarProductos($serviciosReferencias) { 
$CodProducto = $_POST['CodProducto']; 
$Descripcion = $_POST['Descripcion']; 
$FechaAlta = $_POST['FechaAlta']; 
$Estado = $_POST['Estado']; 
$StockCritico = $_POST['StockCritico']; 
if (isset($_POST['ControlaStock'])) { 
$ControlaStock	= 1; 
} else { 
$ControlaStock = 0; 
} 
$AvisarStock = $_POST['AvisarStock']; 
$refmarcas = $_POST['refmarcas']; 
if (isset($_POST['Envase'])) { 
$Envase	= 1; 
} else { 
$Envase = 0; 
} 
$refgrupoproductos = $_POST['refgrupoproductos']; 
$Stock = $_POST['Stock']; 
$TipoProducto = $_POST['TipoProducto']; 
$CodProductoBarra = $_POST['CodProductoBarra']; 
$StockComprometido = $_POST['StockComprometido']; 
$PrecioEnvase = $_POST['PrecioEnvase']; 
$res = $serviciosReferencias->insertarProductos($CodProducto,$Descripcion,$FechaAlta,$Estado,$StockCritico,$ControlaStock,$AvisarStock,$refmarcas,$Envase,$refgrupoproductos,$Stock,$TipoProducto,$CodProductoBarra,$StockComprometido,$PrecioEnvase); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Huvo un error al insertar datos';	 
} 
} 
function modificarProductos($serviciosReferencias) { 
$id = $_POST['id']; 
$CodProducto = $_POST['CodProducto']; 
$Descripcion = $_POST['Descripcion']; 
$FechaAlta = $_POST['FechaAlta']; 
$Estado = $_POST['Estado']; 
$StockCritico = $_POST['StockCritico']; 
if (isset($_POST['ControlaStock'])) { 
$ControlaStock	= 1; 
} else { 
$ControlaStock = 0; 
} 
$AvisarStock = $_POST['AvisarStock']; 
$refmarcas = $_POST['refmarcas']; 
if (isset($_POST['Envase'])) { 
$Envase	= 1; 
} else { 
$Envase = 0; 
} 
$refgrupoproductos = $_POST['refgrupoproductos']; 
$Stock = $_POST['Stock']; 
$TipoProducto = $_POST['TipoProducto']; 
$CodProductoBarra = $_POST['CodProductoBarra']; 
$StockComprometido = $_POST['StockComprometido']; 
$PrecioEnvase = $_POST['PrecioEnvase']; 
$res = $serviciosReferencias->modificarProductos($id,$CodProducto,$Descripcion,$FechaAlta,$Estado,$StockCritico,$ControlaStock,$AvisarStock,$refmarcas,$Envase,$refgrupoproductos,$Stock,$TipoProducto,$CodProductoBarra,$StockComprometido,$PrecioEnvase); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Huvo un error al modificar datos'; 
} 
} 
function eliminarProductos($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarProductos($id); 
echo $res; 
} 
function insertarPredio_menu($serviciosReferencias) { 
$url = $_POST['url']; 
$icono = $_POST['icono']; 
$nombre = $_POST['nombre']; 
$Orden = $_POST['Orden']; 
$hover = $_POST['hover']; 
$permiso = $_POST['permiso']; 
$res = $serviciosReferencias->insertarPredio_menu($url,$icono,$nombre,$Orden,$hover,$permiso); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Huvo un error al insertar datos';	 
} 
} 
function modificarPredio_menu($serviciosReferencias) { 
$id = $_POST['id']; 
$url = $_POST['url']; 
$icono = $_POST['icono']; 
$nombre = $_POST['nombre']; 
$Orden = $_POST['Orden']; 
$hover = $_POST['hover']; 
$permiso = $_POST['permiso']; 
$res = $serviciosReferencias->modificarPredio_menu($id,$url,$icono,$nombre,$Orden,$hover,$permiso); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Huvo un error al modificar datos'; 
} 
} 
function eliminarPredio_menu($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarPredio_menu($id); 
echo $res; 
} 
function insertarGrupoproductos($serviciosReferencias) { 
$Descripcion = $_POST['Descripcion']; 
$TipoProducto = $_POST['TipoProducto']; 
$res = $serviciosReferencias->insertarGrupoproductos($Descripcion,$TipoProducto); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Huvo un error al insertar datos';	 
} 
} 
function modificarGrupoproductos($serviciosReferencias) { 
$id = $_POST['id']; 
$Descripcion = $_POST['Descripcion']; 
$TipoProducto = $_POST['TipoProducto']; 
$res = $serviciosReferencias->modificarGrupoproductos($id,$Descripcion,$TipoProducto); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Huvo un error al modificar datos'; 
} 
} 
function eliminarGrupoproductos($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarGrupoproductos($id); 
echo $res; 
} 
function insertarMarcas($serviciosReferencias) { 
$Descripcion = $_POST['Descripcion']; 
$res = $serviciosReferencias->insertarMarcas($Descripcion); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Huvo un error al insertar datos';	 
} 
} 
function modificarMarcas($serviciosReferencias) { 
$id = $_POST['id']; 
$Descripcion = $_POST['Descripcion']; 
$res = $serviciosReferencias->modificarMarcas($id,$Descripcion); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Huvo un error al modificar datos'; 
} 
} 
function eliminarMarcas($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarMarcas($id); 
echo $res; 
} 
function insertarTipoclientes($serviciosReferencias) { 
$Descripcion = $_POST['Descripcion']; 
$MontoMinimo = $_POST['MontoMinimo']; 
if (isset($_POST['activo'])) { 
$activo	= 1; 
} else { 
$activo = 0; 
} 
$res = $serviciosReferencias->insertarTipoclientes($Descripcion,$MontoMinimo,$activo); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Huvo un error al insertar datos';	 
} 
} 
function modificarTipoclientes($serviciosReferencias) { 
$id = $_POST['id']; 
$Descripcion = $_POST['Descripcion']; 
$MontoMinimo = $_POST['MontoMinimo']; 
if (isset($_POST['activo'])) { 
$activo	= 1; 
} else { 
$activo = 0; 
} 
$res = $serviciosReferencias->modificarTipoclientes($id,$Descripcion,$MontoMinimo,$activo); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Huvo un error al modificar datos'; 
} 
} 
function eliminarTipoclientes($serviciosReferencias) { 
$id = $_POST['id']; 
$res = $serviciosReferencias->eliminarTipoclientes($id); 
echo $res; 
} 

/* Fin */



/*****************			FIN						****************************/


////////////////////////// FIN DE TRAER DATOS ////////////////////////////////////////////////////////////

//////////////////////////  BASICO  /////////////////////////////////////////////////////////////////////////

function toArray($query)
{
    $res = array();
    while ($row = @mysqli_fetch_array($query)) {
        $res[] = $row;
    }
    return $res;
}


function entrar($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	echo $serviciosUsuarios->loginUsuario($email,$pass);
}


function registrar($serviciosUsuarios) {
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroll'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	
	$res = $serviciosUsuarios->insertarUsuario($usuario,$password,$refroll,$email,$nombre);
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}

function registrarUsuario($serviciosUsuarios) {
	$email = $_POST['email']; 
	$password = $_POST['password']; 
	$nombre = $_POST['nombre']; 
	$apellido = $_POST['apellido']; 
	$refroles = 4; 

	$activo = 0; 

	$telefono = $_POST['telefono']; 

	$res = $serviciosUsuarios->insertarUsuarios($email,$password,$nombre,$apellido,$refroles,$activo,$telefono);

	$token = $serviciosUsuarios->GUID();

	$destinatario = $email;
	$asunto = "Activar Cuenta";
	$cuerpo = "<h3>Gracias por registrarse en Crovan Kegs.</h3><br>
				<p>Por favor haga click <a href='http://www.crovankegs.com/tienda/activacion/index.php?token=".$token."'>AQUI</a> para activar la cuenta</p><br><br>
				<p>PD: Recuerde que solo estara pendiente la confirmacion por 2 dias</p>";

	if ((integer)$res > 0) {
		$serviciosUsuarios->insertarActivacionusuarios($res,$token,'','');
		$serviciosUsuarios->enviarEmail($destinatario,$asunto,$cuerpo);
		echo '';	
	} else {
		echo $res;	
	}
}


function insertarUsuario($serviciosUsuarios) {
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroles'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	
	$res = $serviciosUsuarios->insertarUsuario($usuario,$password,$refroll,$email,$nombre);
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}


function modificarUsuario($serviciosUsuarios) {
	$id					=	$_POST['id'];
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroles'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	
	echo $serviciosUsuarios->modificarUsuario($id,$usuario,$password,$refroll,$email,$nombre);
}


function enviarMail($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	//$idempresa  =	$_POST['idempresa'];
	
	echo $serviciosUsuarios->login($email,$pass);
}

function ingresarCrovan($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['password'];
	//$idempresa  =	$_POST['idempresa'];
	
	echo $serviciosUsuarios->loginCrovan($email,$pass);
}

function logoutCrovan($serviciosUsuarios) {
    echo $serviciosUsuarios->loginCrovan($email,$pass);
}


function devolverImagen($nroInput) {
	
	if( $_FILES['archivo'.$nroInput]['name'] != null && $_FILES['archivo'.$nroInput]['size'] > 0 ){
	// Nivel de errores
	  error_reporting(E_ALL);
	  $altura = 100;
	  // Constantes
	  # Altura de el thumbnail en píxeles
	  //define("ALTURA", 100);
	  # Nombre del archivo temporal del thumbnail
	  //define("NAMETHUMB", "/tmp/thumbtemp"); //Esto en servidores Linux, en Windows podría ser:
	  //define("NAMETHUMB", "c:/windows/temp/thumbtemp"); //y te olvidas de los problemas de permisos
	  $NAMETHUMB = "c:/windows/temp/thumbtemp";
	  # Servidor de base de datos
	  //define("DBHOST", "localhost");
	  # nombre de la base de datos
	  //define("DBNAME", "portalinmobiliario");
	  # Usuario de base de datos
	  //define("DBUSER", "root");
	  # Password de base de datos
	  //define("DBPASSWORD", "");
	  // Mime types permitidos
	  $mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png");
	  // Variables de la foto
	  $name = $_FILES["archivo".$nroInput]["name"];
	  $type = $_FILES["archivo".$nroInput]["type"];
	  $tmp_name = $_FILES["archivo".$nroInput]["tmp_name"];
	  $size = $_FILES["archivo".$nroInput]["size"];
	  // Verificamos si el archivo es una imagen válida
	  if(!in_array($type, $mimetypes))
		die("El archivo que subiste no es una imagen válida");
	  // Creando el thumbnail
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  $img = imagecreatefromjpeg($tmp_name);
		  break;
		case $mimetypes[2]:
		  $img = imagecreatefromgif($tmp_name);
		  break;
		case $mimetypes[3]:
		  $img = imagecreatefrompng($tmp_name);
		  break;
	  }
	  
	  $datos = getimagesize($tmp_name);
	  
	  $ratio = ($datos[1]/$altura);
	  $ancho = round($datos[0]/$ratio);
	  $thumb = imagecreatetruecolor($ancho, $altura);
	  imagecopyresized($thumb, $img, 0, 0, 0, 0, $ancho, $altura, $datos[0], $datos[1]);
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  imagejpeg($thumb, $NAMETHUMB);
			  break;
		case $mimetypes[2]:
		  imagegif($thumb, $NAMETHUMB);
		  break;
		case $mimetypes[3]:
		  imagepng($thumb, $NAMETHUMB);
		  break;
	  }
	  // Extrae los contenidos de las fotos
	  # contenido de la foto original
	  $fp = fopen($tmp_name, "rb");
	  $tfoto = fread($fp, filesize($tmp_name));
	  $tfoto = addslashes($tfoto);
	  fclose($fp);
	  # contenido del thumbnail
	  $fp = fopen($NAMETHUMB, "rb");
	  $tthumb = fread($fp, filesize($NAMETHUMB));
	  $tthumb = addslashes($tthumb);
	  fclose($fp);
	  // Borra archivos temporales si es que existen
	  //@unlink($tmp_name);
	  //@unlink(NAMETHUMB);
	} else {
		$tfoto = '';
		$type = '';
	}
	$tfoto = utf8_decode($tfoto);
	return array('tfoto' => $tfoto, 'type' => $type);	
}


?>