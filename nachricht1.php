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
				$email = $_POST['email'];
				$nachricht = $_POST['nachricht'];
				
				if(!$kundenNummer){
					echo("<h2>Keine Kundennummer eingegeben!</h2>");
					goto end;
				}
				else if(!$email){
					echo("<h2>Keine EMail eingegeben!</h2>");
					goto end;
				}
				else if(!$nachricht){
					echo("<h2>Keine Nachricht eingegeben!</h2>");
					goto end;
				}
				
				// SQL-Anweisung erstellen
				$mSQL = "
					INSERT INTO nachrichten 
					(
					KdNr, 
					EMail, 
					Nachricht
					)
					
					VALUES
					(
					'$kundenNummer',
					'$email',
					'$nachricht'
					)
				";
				
				$abfrageErgebnis = $dbVerbindung->query($mSQL);
				
				$error = $dbVerbindung->error;
				
				if(strpos($error, "foreign key constraint fails") == true){
					echo("<h2>Diese Kundennummer existiert nicht!</h2>");
					goto end;
				}else{
					echo("<h2>Nachricht hinzugefügt!</h2>");
					goto end;
				}
				
				// Ergebnistabellenobjekt und Datenbankverbindung schließen
				$abfrageErgebnis->close();
				$dbVerbindung->close();
			}
			else
			{ 
				echo "<div class=\"alert alert-danger\" role=\"alert\">";
				echo "<h2>Keine Datenbankverbindung</h2>";
				echo "<p>Fehler: ", mysqli_connect_error(), "</p>";
				echo "</div>";
			}
			
		end:
		?>
		<a href="index.html"><h1>Startseite</h1></a>
	</body>
</center>