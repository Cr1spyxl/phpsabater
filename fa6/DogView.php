<?php
require_once 'db.php';
$conn = get_db_connection();

$result = $conn->query('SELECT * FROM dogs ORDER BY created_at DESC');
$dogs = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $dogs[] = $row;
    }
    $result->free();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dog View</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #2c3e50;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 960px;
            margin: 30px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.08);
            padding: 30px;
        }
        h1 {
            margin-top: 0;
            color: #2d6cdf;
        }
        .top-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 12px;
        }
        .top-actions a {
            background: #007bff;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
        }
        .top-actions a:hover {
            opacity: 0.92;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 14px 12px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }
        th {
            background: #eef3ff;
            color: #1f3d7a;
            text-transform: uppercase;
            font-size: 13px;
        }
        tr:hover {
            background: #f7f9ff;
        }
        .empty-state {
            padding: 20px;
            background: #fff3cd;
            border: 1px solid #ffeeba;
            border-radius: 8px;
            color: #856404;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="top-actions">
            <h1>All Dogs</h1>
            <a href="DogRegister.php">Register New Dog</a>
        </div>
        <?php if (count($dogs) === 0): ?>
            <div class="empty-state">No dog records found.</div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Breed</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Color</th>
                        <th>Height</th>
                        <th>Weight</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dogs as $dog): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($dog['id']); ?></td>
                            <td><?php echo htmlspecialchars($dog['name']); ?></td>
                            <td><?php echo htmlspecialchars($dog['breed']); ?></td>
                            <td><?php echo htmlspecialchars($dog['age']); ?></td>
                            <td><?php echo htmlspecialchars($dog['address']); ?></td>
                            <td><?php echo htmlspecialchars($dog['color']); ?></td>
                            <td><?php echo htmlspecialchars($dog['height']); ?></td>
                            <td><?php echo htmlspecialchars($dog['weight']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
