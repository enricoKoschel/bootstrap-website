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
						$kundennummer = $_SESSION['kundennummer'];
						$name = $_POST['name'];
						$strasse = $_POST['strasse'];
						$plz = $_POST['plz'];
						$ort = $_POST['ort'];

						$mSQL = "
							UPDATE kunden
							SET Name = '$name', Strasse = '$strasse', PLZ = '$plz', Ort = '$ort'
							WHERE KdNr = '$kundennummer'
						";
						$abfrageErgebnis = $dbVerbindung->query($mSQL);

						if (mysqli_affected_rows($dbVerbindung) < 1) {
							echo("<div class='alert alert-warning'>Die eingegebenen Daten unterscheiden sich nicht von den vorhandenen!</div>");
							return;
						} else {
							echo("<div class='alert alert-success'>Daten wurden erfolgreich geändert!</div>");

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