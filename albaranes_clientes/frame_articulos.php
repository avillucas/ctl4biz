<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
?>
<html>
<head>
<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
</head>
<script language="javascript">

function pon_prefijo(codfamilia,pref,nombre,precio,codarticulo) {
	parent.opener.document.formulario_lineas.codfamilia.value=codfamilia;
	parent.opener.document.formulario_lineas.referencia.value=pref;
	parent.opener.document.formulario_lineas.descripcion.value=nombre;
	parent.opener.document.formulario_lineas.precio.value=precio;
	parent.opener.document.formulario_lineas.codarticulo.value=codarticulo;
	parent.opener.actualizar_importe();
	parent.window.close();
}

</script>
<? require_once("../conectar7.php"); 
require_once("../mysqli_result.php");
$familia=$_POST["cmbfamilia"];
$referencia=$_POST["referencia"];
$descripcion=$_POST["descripcion"];
$where="1=1";

if ($familia<>0) { $where.=" AND articulos.codfamilia='$familia'"; }
if ($referencia<>"") { $where.=" AND referencia like '%$referencia%'"; }
if ($descripcion<>"") { $where.=" AND descripcion like '%$descripcion%'"; } ?>
<body>
<?
	
	$consulta="SELECT articulos.*,familias.nombre as nombrefamilia FROM articulos,familias WHERE ".$where." AND articulos.codfamilia=familias.codfamilia AND articulos.borrado=0 ORDER BY articulos.codfamilia ASC,articulos.descripcion ASC";
	$rs_tabla = mysqli_query($conexion,$consulta);
	$nrs=mysqli_num_rows($rs_tabla);
?>
<div id="tituloForm2" class="header">
<div align="center">
<form id="form1" name="form1">
<? if ($nrs>0) { ?>
		<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
		  <tr>
			<td width="20%"><div align="center"><b><span id="tflia">Familia</span></b></div></td>
              <td width="20%"><div align="center"><b><span id="trefren">Referencia</span></b></div></td>
              <td width="40%"><div align="center"><b><span id="tdescri">Descripci&oacute;n</span></b></div></td>
			<td width="10%"><div align="center"><b><span id="tprecio">Precio</span></b></div></td>
			<td width="10%"><div align="center"></td>
		  </tr>
		<?php
			for ($i = 0; $i < mysqli_num_rows($rs_tabla); $i++) {
				$codfamilia=mysqli_result($rs_tabla,$i,"codfamilia");
				$nombrefamilia=mysqli_result($rs_tabla,$i,"nombrefamilia");
				$codarticulo=mysqli_result($rs_tabla,$i,"codarticulo");
				$referencia=mysqli_result($rs_tabla,$i,"referencia");				
				$descripcion=mysqli_result($rs_tabla,$i,"descripcion");
				$precio=mysqli_result($rs_tabla,$i,"precio_almacen");
				 if ($i % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }?>
						<tr class="<?php echo $fondolinea?>">
					<td>
        <div align="center"><?php echo $nombrefamilia;?></div></td>
					<td>
        <div align="left"><?php echo $referencia;?></div></td>
					<td><div align="center"><?php echo $descripcion;?></div></td>
					<td><div align="center"><?php echo $precio;?></div></td>
                     <!-- @todo revisar si se busca  traducir los titles , si se los usa como guia -->
					<td align="center"><div align="center"><a href="javascript:pon_prefijo(<?php echo $codfamilia?>,'<?php echo $referencia?>','<?php echo str_replace('"','',$descripcion)?>','<?php echo $precio?>',<? echo $codarticulo?>)"><img src="../img/convertir.svg" width="16px" height="16px" border="0" data-ttitle="tsel" title="Seleccionar"></a></div></td>
				</tr>
			<?php }
		?>
  </table>
		<?php 
		}  ?>
<iframe id="frame_datos" name="frame_datos" width="0%" height="0" frameborder="0">
	<ilayer width="0" height="0" id="frame_datos" name="frame_datos"></ilayer>
</iframe>
<input type="hidden" id="accion" name="accion">
</form>
</div>
</div>
</body>
</html>
