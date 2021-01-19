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
				$artikelNummer = $_POST['artikelnummer'];
				// SQL-Anweisung erstellen

				$mSQL = "
					TRUNCATE TABLE nachrichten
				";
				
				$abfrageErgebnis = $dbVerbindung->query($mSQL);
				
				echo($dbVerbindung->error);
				
				echo("<h2>Alle Nachrichten wurden gelöscht!</h2>");
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