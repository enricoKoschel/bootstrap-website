<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">

	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
		  integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
			crossorigin="anonymous"></script>

	<script src="//code.jquery.com/jquery.min.js"></script>
	<script>
		$.get("nav.html", function (data) {
			$("#nav-placeholder").replaceWith(data);
		});
	</script>

	<title>Erledigte Nachrichten löschen</title>
</head>
<body>
	<div id="nav-placeholder"></div>

	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<?php
					$mServer = "localhost";
					$mBenutzer = "USER409427";
					$mKennwort = "AlarmStufeRot";
					$mDatenbank = "db_409427_2";

					$dbVerbindung = new mysqli($mServer, $mBenutzer, $mKennwort, $mDatenbank);

					if (mysqli_connect_errno() == 0) {
						$kundenNummer = $_POST['kundenNummer'];

						$mSQL = "
							SELECT * FROM nachrichten
							WHERE KdNr = '$kundenNummer'
						";

						$abfrageErgebnis = $dbVerbindung->query($mSQL);

						if ($abfrageErgebnis->num_rows == 0) {
							echo("<div class='alert alert-info'>Keine Nachrichten für diesen Kunden vorhanden!</div>");
						} else {
							echo("
								<table class='table'>
									<tr>
										<th>NachrichtNr</th>
										<th>KdNr</th>
										<th>EMail</th>
										<th>Nachricht</th>
										<th>Erledigt</th>
									</tr>
							");

							while ($nachricht = $abfrageErgebnis->fetch_object()) {
								$nachrichtNr = $nachricht->NachrichtNr;
								$kundenNummer = $nachricht->KdNr;
								$email = utf8_encode($nachricht->EMail);
								$nachrichtenText = utf8_encode($nachricht->Nachricht);
								$erledigt = $nachricht->erledigt ? "Ja" : "Nein";


								echo("
									<tr>
										<td>" . $nachrichtNr . "</td>
										<td>" . $kundenNummer . "</td>
										<td>" . $email . "</td>
										<td>" . $nachrichtenText . "</td>
										<td>" . $erledigt . "</td>
									</tr>
								");
							}

							echo("</table>");

							echo("
								<form action='loeschen2.php' method='post'>
									<h3>Erledigte Nachrichten von Kunde $kundenNummer löschen:</h3>
									<input type='hidden' name='kundenNummer' maxlength='5' value='$kundenNummer'/>
									<button type='submit' class='btn btn-primary'>Senden</button>
								</form>"
							);
						}
					} else {
						echo "<div class='alert alert-danger' role='alert'>";
						echo "<h2>Keine Datenbankverbindung</h2>";
						echo "<p>Fehler: ", mysqli_connect_error(), "</p>";
						echo "</div>";
					}
				?>
			</div>
		</div>
	</div>
</body>
</html>