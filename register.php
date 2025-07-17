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
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <form action="process_register.php" method="post" id = "form_register">
        <p>new username</p>
        <input type="text" name="name" id="new_username">
        <p id="username_error"></p>
        <p>new password</p>
        <input type="password" name="new_password" id="new_password">
        <button type="button" id="toggle_new_password"><i class="fa-solid fa-eye"></i></button>
        <p id="new_password_error"></p>
        <p>confirm new password</p>
        <input type="password" name="confirm_password" id="confirm_password">
        <button type="button" id="toggle_confirm_password"><i class="fa-solid fa-eye"></i></button>
        <p id="confirm_password_error"></p>
        <button type="submit">sign up</button>
    </form>
    <script>
        $(document).ready(function() {
            // Toggle new password
            $("#toggle_new_password").click(function() {
                var _new_password = $("#new_password");
                var type_npw = _new_password.attr("type");
                var icon = $(this).find("i");

                if (type_npw === "password") {
                    _new_password.attr("type", "text");
                    icon.removeClass("fa-eye").addClass("fa-eye-slash");
                } else {
                    _new_password.attr("type", "password");
                    icon.removeClass("fa-eye-slash").addClass("fa-eye");
                }
            });
            // Toggle confirm password
            $("#toggle_confirm_password").click(function() {
                var _confirm_password = $("#confirm_password");
                var type_cpw = _confirm_password.attr("type");
                var icon = $(this).find("i");

                if (type_cpw === "password") {
                    _confirm_password.attr("type", "text");
                    icon.removeClass("fa-eye").addClass("fa-eye-slash");
                } else {
                    _confirm_password.attr("type", "password");
                    icon.removeClass("fa-eye-slash").addClass("fa-eye");
                }
            });
            // Onsubmit
            $("#form_register").submit(function() {
                var _username = $("#new_username").val();
                var _new_password =  $("#new_password").val();
                var _confirm_password = $("#confirm_password").val();

                if(_username == "" || _username.length == 0) { 
                    $("#username_error").text("Please enter your new username.");
                    return false;
                }
                else if (_new_password == "" || _new_password.length == 0) {
                    $("#new_password_error").text("Please enter your new password.");
                    return false;
                }
                else if (_confirm_password != _new_password) {
                    $("#confirm_password_error").text("Confirm password does not match");
                    return false;
                }
                else {
                    $.ajax({
                        type: "POST",
                        url: "process_register.php",
                        data: { 
                            name: _username,
                            password: _new_password,
                        },
                        cache: false,
                        success: function(result) {
                            if(result.message == 1) {
                                alert("Succesful");
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
                return false;
            })
        });
    </script>
</body>
</html>