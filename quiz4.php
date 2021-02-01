<?php
	session_start();
	$_SESSION['question4'] = $_POST['radioButton'];
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

	<title>Allgemeinwissenstest Auswertung</title>
</head>
<body>
	<div id="nav-placeholder"></div>

	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<?php
					if(!$_SESSION['question1']){
						$question1 = "Nicht";
					}else if($_SESSION['question1'] == "option4"){
						$question1 = "Korrekt";
					}else{
						$question1 = "Falsch";
					}

					if(!$_SESSION['question2']){
						$question2 = "Nicht";
					}else if($_SESSION['question2'] == "option2"){
						$question2 = "Korrekt";
					}else{
						$question2 = "Falsch";
					}

					if(!$_SESSION['question3']){
						$question3 = "Nicht";
					}else if($_SESSION['question3'] == "option1"){
						$question3 = "Korrekt";
					}else{
						$question3 = "Falsch";
					}

					if(!$_SESSION['question4']){
						$question4 = "Nicht";
					}else if($_SESSION['question4'] == "option3"){
						$question4 = "Korrekt";
					}else{
						$question4 = "Falsch";
					}

					echo("
						<table class='table'>
							<tr>
								<td>Frage 1</td>
								<td>$question1 beantwortet</td>
							</tr>
							<tr>
								<td>Frage 2</td>
								<td>$question2 beantwortet</td>
							</tr>
							<tr>
								<td>Frage 3</td>
								<td>$question3 beantwortet</td>
							</tr>
							<tr>
								<td>Frage 4</td>
								<td>$question4 beantwortet</td>
							</tr>
						</table>
					");
				?>
			</div>
		</div>
	</div>
</body>
</html>