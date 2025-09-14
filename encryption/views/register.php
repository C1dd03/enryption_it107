<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <!-- <form method="POST" action="../public/register_process.php"> -->
    <form method="POST" action="../../encryption/public/register_process.php">
        <label>ID Number*</label><br>
        <input type="text" name="id_number" placeholder="xxxx-xxxx" required><br><br>

        <label>Username*</label><br>
        <input type="text" name="username" required><br><br>

        <label>Birthdate*</label><br>
        <input type="date" name="birthdate" required><br><br>

        <label>Password*</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</body>
</html>
