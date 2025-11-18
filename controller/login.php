<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login User</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f4f4f4; }
        .login-container { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); width: 300px; }
        input[type="text"], input[type="password"], button { width: 100%; padding: 10px; margin: 8px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background-color: #007bff; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>LOGIN</h2>
        <form action="login_system.php" method="POST">
            <label for="nidn">NIDN:</label>
            <input type="text" id="nidn" name="nidn" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="submit">MASUK</button>
        </form>
    </div>
</body>
</html>