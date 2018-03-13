<?php
   include "../classes/Http.php";
   include "../classes/Array.php";
   include "../classes/Song.php";
   include "../classes/Activity.php";
   include "../classes/Generiert/Entities.php";
   
   session_start( );

   $context = new HttpRequest( );
   
   $context = $_SESSION['Context'] ;
   $song    = $context->getParameter( "Song" );
?>

<html>
	<head>
		<title>Lied bearbeiten</title>
	</head>
	<body background="backgr.jpeg">
		<table>
			<form action="http://hofmanma.dnsalias.com/Horizonte/classes/Controller.php"
                              method="get"/>
			<input name="cmd" type="hidden" value="updateSong"/>
			<input name="songId" type="hidden" value="<?php echo $song->getSONGID();?>"/>
			<tr>
				<td valign="top">Nummer:</td>
				<td><input name="OrderNmb" type="text" size="10" maxlength="10"
                           value="<?php echo $song->getOrderNmb( );?>"/>
				</td>
			</tr>
			<tr>
				<td valign="top">Titel:</td>
				<td><input name="Title" type="text" size="30" maxlength="30"
                           value="<?php echo $song->getTITLE();?>"/>
				</td>
			</tr>
            <tr>
				<td valign="top">Kategorie:</td>
				<td>
					<input name="Category" type="text" size="30" maxlength="30"
                           value="<?php echo $song->getCATEGORY();?>"/>
				</td>
			</tr>
            <tr>
				<td valign="top">Sub-Kategorie:</td>
				<td>
					<input name="Subcategory" type="text" size="30" maxlength="30"
                           value="<?php echo $song->getSUBCATEGORY();?>"/>
				</td>
			</tr>
			<tr>
				<td valign="top">Beschreibung:</td>
				<td><textarea name="Description"  cols="50" rows="10"><?php echo $song->getDESCRIPTION( );?></textarea>
				</td>
			</tr>
			<tr>
				<td valign="top">Hinweise:</td>
				<td><textarea name="Notes"  cols="50" rows="10"><?php echo $song->getNOTES( );?></textarea>
				</td>
			</tr>
            <tr>
                 <td>Noten (Datei):</td>
                 <td>
                    <a href="http://hofmanma.dnsalias.com/Horizonte/classes/DownloadSong.php?songId=<?php echo $song->getSONGID();?>">
                        <img src="download.jpg">
				    </a>
                    <a href="http://hofmanma.dnsalias.com/Horizonte/classes/Controller.php?cmd=uploadSong&songId=<?php echo $song->getSONGID();?>">
                        <img src="create.jpg">
				    </a>
                 </td>
            </tr>
			<tr>
				<td> <input type="submit" value="Speichern"> </td>
			</tr>
			</form>
      </table>
      <table align="center" border="0">
			<tr>
                <td>
                    <a href="http://hofmanma.dnsalias.com/Horizonte/classes/Controller.php?cmd=findAuftritteBySong&songId=<?php echo $song->getSONGID();?>">
                        <img src="details.jpg"/>
				    </a></td>
                 <td>Auftritte</td>
                 <td>
                    <a href="http://hofmanma.dnsalias.com/Horizonte/classes/Controller.php?cmd=findProbenBySong&songId=<?php echo $song->getSONGID();?>">
                        <img src="details.jpg"/>
				    </a></td>
                 <td>Proben</td>
                 <td>
                    <a href="http://hofmanma.dnsalias.com/Horizonte/classes/Controller.php?cmd=findComBySong&songId=<?php echo $song->getSONGID();?>">
                       <img src="details.jpg"/>
				    </a></td>
                 <td>Kommentare
				</td>
			</tr>
		</table>
	</body>
</html>
