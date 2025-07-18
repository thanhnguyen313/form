<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Login form</title>
    <link rel="stylesheet" href="login_style.css"> 
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-FQjEjXvFxYkH1EGy+NHqmrMsmUQ4rT/9+zDQ2jXfG0r/SmCnlrRUKoX04PCCb6BJ" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <video autoplay muted loop playsinline id="bg-video">
        <source src="login.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <form action="process_login.php" method="post" id="form_login" class="glass">
        <p>username</p>
        <input type="text" name="name" id="username" >
        <p id="username_error"></p>
        <p>password</p>
        <input type="password" name="password" id="password">
        <button type="button" id="toggle_password"><i class="fa-solid fa-eye"></i></button>
        <p id="password_error"></p>
        <div id="btn" class="row row-col-2 gx-0">
            <button type="submit" id="login_btn" class="col-6">Login</button>
            <button id="sign_up_btn" class="col-6"><a href="/register.php">Sign Up</a></button>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            // Toggle password
            $("#toggle_password").click(function() {
                var _password = $("#password");
                var type_pw = _password.attr("type");
                var icon = $(this).find("i");

                if (type_pw === "password") {
                    _password.attr("type", "text");
                    icon.removeClass("fa-eye").addClass("fa-eye-slash");
                } else {
                    _password.attr("type", "password");
                    icon.removeClass("fa-eye-slash").addClass("fa-eye");
                }
            });
            // Onsubmit 
            $("#form_login").submit(function(e) {
                e.preventDefault(); 
                var _username = $("#username").val();
                var _password = $("#password").val();

                if(_username == "" || _username.length == 0) {
                    $("#username_error").text("Please enter your username.");
                    return false;
                }
                else if(_password == "" || _password.length == 0) {
                    $("#password_error").text("Pleasse enter your password.");
                    return false;
                }
                else {
                    $.ajax({
                        type: "POST",
                        url: "process_login.php",
                        data: {
                            name: _username,
                            password: _password,
                        },
                        dataType: "json",
                        cache: false,
                        success: function(result) {
                            if(result.message == 1) {
                                alert("Succesful");
                                window.location.href = result.success;
                            }
                            else {
                                alert(result.error || "fail");
                            }
                        },
                        error: function(request, status, error) {
                            alert("Error: " + status);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>