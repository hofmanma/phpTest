<?php
   include "../classes/Http.php";
   include "../classes/Array.php";
   include "../classes/Song.php";
   include "../classes/Activity.php";
   include "../classes/Generiert/Entities.php";

   session_start( );

   $context = new HttpRequest( );
   $context   = $_SESSION['Context'] ;
   $song      = $context->getParameter( "Song" );
   $proben    = $context->getParameter( "Proben"   );
	 $len     = $proben->length( );
	 $i       = 0;
     $songId  = $song->getSONGID( );
?>
<html>
	<head>
		<title>Kommentare</title>
	</head>
	<body background="backgr.jpeg">
        <h3> Liedinfo.. </h3>
        <table border="1">
               <tr>
                   <td>Nr</td>
                   <td>Titel</td>
               <tr>
                   <td> <?php echo $song->getORDERNMB();?> </td>
                   <td> <?php echo $song->getTITLE();?></td>
               </tr>
        </table>
         <h3> Proben mit diesem Lied.. </h3>
        <table border="1">
             <tr>
                 <td>Ort</td>
                 <td>Datum</td>
                 <td></td>
             </tr>
             <?php
			 	for ( $i = 0; $i < $len; $i ++ ){

					$probe = $proben->getElement( $i );
					$probeId  = $probe->getPROBEID( );
              ?>
				<tr>
					<td>
                           <?php echo $probe->getORT( );?>
                    </td>
                    <td>
                           <?php echo $probe->getDATUM( );?>
					</td>
                    <td>
                    <td><a href="http://hofmanma.dnsalias.com/Horizonte/classes/Controller.php?cmd=showProbe&probeId=<?php echo $probeId;?>">
                            <img src="details.jpg"/></a>
                    </td>
					</td>
				</tr>
			<?php  } ?>
          </table>
	</body>
</html>
