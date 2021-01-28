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

	<title>Kunden Bestellungen</title>
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
						$kundennummer = $_POST['kundennummer'];
						$passwort = $_POST['passwort'];

						$mSQL = "SELECT Passwort FROM kunden WHERE KdNr = '$kundennummer'";
						$abfrageErgebnis = $dbVerbindung->query($mSQL);

						if ($abfrageErgebnis->num_rows == 0) {
							echo("<div class='alert alert-warning'>Kundennummer nicht vorhanden!</div>");
							return;
						} else if ($abfrageErgebnis->fetch_object()->Passwort != $passwort) {
							echo("<div class='alert alert-warning'>Falsches Passwort!</div>");
							return;
						}

						$mSQL = "SELECT Name, Strasse, PLZ, Ort FROM kunden WHERE KdNr = '$kundennummer'";

						$abfrageErgebnis = $dbVerbindung->query($mSQL);

						if ($abfrageErgebnis->num_rows == 0) {
							echo("<div class='alert alert-warning'>Kundennummer nicht vorhanden!</div>");
							return;
						} else {
							echo("
								<form action='kdaend2.php' method='post'>
									<label class='form-label'>Kunden Nummer:
										<input type='text' name='kundennummer' class='form-control' placeholder='Kunden Nummer'/>
									</label>
									<label class='form-label'>Passwort:
										<input type='password' name='passwort' class='form-control' placeholder='Passwort'/>
									</label>
									<br>
									<button type='submit' class='btn btn-primary'>Suchen</button>
								</form>
							");

							$abfrageErgebnis->close();
							$dbVerbindung->close();
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