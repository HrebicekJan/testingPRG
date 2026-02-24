<?php
session_start(); // START SESSION

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Database connection
$host = 'localhost';
$dbname = 'user_system';
$username = 'root';
$password = '';

// Connect to MySQL
$conn = new mysqli($host, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to verify reCAPTCHA token
function verifyRecaptcha($token) {
    $secretKey = '6Les7wwrAAAAAC2wdAptX-42tN3OsuIXNzRExHp6';
    $url = 'https://www.google.com/recaptcha/api/siteverify';

    $data = [
        'secret' => $secretKey,
        'response' => $token
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ],
    ];
    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    return json_decode($response, true);
}

// Handle Login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $recaptcha_token = $_POST['recaptcha_token'];

    $recaptcha_result = verifyRecaptcha($recaptcha_token);

    if (!$recaptcha_result['success'] || $recaptcha_result['score'] < 0.5) {
        echo "<div class='error'>Login failed: reCAPTCHA verification failed.</div>";
    } elseif (empty($email) || empty($password)) {
        echo "<div class='error'>Login failed: Both fields are required.</div>";
    } else {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                
                // ✅ SAVE USER TO SESSION
                $_SESSION['logged_user'] = $user['email'];

                echo "<div class='success'>Login successful! Welcome back, " . htmlspecialchars($email) . "!</div>";
            } else {
                echo "<div class='error'>Login failed: Incorrect password.</div>";
            }
        } else {
            echo "<div class='error'>Login failed: No user found with that email address.</div>";
        }

        $stmt->close();
    }
}

// Handle Registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "<div class='error'>Registration failed: Both fields are required.</div>";
    } else {
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            echo "<div class='error'>Registration failed: Email is already registered.</div>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $email, $hashed_password);

            if ($stmt->execute()) {
                echo "<div class='success'>Registration successful! You can now log in.</div>";
            } else {
                echo "<div class='error'>Registration failed: " . $stmt->error . "</div>";
            }

            $stmt->close();
        }

        $check->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #74ebd5, #9face6);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 400px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        h3 {
            text-align: center;
        }

        input {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 6px;
            background: #6a11cb;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #2575fc;
        }

        .topbar {
            background: #222;
            color: white;
            padding: 10px;
            text-align: right;
        }

        .topbar a {
            color: #74ebd5;
            margin-left: 10px;
            text-decoration: none;
        }

        .error {
            color: red;
            text-align: center;
            margin: 10px 0;
        }

        .success {
            color: green;
            text-align: center;
            margin: 10px 0;
        }
    </style>
</head>
<body>

<div class="topbar">
    <?php if(isset($_SESSION["logged_user"])): ?>
        Přihlášen: <strong><?= htmlspecialchars($_SESSION["logged_user"]) ?></strong>
        <a href="?logout=1">Odhlásit</a>
    <?php else: ?>
        Nepřihlášen
    <?php endif; ?>
</div>

<div class="container">
    <h3>Login Form</h3>
    <form method="POST" id="loginForm" onsubmit="onSubmitLogin(event)">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>

    <hr>

    <h3>Registration Form</h3>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="register">Register</button>
    </form>
</div>

<script src="https://www.google.com/recaptcha/api.js?render=6Les7wwrAAAAAA2-HqLicozv8v2EwKABS_yuDfMD"></script>
<script>
function onSubmitLogin(e) {
    e.preventDefault();
    grecaptcha.ready(function () {
        grecaptcha.execute('6Les7wwrAAAAAA2-HqLicozv8v2EwKABS_yuDfMD', { action: 'login' }).then(function (token) {
            const form = document.getElementById('loginForm');
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'recaptcha_token';
            input.value = token;
            form.appendChild(input);
            form.submit();
        });
    });
}
</script>

</body>
</html>
