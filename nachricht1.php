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

	<title>Nachricht erstellen</title>
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
						$email = $_POST['email'];
						$nachricht = $_POST['nachricht'];

						if (!$kundenNummer) {
							echo("<div class='alert alert-warning'>Keine Kundennummer eingegeben!</div>");
							return;
						} else if (!$email) {
							echo("<div class='alert alert-warning'>Keine E-Mail eingegeben!</div>");
							return;
						} else if (!$nachricht) {
							echo("<div class='alert alert-warning'>Keine Nachricht eingegeben!</div>");
							return;
						}

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

						if (strpos($error, "foreign key constraint fails") != false || strpos($error, "too long for column") != false) {
							echo("<div class='alert alert-warning'>Diese Kundennummer existiert nicht!</div>");
							return;
						} else if ($error) {
							echo("<div class='alert alert-danger'><h2>Nachricht konnte nicht hinzugefügt werden!</h2>");
							echo("<br><p>Fehler: " . $error . "</p>");
							echo("</div>");
							return;
						} else {
							echo("<div class='alert alert-success'>Nachricht hinzugefügt!</div>");
						}

						$abfrageErgebnis->close();
						$dbVerbindung->close();
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