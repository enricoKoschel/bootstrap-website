<center>
	<head>
		<!-- CSS only -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
		<!-- JavaScript Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
	</head>
	<body>
		<?php
			//Datenbankvariable festlegen
			$mServer="localhost";
			$mBenutzer = "USER409427";
			$mKennwort = "AlarmStufeRot";
			$mDatenbank = "db_409427_2";
			//Datenbankverbindung herstellen
			$dbVerbindung = new mysqli($mServer, $mBenutzer, $mKennwort, $mDatenbank);
			// Datenbankverbindung hergestellt ?
			if(mysqli_connect_errno() == 0)
			{
				// Datenübernahme aus der Form
				$kundenNummer = $_POST['kundenNummer'];
				// SQL-Anweisung erstellen
				
				$mSQL = "
					SELECT * FROM nachrichten
					WHERE KdNr = '$kundenNummer'
				";
				
				$abfrageErgebnis = $dbVerbindung->query($mSQL);

				if($abfrageErgebnis->num_rows == 0){
					echo("<h2>Keine Nachrichten für diesen Kunden vorhanden!</h2>");
				}
				else{
					echo("
						<table border =\"1\">
							<tr>
								<th>NachrichtNr</th>
								<th>KdNr</th>
								<th>EMail</th>
								<th>Nachricht</th>
								<th>Erledigt</th>
							</tr>
					");
					
					while ($nachricht = $abfrageErgebnis->fetch_object())			 				  
					{ 
						$nachrichtNr = $nachricht->NachrichtNr;
						$kundenNummer = $nachricht->KdNr;
						$email = $nachricht->EMail;
						$nachrichtenText = utf8_encode($nachricht->Nachricht);						
						$erledigt = $nachricht->erledigt ? "Ja" : "Nein";
						
						
						echo("
							<tr>
								<td>". $nachrichtNr ."</td>
								<td>". $kundenNummer ."</td>
								<td>". $email ."</td>
								<td>". $nachrichtenText ."</td>
								<td>". $erledigt ."</td>
							</tr>
						");
					}
					
					echo("</table>");
					
					echo("
					<form action=\"loeschen2.php\" method=\"post\">
						<p>
							<h3>Erledigte Nachrichten von Kunde $kundenNummer löschen:</h3>
							<input type=\"hidden\" name=\"kundenNummer\" value='$kundenNummer'/>
						</p>
						<p><input type=\"submit\" name=\"\" value=\"Senden\"/></p>
					</form>"
					);
				}
			}
			else
			{ 
				echo "<div class=\"alert alert-danger\" role=\"alert\">";
				echo "<h2>Keine Datenbankverbindung</h2>";
				echo "<p>Fehler: ", mysqli_connect_error(), "</p>";
				echo "</div>";
			}
		?>
		<a href="index.html"><h1>Startseite</h1></a>
	</body>
</center>