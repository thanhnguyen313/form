<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-FQjEjXvFxYkH1EGy+NHqmrMsmUQ4rT/9+zDQ2jXfG0r/SmCnlrRUKoX04PCCb6BJ" crossorigin="anonymous"></script>
</head>
<body>
    <form action="process_register.php" method="post" onsubmit = "return validatePasswords(event)&&validateUsername(event)">
        <p>new username</p>
        <input type="text" name="name" id="new_username" onblur = "checkUsername()">
        <p id="check-result" class="text-warning"></p>
        <p>new password</p>
        <input type="password" name="new_password" id="new_password">
        <p>confirm new password</p>
        <input type="password" name="confirm_password" id="confirm_password">
        <button type="submit">sign up</button>
    </form>
    <script>
        function validatePasswords(event) {
            const npw = document.getElementById('new_password').value;
            const cpw = document.getElementById('confirm_password').value;
            if(npw !== cpw) {
                alert("Mat khau khong khop. Vui long nhap lai! ");
                event.preventDefault();
                return false;
            }
            return true;
        }
        function validateUsername(event) {
            let nun = document.getElementById('new_username').value;
            nun = nun.toLowerCase();
            if(!/^[a-z0-9_]+$/.test(nun)) {
                alert ("username khong hop le!");
                event.preventDefault();
                return false;
            }
            return true;
        }
        function checkUsername() {
            const username = document.getElementById("new_username").value.toLowerCase();
            fetch("process_register.php?action=check&username=" + encodeURIComponent(username))
                .then(res => res.text())
                .then(result => {
                    const usernameExists = (result === "exists");
                    document.getElementById("check-result").textContent = usernameExists ? "Username da ton tai!" : "";
                    if (usernameExists) {
                        document.querySelector("button[type=submit]").disabled = true;
                    } else {
                        document.querySelector("button[type=submit]").disabled = false;
                    }

            });
        }

    </script>
</body>
</html