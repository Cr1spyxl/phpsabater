<?php
require_once 'db.php';
$conn = get_db_connection();

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $breed = trim($_POST['breed'] ?? '');
    $age = intval($_POST['age'] ?? 0);
    $address = trim($_POST['address'] ?? '');
    $color = trim($_POST['color'] ?? '');
    $height = trim($_POST['height'] ?? '');
    $weight = trim($_POST['weight'] ?? '');

    if ($name === '' || $breed === '' || $age <= 0 || $address === '' || $color === '' || $height === '' || $weight === '') {
        $message = 'Please fill in all fields with valid values.';
    } else {
        $stmt = $conn->prepare('INSERT INTO dogs (name, breed, age, address, color, height, weight) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('ssissss', $name, $breed, $age, $address, $color, $height, $weight);
        if ($stmt->execute()) {
            $message = 'Dog information saved successfully.';
            $name = $breed = $address = $color = $height = $weight = '';
            $age = 0;
        } else {
            $message = 'Failed to save dog information: ' . $stmt->error;
        }
        $stmt->close();
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dog Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 700px;
            margin: 30px auto;
            background: white;
            box-shadow: 0 4px 14px rgba(0,0,0,0.08);
            border-radius: 10px;
            padding: 30px;
        }
        h1 {
            margin-top: 0;
            color: #0056b3;
        }
        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            background: #e9f7ef;
            color: #155724;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }
        form input[type="text"],
        form input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccd0d5;
            border-radius: 6px;
            margin-bottom: 18px;
            box-sizing: border-box;
        }
        .button-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }
        .button-row button,
        .button-row a {
            display: inline-block;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
        }
        .button-row button {
            background: #007bff;
            color: white;
        }
        .button-row a {
            background: #6c757d;
            color: white;
        }
        .button-row button:hover,
        .button-row a:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dog Register</h1>
        <?php if ($message !== ''): ?>
            <div class="alert"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <form method="post" action="DogRegister.php">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name ?? ''); ?>" required />

            <label for="breed">Breed</label>
            <input type="text" id="breed" name="breed" value="<?php echo htmlspecialchars($breed ?? ''); ?>" required />

            <label for="age">Age</label>
            <input type="number" id="age" name="age" min="1" value="<?php echo htmlspecialchars($age ?? ''); ?>" required />

            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address ?? ''); ?>" required />

            <label for="color">Color</label>
            <input type="text" id="color" name="color" value="<?php echo htmlspecialchars($color ?? ''); ?>" required />

            <label for="height">Height</label>
            <input type="text" id="height" name="height" value="<?php echo htmlspecialchars($height ?? ''); ?>" required />

            <label for="weight">Weight</label>
            <input type="text" id="weight" name="weight" value="<?php echo htmlspecialchars($weight ?? ''); ?>" required />

            <div class="button-row">
                <button type="submit">Save</button>
                <a href="DogView.php">View All Dogs</a>
            </div>
        </form>
    </div>
</body>
</html>
