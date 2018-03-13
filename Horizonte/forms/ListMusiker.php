<?php
   include "../classes/Http.php";
   include "../classes/Array.php";
   include "../classes/Musiker.php";
   include "../classes/Activity.php";
   include "../classes/Generiert/Entities.php";

   session_start( );

   $context = new HttpRequest( );

   $context    = $_SESSION['Context'] ;
   $musikerAll = $context->getParameter( "MusikerListe" );
   $len        = $musikerAll->length( );
   $i          = 0;
?>
<html>
	<head>
		<title>Lied bearbeiten</title>
	</head>
	<body background="backgr.jpeg">
		<table border="1">
			<tr>
				<td> Name </td>
				<td> Vorname  </td>
				<td> Username  </td>
				<td> Strasse  </td>
				<td> PLZ  </td>	
				<td> Ort </td>	
				<td> Email  </td>	
				<td> Telefon </td>
			</tr>	
			<?php 

			 	for ( $i = 0; $i < $len; $i ++ ){

					$musiker   = $musikerAll->getElement( $i );
					$musikerId = $musiker->getMUSIKERID( );
			?>
			<tr>		
				<td>
					<?php echo $musiker->getNAME( );?>
				</td>
				<td>
					<?php echo $musiker->getVORNAME( );?>
				</td>
				<td>
					<?php echo $musiker->getUSERNAME( );?>
				</td>
				<td>
					<?php echo $musiker->getSTRASSE( );?>
				</td>
				<td>
					<?php echo $musiker->getPLZ( );?>
				</td>
				<td>
					<?php echo $musiker->getORT( );?>
				</td>
				<td>
					<?php echo $musiker->getEMAIL( );?>
				</td>
				<td>
					<?php echo $musiker->getTEL( );?>
				</td>
			</tr>
			<?php  } ?>
		</table>			
	</body>
</html>
