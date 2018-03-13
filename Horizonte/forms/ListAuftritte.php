<?php
   include "../classes/Http.php";
   include "../classes/Array.php";
   include "../classes/Musiker.php";
   include "../classes/Activity.php";
   include "../classes/Generiert/Entities.php";

   session_start( );

   $context = new HttpRequest( );

   $context    = $_SESSION['Context'] ;
   $auftritte  = $context->getParameter( "Auftritte" );
   $len        = $auftritte->length( );
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

					$auftritt   = $auftritte->getElement( $i );
					$auftrId    = $auftritt->getAUFTRID( );
			?>
            <tr>
                <td>
   	                <?php echo $auftritt->getDATUM();?>
				</td>
				<td>
					<?php echo $auftritt->getORT();?>
				</td>
				<td>
					<a href="http://hofmanma.dnsalias.com/Horizonte/classes/Controller.php?cmd=showAuftritt&auftrId=<?php echo $auftrId;?>">
					 <img src="details.jpg"/></a>
				</td>
			</tr>
			<?php  } ?>
		</table>			
	</body>
</html>

