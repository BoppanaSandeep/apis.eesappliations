<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Your are hacked.</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
	<script>
		setInterval(() => {
			document.getElementById("datetime").innerHTML = moment().format('LL LTS');
		}, 1000);
	</script>
</head>

<body style="text-align:center;">
	<span>Your are hacked.</span>
	<br>
	<div id="datetime"></div>
</body>

</html>
