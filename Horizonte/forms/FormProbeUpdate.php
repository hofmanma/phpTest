<?php
   include "../classes/Http.php";
   include "../classes/Array.php";
   include "../classes/Auftritt.php";
   include "../classes/Activity.php";
   include "../classes/Generiert/Entities.php";

   session_start( );

   $context = new HttpRequest( );

   $context = $_SESSION['Context'] ;
   $probe   = $context->getParameter( "Probe" );
?>
<html>
	<head>
		<title>Probe bearbeiten</title>
	</head>
	<body background="backgr.jpeg">
		<table border="1">
			<form action="http://hofmanma.dnsalias.com/Horizonte/classes/Controller.php">
			<input name="cmd" type="hidden" value="updateProbe"/>
			<input name="probeId" type="hidden" value="<?php echo $probe->getPROBEID();?>"/>
			<tr>		
				<td valign="top">Datum:</td>
				<td><input name="Datum" type="text" size="10" maxlength="10"
                           value="<?php echo $probe->getDATUM();?>"/>
				</td>
			</tr>
			<tr>
				<td valign="top">Ort:</td>
				<td><input name="Ort" type="text" size="30" maxlength="30"
                           value="<?php echo $probe->getORT();?>"/>
				</td>
			</tr>
			<tr>
				<td valign="top">Beschreibung:</td>
				<td><textarea name="Description"  cols="50" rows="10"><?php echo $probe->getDESCRIPTION( );?></textarea>
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
                    <a href="http://hofmanma.dnsalias.com/Horizonte/classes/Controller.php?cmd=findSongsByProbe&probeId=<?php echo $probe->getPROBEID();?>">
                        <img src="details.jpg"/>
				    </a></td>
                 <td>Lieder</td>
			</tr>
		</table>
	</body>
</html>
