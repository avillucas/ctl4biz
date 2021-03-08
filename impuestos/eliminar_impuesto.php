<?
require_once("../conectar7.php"); 
require_once("../mysqli_result.php");

$codimpuesto=$_GET["codimpuesto"];
$cadena_busqueda=$_GET["cadena_busqueda"];

$query="SELECT * FROM impuestos WHERE codimpuesto='$codimpuesto'";
$rs_query=mysqli_query($conexion,$query);

?>

<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript">
		
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
		function aceptar(codimpuesto) {
			location.href="guardar_impuesto.php?codimpuesto=" + codimpuesto + "&accion=baja" + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		function cancelar() {
			location.href="index.php?cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header">ELIMINAR IMPUESTO </div>
				<div id="frmBusqueda">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="15%"><span id="tcod">C&Oacute;DIGO</span></td>
							<td width="85%" colspan="2"><?php echo $codimpuesto?></td>
					    </tr>
						<tr>
							<td width="15%"><span id="tnomb">Nombre</span></td>
						    <td width="85%" colspan="2"><?php echo mysqli_result($rs_query,0,"nombre")?></td>
					    </tr>
						<tr>
							<td width="15%">Valor</td>
						    <td width="85%" colspan="2"><?php echo mysqli_result($rs_query,0,"valor")?> %</td>
					    </tr>
					</table>
			  </div>
				<div id="botonBusqueda">
					<button type="button" id="btnaceptar" onClick="aceptar(<? echo $codimpuesto?>)" onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span id="taceptar">Aceptar</span> </button>
					<button type="button" id="btncancelar"  onClick="cancelar()" onMouseOver="style.cursor=cursor"> <img src="../img/cancelar.svg" alt="cancelar" /> <span id="tcancelar">Cancelar</span> </button>
			  </div>
			 </div>
		  </div>
		</div>
	</body>
</html>
