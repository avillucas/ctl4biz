<?php
include ("../conectar7.php"); 


    $codmproceso=$_GET["codmetap"];
   /* echo "<div class=\"header\">ATENCION: El meta-proceso pasado al php es: '$codmproceso'!!</div>";*/
    $donde="articulos.codarticulo=metaprocesoslinea.codarticulo AND ";
    if ($codmproceso<>""){ $donde=$donde."metaprocesos.codproceso=".$codmproceso." AND ";}
    

    
	$consulta="SELECT metaprocesos.codproceso, metaprocesos.nombre, metaprocesoslinea.codlinea, metaprocesoslinea.codarticulo, articulos.referencia, metaprocesoslinea.cantidad FROM metaprocesoslinea, articulos, metaprocesos WHERE ".$donde."metaprocesos.codproceso=metaprocesoslinea.codproceso";
  /* echo $consulta; */
        
	$rs_tabla = mysqli_query($conexion,$consulta);
	$nr_lotes= mysqli_num_rows($rs_tabla);
        echo ' <div id="cabeceraResultado" class="header">Articulo del lote </div>';
					
			echo '	<div id="frmResultado">';
			echo '	<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
			echo '			<tr class="cabeceraTabla">';
			echo '				<td width="16%"> Codigo del Meta-Proceso</td>';
			echo '				<td width="18%">Nombre del Meta-Proceso</td>';
                        echo '                                <td width="16%">Linea</td>';
                        echo '                               <td width="8%">Codigo del Articulo</td>';
                         echo '                               <td width="16%">Nombre del Articulo</td>';
                         echo '                               <td width="8%">Cantidad</td>';
			echo '				<td width="15%">Modificar</td>';
							
			echo '			</tr>';
			echo '	</table> ';     
                 while ($nr_lotes > 0) {
                             if ($nr_lotes % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }
                            $row = mysqli_fetch_row($rs_tabla);
                        
                        echo '<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
                              echo '<tr class="'.$fondolinea.'">';
							echo '<td width="16%" align="center">'.$row[0].'</td>';
							echo '<td width="18%"><div align="center">'.$row[1].'</div></td>';
							echo '<td width="16%"><div align="center">'.$row[2].'</div></td>';
							echo '<td width="8%"><div align="center">'.$row[3].'</div></td>';
                            echo '<td width="16%"><div align="center">'.$row[4].'</div></td>';
                            echo '<td width="8%"><div align="center"><input id="cantidad" type="text" class="cajaPequena" NAME="cantidad" align="center" value="'.$row[5].'" maxlength="15"></div></td>';
                            echo '<td width="15%"><div align="center"><a href="#"><img src="../img/validacion.svg" width="16" height="16" border="0"  onClick="validararticulo(' .$row[0]. ',&apos;' .$row[2]. '&apos;)"></a>
                            <a href="#"><img src="../img/borrar.svg" width="16" height="16" border="0"  onClick="borrararticulo(' .$row[0]. ',&apos;' .$row[3]. '&apos;)"></a>
                            </div></td>';
							
                              echo '</tr>';
                        echo '</table>';
                           /* echo "Codigo de lote: ",$row[0], " Articulo: ",$row[1]," Cantidad: ",$row[2], " Fecha de inizio: ",$row[3]," Hora de inicio: ",$row[4]," Fecha de finalizacion: ".$row[5],"Hora de finalizacion: ",$row[6];*/
                       /*     echo "<script type='text/javascript'>console.error('$row');</script>";*/
                            $nr_lotes--;
                        }
	
?>
