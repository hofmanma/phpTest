<?php
   include "../classes/Http.php";
   include "../classes/Array.php";
   include "../classes/Song.php";
   include "../classes/Activity.php";
   include "../classes/Generiert/Entities.php";

   session_start( );

   $context = new HttpRequest( );
   $context   = $_SESSION['Context'] ;
   $auftritt  = $context->getParameter( "Auftritt" );
   $comments  = $context->getParameter( "Comments"   );
	 $len     = $comments->length( );
	 $i       = 0;
     $auftrId = $auftritt->getAUFTRID( );
?>
<html>
	<head>
		<title>Kommentare</title>
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
         <h3> Kommentare.. </h3>
        <table border="1">
             <?php
			 	for ( $i = 0; $i < $len; $i ++ ){

					$comment   = $comments->getElement( $i );
					$comId = $comment->getCOMMENTID( );
              ?>
				<tr>

					<td>
                           <?php echo $comment->getUSERNAME( );?> am <br>
                           <?php echo $comment->getDATUM( );?>
					</td>

                    <td> <code>
                          <?php echo $comment->getTEXTSTR( );?>
                         </code>
					</td>
				</tr>
			<?php  } ?>
          </table>
          <h3> Neuen Kommentar erfassen.. </h3>
          <table border="1">
        <form action="http://hofmanma.dnsalias.com/Horizonte/classes/Controller.php" method="get">
            <input name="cmd" type="hidden" value="addCommentToAuftritt"/>
            <input name="auftrId" type="hidden" value="<?php echo $auftrId;?>"/>
            <tr>
				<td>
                   <textarea  name="Text" cols="50" rows="10">
				    </textarea>
				</td>
            </tr>
            <tr>
				<td>
                <input type="submit" value="Sichern">
				</td>
			</tr>
        </form>
        </table>
	</body>
</html>
