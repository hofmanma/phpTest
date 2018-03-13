<?php
   include "../classes/Http.php";
   include "../classes/Array.php";
   include "../classes/Musiker.php";
   include "../classes/Activity.php";
   include "../classes/Generiert/Entities.php";

   session_start( );

   $context = new HttpRequest( );

   $context = $_SESSION['Context'] ;
   $musiker = $context->getParameter( "Musiker" );
?>
<html>
	<head>
		<title>Probe bearbeiten</title>
	</head>
	<body background="backgr.jpeg">
		<table>	
			<form action="http://hofmanma.dnsalias.com/Horizonte/classes/Controller.php"
                              method="get" >
			<input name="cmd" type="hidden" value="updateMusiker"/>
			<input name="musikerId" type="hidden" value="<?php echo $musiker->getMUSIKERID();?>"/>
			<tr>		
				<td>Name:</td>
				<td><input name="Name" type="text" size="30" maxlength="30"
                           value="<?php echo $musiker->getNAME( );?>"/>
				</td>
			</tr>
			<tr>
				<td>Vorname:</td>	
				<td><input name="Vorname" type="text" size="30" maxlength="30"
                           value="<?php echo $musiker->getVORNAME( );?>"/>
				</td>
			</tr>
			<tr>
				<td>Benutzername:</td>	
				<td><?php echo $musiker->getUSERNAME( );?>
				</td>
			</tr>
			<tr>
				<td>Passwort:</td>	
				<td><input type="password" size="10" maxlength="10"/
                           value="<?php echo $musiker->getPASSWORD();?>"/>
				</td>
			</tr>
			<tr>
				<td>Strasse:</td>	
				<td><input name="Strasse" type="text" size="30" maxlength="30"
                           value="<?php echo $musiker->getSTRASSE();?>"/>
				</td>
			</tr>
			<tr>
				<td>PLZ:</td>	
				<td><input name="PLZ" type="text" size="30" maxlength="30"
                            value="<?php echo $musiker->getPLZ();?>"/>
				</td>
			</tr>
			<tr>
				<td>Ort:</td>	
				<td><input name="Ort" type="text" size="30" maxlength="30"
                            value="<?php echo $musiker->getORT();?>"/>
				</td>
			</tr>
			<tr>
				<td>Email:</td>	
				<td><input name="Email" type="text" size="30" maxlength="30"
                           value="<?php echo $musiker->getEMAIL();?>"/>
				</td>
			</tr>
			<tr>
				<td>Tel.:</td>	
				<td><input name="Tel" type="text" size="30" maxlength="30"
                           value="<?php echo $musiker->getTEL();?>"/>
				</td>
			</tr>
			<tr>
				<td> <input type="submit" value="Speichern"> </td>
			</tr>
			</form>
		</table>			
	</body>
</html>
