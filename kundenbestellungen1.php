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
				$kundennummer = $_POST['kundennummer'];
				$passwort = $_POST['passwort'];
				// SQL-Anweisung erstellen
				$mSQL = "SELECT Passwort FROM kunden WHERE KdNr = '$kundennummer'";
				$abfrageErgebnis = $dbVerbindung->query($mSQL);

				if($abfrageErgebnis->num_rows == 0){
					echo("<h2>Kundennummer nicht vorhanden!</h2>");
					goto end;
				}
				else if($abfrageErgebnis->fetch_object()->Passwort != $passwort){
					echo("<h2>Falsches Passwort!</h2>");
					goto end;
				}

				$mSQL = "
					SELECT distinct 
					auftragspositionen.AufNr, 
					artikel.ArtikelNr, 
					artikel.Bezeichnung, 
					auftragspositionen.AufMenge,
					auftragskoepfe.AufDat,
					auftragskoepfe.AufTermin,
					auftragspositionen.AufPosNr,
					artikel.VkPreis

					FROM kunden 
					INNER JOIN auftragskoepfe 
					INNER JOIN artikel 
					INNER JOIN auftragspositionen 

					WHERE auftragskoepfe.KdNr = '$kundennummer' 
					AND auftragskoepfe.AufNr = auftragspositionen.AufNr 
					AND auftragspositionen.ArtikelNr = artikel.ArtikelNr
				";
				
				$abfrageErgebnis = $dbVerbindung->query($mSQL);

				if ($abfrageErgebnis->num_rows == 0)
				{ 
					echo "<h2>Keine Bestellungen</h2>";
				}
				else
				{
					echo("
						<table border =\"1\">
							<tr>
								<th>AufNr</th>
								<th>AufDat</th>
								<th>AufTermin</th>
								<th>AufPos</th>
								<th>ArtikelNr</th>
								<th>Bezeichnung</th>
								<th>AufMenge</th>
								<th>VKPreis</th>
							</tr>
					");
					
					while ($auftrag = $abfrageErgebnis->fetch_object())			 				  
					{ 
						$auftragsNummer = $auftrag->AufNr;
						$auftragsDatum = $auftrag->AufDat;
						$auftragsTermin = $auftrag->AufTermin;
						$auftragsPos = $auftrag->AufPosNr;
						$artikelNummer = $auftrag->ArtikelNr;
						$bezeichnung = utf8_encode($auftrag->Bezeichnung);
						$auftragsMenge = $auftrag->AufMenge;
						$verkaufsPreis = $auftrag->VkPreis;
						
						echo("
							<tr>
								<td>". $auftragsNummer ."</td>
								<td>". $auftragsDatum ."</td>
								<td>". $auftragsTermin ."</td>
								<td>". $auftragsPos ."</td>
								<td>". $artikelNummer ."</td>
								<td>". $bezeichnung ."</td>
								<td>". $auftragsMenge ."</td>
								<td>". $verkaufsPreis ."</td>
							</tr>
						");
					}
					
					echo("</table>");
					
					// Ergebnistabellenobjekt und Datenbankverbindung schließen
					$abfrageErgebnis->close();
					$dbVerbindung->close();
				}
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