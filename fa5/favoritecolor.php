<?php
// favoritecolor.php - form to collect 5 favorite colors
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FavoriteColor</title>
  <style>
    body{font-family:Arial,Helvetica,sans-serif;margin:20px}
    table{border-collapse:collapse;width:480px}
    td{border:1px solid #999;padding:8px}
    input[type=text]{width:100%}
    .center{margin-top:12px}
    .toplink{position:fixed;top:12px;right:12px}
  </style>
</head>
<body>
    <a href="index.php" style="position:fixed;top:12px;right:12px;z-index:9999;text-decoration:none">
        <button type="button" style="padding:8px 12px;font-size:14px;cursor:pointer">Go Back</button>
    </a>
  <h2>My Favorite Colors</h2>
  <form method="post" action="resultcolors.php">
    <table>
      <tr><td colspan="2" style="text-align:center;font-weight:bold">Enter your favorite colors</td></tr>
      <tr><td>Favorite color 1:</td><td><input name="color1" type="text" required placeholder="Red"></td></tr>
      <tr><td>Favorite color 2:</td><td><input name="color2" type="text" required placeholder="Yellow"></td></tr>
      <tr><td>Favorite color 3:</td><td><input name="color3" type="text" required placeholder="Orange"></td></tr>
      <tr><td>Favorite color 4:</td><td><input name="color4" type="text" required placeholder="Violet"></td></tr>
      <tr><td>Favorite color 5:</td><td><input name="color5" type="text" required placeholder="Blue"></td></tr>
      <tr><td colspan="2" class="center"><button type="submit">send colors</button></td></tr>
    </table>
  </form>
</body>
</html>
