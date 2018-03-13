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
   $songId  = $song->getSONGID( );
?>
<html>
	<head>
		<title>Kommentare</title>
	</head>
	<body background="backgr.jpeg">
        <h3> <?php echo $song->getTITLE();?></h3>
        <form action="http://hofmanma.dnsalias.com/Horizonte/classes/Controller.php"
              enctype="multipart/form-data" method="post">
          <input type="hidden" name="cmd" value="saveFileSong"/>
          <input type="hidden" name="songId" value="<?php echo $songId;?>"/>
          <table>
             <tr>
				<td>Datei:</td>
                <td>
                   <input type="file" name="Daten" id="Daten"/>
                </td>
			</tr>
            <tr>
				<td> <input type="submit" value="Upload starten"/> </td>
			</tr>
         </table>
       </form>
	</body>
</html>
