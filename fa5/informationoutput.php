<?php
function safe(array $arr, string $key): string {
	return isset($arr[$key]) ? htmlspecialchars($arr[$key]) : '';
}

$posted = !empty($_POST);

// Check if any of the required fields contain non-empty values
$required = ['firstname', 'middlename', 'lastname', 'dob', 'address'];
$has_values = false;
foreach ($required as $k) {
	if (isset($_POST[$k]) && trim($_POST[$k]) !== '') {
		$has_values = true;
		break;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Information Output</title>
	<style>body{font-family:Arial,Helvetica,sans-serif;margin:20px}</style>
</head>
<body>

    <a href="index.php" style="position:fixed;top:12px;right:12px;z-index:9999;text-decoration:none">
        <button type="button" style="padding:8px 12px;font-size:14px;cursor:pointer">Go Back</button>
    </a>

	<h1>Information Output</h1>

	<?php if (!$posted): ?>
		<p>No POST data received. Please submit the form accordingly.</p>
	<?php else: ?>
		<div>
			<p>First Name: <?php echo safe($_POST, 'firstname'); ?></p>
			<p>Middle Name: <?php echo safe($_POST, 'middlename'); ?></p>
			<p>Last Name: <?php echo safe($_POST, 'lastname'); ?></p>
			<p>Date of Birth: <?php echo safe($_POST, 'dob'); ?></p>
			<p>Address: <?php echo safe($_POST, 'address'); ?></p>
		</div>
	<?php endif; ?>

</body>
</html>

