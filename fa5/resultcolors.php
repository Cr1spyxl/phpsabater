<?php
// resultcolors.php - start session, save favorite colors, display them
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // sanitize and save to session
    $_SESSION['color1'] = isset($_POST['color1']) ? htmlspecialchars(trim($_POST['color1'])) : '';
    $_SESSION['color2'] = isset($_POST['color2']) ? htmlspecialchars(trim($_POST['color2'])) : '';
    $_SESSION['color3'] = isset($_POST['color3']) ? htmlspecialchars(trim($_POST['color3'])) : '';
    $_SESSION['color4'] = isset($_POST['color4']) ? htmlspecialchars(trim($_POST['color4'])) : '';
    $_SESSION['color5'] = isset($_POST['color5']) ? htmlspecialchars(trim($_POST['color5'])) : '';
}

function showColor($n) {
    $key = 'color' . $n;
    return isset($_SESSION[$key]) && $_SESSION[$key] !== '' ? $_SESSION[$key] : '<em>not set</em>';
}

// Return a CSS-safe color value or 'inherit' if invalid
function cssColorSafe($n) {
  $val = showColor($n);
  if ($val === '<em>not set</em>') return 'inherit';
  // allow letters, digits, #, commas, parentheses, spaces, periods, percent, and -
  $clean = preg_replace('/[^A-Za-z0-9#(),.%\s\-]/', '', $val);
  $clean = trim($clean);
  if ($clean === '') return 'inherit';
  return $clean;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ResultColors</title>
  <style>
    body{font-family:Georgia,serif;margin:20px}
    .line{margin-bottom:8px}
    .swatch{display:inline-block;width:18px;height:18px;border:1px solid #333;vertical-align:middle;margin-right:8px}
    .toplink{position:fixed;top:12px;right:12px}
  </style>
</head>
<body>
  <a class="toplink" href="favoritecolor.php"><button type="button">Edit</button></a>
  <h2>Result of my Favorite Colors</h2>
  <div class="line">My Favorite Color 1: <span style="color:<?php echo cssColorSafe(1); ?>"><?php echo showColor(1); ?></span></div>
  <div class="line">My Favorite Color 2: <span style="color:<?php echo cssColorSafe(2); ?>"><?php echo showColor(2); ?></span></div>
  <div class="line">My Favorite Color 3: <span style="color:<?php echo cssColorSafe(3); ?>"><?php echo showColor(3); ?></span></div>
  <div class="line">My Favorite Color 4: <span style="color:<?php echo cssColorSafe(4); ?>"><?php echo showColor(4); ?></span></div>
  <div class="line">My Favorite Color 5: <span style="color:<?php echo cssColorSafe(5); ?>"><?php echo showColor(5); ?></span></div>

    <a href="index.php" style="position:fixed;top:12px;right:12px;z-index:9999;text-decoration:none">
        <button type="button" style="padding:8px 12px;font-size:14px;cursor:pointer">Go Back</button>
    </a>
</body>
</html>
