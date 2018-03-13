<?php
   include "../classes/Http.php";
   include "../classes/Array.php";
   include "../classes/Probe.php";
   include "../classes/Activity.php";
   include "../classes/Generiert/Entities.php";

   session_start( );

   $context = new HttpRequest( );

   $context    = $_SESSION['Context'] ;
   $proben     = $context->getParameter( "Proben" );
   $len        = $proben->length( );
   $i          = 0;
?>
<html>
	<head>
		<title>Lied bearbeiten</title>
	</head>
	<body background="backgr.jpeg">
		<table border="1">
			<tr>
				<td> Datum </td>
				<td> Ort  </td>		
                <td></td>
			</tr>	
            <?php

			 	for ( $i = 0; $i < $len; $i ++ ){

					$probe   = $proben->getElement( $i );
					$probeId = $probe->getPROBEID( );
			?>
            <tr>
				<td>
					<?php echo $probe->getDATUM();?>
				</td>
				<td>
					<?php echo $probe->getORT();?>
				</td>
				<td><a href="http://hofmanma.dnsalias.com/Horizonte/classes/Controller.php?cmd=showProbe&probeId=<?php echo $probeId;?>">
				    <img src="details.jpg"/> </a>
				</td>
			</tr>
			<?php  } ?>
		</table>			
	</body>
</html>

