<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
    $middlename = isset($_POST['middlename']) ? trim($_POST['middlename']) : '';
    $lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';

    $now = time();
    setcookie('firstname', $firstname, $now + 10, '/');
    setcookie('middlename', $middlename, $now + 20, '/');
    setcookie('lastname', $lastname, $now + 30, '/');

    setcookie('firstname_exp', $now + 10, $now + 3600, '/');
    setcookie('middlename_exp', $now + 20, $now + 3600, '/');
    setcookie('lastname_exp', $now + 30, $now + 3600, '/');

    header('Location: setcookie.php?set=1');
    exit;
}

function get_cookie_safe($name) {
    return isset($_COOKIE[$name]) ? htmlspecialchars($_COOKIE[$name]) : null;
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Set Cookies (10s / 20s / 30s)</title>
    <style>
        body{font-family:Arial,Helvetica,sans-serif;margin:20px}
        label{display:inline-block;width:110px}
        input[type=text]{width:220px}
        .status{margin-top:18px;padding:12px;border:1px solid #ccc;border-radius:6px}
        .ok{color:green}
        .expired{color:#a00}
    </style>
</head>
<body>

    <a href="index.php" style="position:fixed;top:12px;right:12px;z-index:9999;text-decoration:none">
        <button type="button" style="padding:8px 12px;font-size:14px;cursor:pointer">Go Back</button>
    </a>

    <h1>Set name cookies</h1>

    <form method="post" action="setcookie.php">
        <div>
            <label for="firstname">First name:</label>
            <input id="firstname" name="firstname" type="text" required>
        </div>
        <div>
            <label for="middlename">Middle name:</label>
            <input id="middlename" name="middlename" type="text" required>
        </div>
        <div>
            <label for="lastname">Last name:</label>
            <input id="lastname" name="lastname" type="text" required>
        </div>
        <div style="margin-top:10px">
            <button type="submit">Set cookies (10s / 20s / 30s)</button>
        </div>
    </form>

    <div class="status" id="cookieStatus">
        <strong>Cookie status</strong>
        <div id="firstname_status">First name: <span class="value"><?php echo get_cookie_safe('firstname') ?? '<em>not set</em>'; ?></span></div>
        <div id="middlename_status">Middle name: <span class="value"><?php echo get_cookie_safe('middlename') ?? '<em>not set</em>'; ?></span></div>
        <div id="lastname_status">Last name: <span class="value"><?php echo get_cookie_safe('lastname') ?? '<em>not set</em>'; ?></span></div>
    </div>
    <script>
    function readCookie(name) {
        const match = document.cookie.match(new RegExp('(^|; )' + name + '=([^;]*)'));
        return match ? decodeURIComponent(match[2]) : null;
    }

    function readExpiry(name) {
        const v = readCookie(name + '_exp');
        return v ? parseInt(v, 10) : null;
    }

    function updateStatus() {
        const now = Math.floor(Date.now() / 1000);
        const items = [
            {key: 'firstname', label: 'First name'},
            {key: 'middlename', label: 'Middle name'},
            {key: 'lastname', label: 'Last name'}
        ];

        items.forEach(function(it){
            const val = readCookie(it.key);
            const exp = readExpiry(it.key);
            const el = document.getElementById(it.key + '_status');
            let out = '';
            if (val !== null) {
                if (exp) {
                    const rem = exp - now;
                    out = '<span class="ok">' + val + '</span> — expires in ' + rem + 's';
                } else {
                    out = '<span class="ok">' + val + '</span>';
                }
            } else {
                if (exp) {
                    const rem = exp - now;
                    if (rem > 0) {
                        out = '<span class="expired">(missing)</span> — expected to expire in ' + rem + 's';
                    } else {
                        out = '<span class="expired">expired ' + Math.abs(rem) + 's ago</span>';
                    }
                } else {
                    out = '<em>not set</em>';
                }
            }
            el.innerHTML = it.label + ': ' + out;
        });
    }

    updateStatus();
    setInterval(updateStatus, 1000);
    </script>

</body>
</html>
