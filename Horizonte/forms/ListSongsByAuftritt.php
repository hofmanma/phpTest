<?php
   include "../classes/Http.php";
   include "../classes/Array.php";
   include "../classes/Song.php";
   include "../classes/Activity.php";
   include "../classes/Generiert/Entities.php";

   session_start( );

   $context = new HttpRequest( );
   $context   = $_SESSION['Context'] ;
     $auftritt   = $context->getParameter( "Auftritt" );
	 $songs     = $context->getParameter( "Songs"   );
	 $len       = $songs->length( );
	 $i         = 0;
     $auftrId   = $auftritt->getAUFTRID( );
?>
<html>
	<head>
		<title>Trefferliste der Liedersuche</title>
	</head>
	<body  background="backgr.jpeg">
       <h3> Auftrittinfo.. </h3>
        <table border="1">
               <tr>
                   <td>Datum</td>
                   <td>Ort</td>
               <tr>
                   <td> <?php echo $auftritt->getDATUM();?> </td>
                   <td> <?php echo $auftritt->getORT();?></td>
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
						<a href="http://hofmanma.dnsalias.com/Horizonte/classes/Controller.php?cmd=removeSongFromAuftritt&songId=<?php echo $songId;?>&auftrId=<?php echo $auftrId;?>">
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
						<a href="http://hofmanma.dnsalias.com/Horizonte/classes/DownloadSong.php?songId=<?php echo $songId;?>">
                            <img src="download.jpg"/>
						</a>
					</td>
				</tr>
			<?php  } ?>
		</table>
        <h3> Lieder zum Auftritt hinzufügen </h3>
        <table border="1">
            <tr>
                <td>Nr.</td>
                <td>Titel</td>
            </tr>
        <form action="http://hofmanma.dnsalias.com/Horizonte/classes/Controller.php">
            <input name="cmd" type="hidden" value="addSongToAuftritt"/>
            <input name="auftrId" type="hidden" value="<?php echo $auftrId;?>"/>
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
