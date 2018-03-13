<?php
   include "../classes/Http.php";
   include "../classes/Array.php";
   include "../classes/Song.php";
   include "../classes/Activity.php";
   include "../classes/Generiert/Entities.php";

   session_start( );

   $context = new HttpRequest( );
   $context   = $_SESSION['Context'] ;
     $probe   = $context->getParameter( "Probe" );
	 $songs     = $context->getParameter( "Songs"   );
	 $len       = $songs->length( );
	 $i         = 0;
     $probeId   = $probe->getPROBEID( );
?>
<html>
	<head>
		<title>Trefferliste der Liedersuche</title>
	</head>
	<body  background="backgr.jpeg">
		
     <h3> Probeninfo.. </h3>
        <table border="1">
               <tr>
                   <td>Datum</td>
                   <td>Ort</td>
               <tr>
                   <td> <?php echo $probe->getDATUM();?> </td>
                   <td> <?php echo $probe->getORT();?></td>
               </tr>
        </table>
        <h3> Liste der Lieder </h3>
        <table border="1">
             <?php
			 	for ( $i = 0; $i < $len; $i ++ ){

					$song   = $songs->getElement( $i );
					$songId = $song->getSONGID( );
             ?>
				<tr>
					<td>
						<a href="http://hofmanma.dnsalias.com/Horizonte/classes/Controller.php?cmd=removeSongFromProbe&songId=<?php echo $songId;?>&probeId=<?php echo $probeId;?>">
                           <img src="delete.jpg"/></a>
					</td>
					<td>
                           <?php echo $song->getTITLE( );?>

					</td>
                    <td>
                           <a href="http://hofmanma.dnsalias.com/Horizonte/classes/Controller.php?cmd=showSong&songId=<?php echo $songId;?>">
                              <img src="details.jpg"/>
                           </a>
                    </td>
					<td>
						<a href="http://hofmanma.dnsalias.com/Horizonte/classes/Controller.php?cmd=downloadSong&songId=<?php echo $songId;?>">
                            <img src="download.jpg"/>
						</a>
					</td>
				</tr>
			<?php  } ?>
		</table>
        <h3> Lieder in die Probe aufnehmen </h3>
        <table border="1">
            <tr>
                <td>Nr.</td>
                <td>Titel</td>
            </tr>
        <form action="http://hofmanma.dnsalias.com/Horizonte/classes/Controller.php" method="get">
            <input name="cmd" type="hidden" value="addSongToProbe"/>
            <input name="probeId" type="hidden" value="<?php echo $probeId;?>"/>
            <tr>
				<td>
					<input name="OrderNmb" type="text" size="10" maxlength="10"/>
				</td>
                <td>
					<input name="Title" type="text" size="30" maxlength="30"/>
				</td>
				<td>
					<input type="image" src="create.jpg" alt="Song hinzufügen"/>
				</td>
			</tr>
        </form>
        </table>
	</body>
</html>
