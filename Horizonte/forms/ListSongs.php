<?php
   include "../classes/Http.php";
   include "../classes/Array.php";
   include "../classes/Song.php";
   include "../classes/Activity.php";
   include "../classes/Generiert/Entities.php";

   session_start( );

   $context = new HttpRequest( );

   $context = $_SESSION['Context'] ;
   $songs   = $context->getParameter( "Songs" );
   $len     = $songs->length( );
   $i       = 0;
?>
<html>
	<head>
		<title>Lied bearbeiten</title>
	</head>
	<body background="backgr.jpeg">
		<table border="1" >
			<tr>
                <td> Nr. </td>
				<td> Titel des Liedes </td>
                <td></td>
                <td></td>
           </tr>
			<?php 
			 	for ( $i = 0; $i < $len; $i ++ ){

					$song   = $songs->getElement( $i );
					$songId = $song->getSONGID( );
            ?>
			<tr>
                <td> <?php echo $song->getORDERNMB( );?>
				</td>
                <td> <?php echo $song->getTITLE( );?>
				</td>
                <td><a href="http://hofmanma.dnsalias.com/Horizonte/classes/Controller.php?cmd=showSong&songId=<?php echo $songId;?>">
                     <img src="details.jpg"/></a>
				</td>
                <td><a href="http://hofmanma.dnsalias.com/Horizonte/classes/DownloadSong.php?cmd=downloadSong&songId=<?php echo $songId;?>">
                     <img src="download.jpg"/></a>
				</td>
			</tr>
			<?php  } ?>
		</table>			
	</body>
</html>

