<?php
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
    $secretKey = '6Les7wwrAAAAAC2wdAptX-42tN3OsuIXNzRExHp6'; // Replace with your secret key
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
    $result = json_decode($response, true);

    return $result;
}

// Handle Login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $recaptcha_token = $_POST['recaptcha_token'];

    $recaptcha_result = verifyRecaptcha($recaptcha_token);

    if (!$recaptcha_result['success'] || $recaptcha_result['score'] < 0.5) {
        echo "Login failed: reCAPTCHA verification failed. Please try again.";
    } elseif (empty($email) || empty($password)) {
        echo "Login failed: Both fields are required.";
    } else {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                echo "Login successful! Welcome back, " . htmlspecialchars($email) . "!";
                // header("Location: dashboard.php");
            } else {
                echo "Login failed: Incorrect password.";
            }
        } else {
            echo "Login failed: No user found with that email address.";
        }

        $stmt->close();
    }
}

// Handle Registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "Registration failed: Both fields are required.";
    } else {
        // Check if email already exists
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            echo "Registration failed: Email is already registered.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $email, $hashed_password);

            if ($stmt->execute()) {
                echo "Registration successful! You can now log in.";
                // header("Location: login.php");
            } else {
                echo "Registration failed: " . $stmt->error;
            }

            $stmt->close();
        }

        $check->close();
    }
}

$conn->close();
?>

<!-- Load reCAPTCHA v3 -->
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

<!-- HTML form for login -->
<h3>Login Form</h3>
<form method="POST" id="loginForm" onsubmit="onSubmitLogin(event)">
    <label for="email">Email:</label>
    <input type="email" name="email" required><br><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="login">Login</button>
</form>

<!-- HTML form for registration -->
<h3>Registration Form</h3>
<form method="POST">
    <label for="email">Email:</label>
    <input type="email" name="email" required><br><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="register">Register</button>
</form>
