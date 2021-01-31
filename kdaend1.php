<?php
	session_start();
?>

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
							$_SESSION['kundennummer'] = $kundennummer;

							$kunde = $abfrageErgebnis->fetch_object();

							echo("
								<form action='kdaend2.php' method='post'>
									<label class='form-label'>Name:
										<input type='text' name='name' class='form-control' placeholder='Name' value='" . utf8_encode($kunde->Name) . "'/>
									</label>
									<label class='form-label'>Straße:
										<input type='text' name='strasse' class='form-control' placeholder='Straße' value='" . utf8_encode($kunde->Strasse) . "'/>
									</label>
									<label class='form-label'>PLZ:
										<input type='text' name='plz' class='form-control' placeholder='PLZ' maxlength='5' value='$kunde->PLZ'/>
									</label>
									<label class='form-label'>Ort:
										<input type='text' name='ort' class='form-control' placeholder='Ort' value='" . utf8_encode($kunde->Ort) . "'/>
									</label>
									<br>
									<button type='submit' class='btn btn-primary'>Senden</button>
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