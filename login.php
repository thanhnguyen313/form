<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form</title>
    <script>
        function validateUsername(event) {
            let username = document.getElementById('username').value;
            username = username.toLowerCase();
            if(!/^[a-z0-9_]+$/.test(username)) {
                alert ("username khong hop le!");
                event.preventDefault();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <form action="process_login.php" method="post" onsubmit = "return validateUsername(event)">
        <p>username</p>
        <input type="text" name="name" id="username" >
        <p>password</p>
        <input type="password" name="password" id="">
        <button type="submit">Login</button>
    </form>
     <form action="register.php" method="get">
            <button type="submit">Sign up</button>
    </form>
</body>
</html>