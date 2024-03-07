<?php 
    session_start();

    // data pengguna yang valid
    $valid_user = 'rahman';
    $valid_password = '3456';

    // batasan percobaan login
    $attempt_limit = 3;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // validasi login
        if ($username === $valid_user && $password === $valid_password) {
            $_SESSION['username'] = $username;
        header('Location: https://instagram.com/rahmannn_778'); // Redirect ke halaman index setelah login sukses
        exit;
        } else {
            // menghitung percobaan login
            $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;

            $remaining_attempts = $attempt_limit - ($_SESSION['login_attempts'] ?? 0);

            // mencegah login jika melebihi batas

            if ($remaining_attempts <= 0) {
                $error_message = 'percobaan login anda terlalu banyak. coba lagi nanti';
            } else {
                $error_message = "username atau password salah. sisa percobaan login anda adalah $remaining_attempts";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login To Project</title>
</head>
<body>
    <h3>LOGIN</h3>

    <?php if (isset($error_message)): ?>
 <p style="color: red;"><?php echo $error_message; ?></p>
<?php endif; ?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">username:</label>
        <input type="text" name="username" required>
        <br>

        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>

        <input type="submit" value="Login">
    </form>
</body>
</html>