<html>
    <head>
        <title>Read</title>
    </head>
    <body>
        <h1>Login</h1>
        <form method="post" action="controler.php?action=1">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <br>
            <input type="submit" value="Login">
        </form>
    </body>
</html>