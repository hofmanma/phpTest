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
   $comments  = $context->getParameter( "Comments"   );
	 $len     = $comments->length( );
	 $i       = 0;
     $songId  = $song->getSONGID( );
?>
<html>
	<head>
		<title>Kommentare</title>
	</head>
	<body background="backgr.jpeg">
        <h3> Songinfo.. </h3>
        <table border="1">
               <tr>
                   <td>Nr</td>
                   <td>Title</td>
               <tr>
                   <td> <?php echo $song->getORDERNMB();?> </td>
                   <td> <?php echo $song->getTITLE();?></td>
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
            <input name="cmd" type="hidden" value="addCommentToSong"/>
            <input name="songId" type="hidden" value="<?php echo $songId;?>"/>
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
