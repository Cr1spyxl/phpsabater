<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; margin: 20px; }
        .forms { display: flex; gap: 40px; align-items: flex-start; }
        label { display: inline-block; width: 110px; margin-bottom: 6px; }
        input[type="text"], input[type="date"] { width: 220px; }
        .result { margin-top: 20px; padding: 12px; border: 1px dashed #666; }
    </style>
</head>
<body>
    <a href="index.php" style="position:fixed;top:12px;right:12px;z-index:9999;text-decoration:none">
        <button type="button" style="padding:8px 12px;font-size:14px;cursor:pointer">Go Back</button>
    </a>

<?php
function val(array $arr, string $key): string {
    return isset($arr[$key]) ? htmlspecialchars($arr[$key]) : '';
}

$get_submitted = !empty($_GET);
$post_submitted = !empty($_POST);

// Helper to render a submitted block
function render_block(string $method, array $data) {
    if (empty($data)) return;
    echo "<div class=\"result\">";
    echo "<strong>Submitted via $method</strong><br><br>";
    echo "First Name: " . val($data, 'firstname') . "<br>";
    echo "Middle Name: " . val($data, 'middlename') . "<br>";
    echo "Last Name: " . val($data, 'lastname') . "<br>";
    echo "Date of Birth: " . val($data, 'dob') . "<br>";
    echo "Address: " . val($data, 'address') . "<br>";
    echo "</div>";
}

// Display submitted data (if any)
if ($get_submitted) {
    render_block('GET', $_GET);
}
?>

<h1>Personal Information</h1>
<div class="forms">
    <form method="post" action="informationoutput.php">
        <label for="g_firstname">First Name:</label>
        <input id="g_firstname" type="text" name="firstname" value="<?php echo val($_GET, 'firstname'); ?>" required><br>
        <label for="g_middlename">Middle Name:</label>
        <input id="g_middlename" type="text" name="middlename" value="<?php echo val($_GET, 'middlename'); ?>" required><br>
        <label for="g_lastname">Last Name:</label>
        <input id="g_lastname" type="text" name="lastname" value="<?php echo val($_GET, 'lastname'); ?>" required><br>
        <label for="g_dob">Date of Birth:</label>
        <input id="g_dob" type="date" name="dob" value="<?php echo val($_GET, 'dob'); ?>" required><br>
        <label for="g_address">Address:</label>
        <input id="g_address" type="text" name="address" value="<?php echo val($_GET, 'address'); ?>" required><br><br>
        <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>