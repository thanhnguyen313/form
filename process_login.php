<?php
    $name = htmlspecialchars($_POST['name'] ?? '');
    $password = htmlspecialchars($_POST['password'] ?? '');
    echo "$name <br>";
    echo "$password <br>";
    
    $json = file_get_contents("user.json");
    $users = json_decode($json, true);

    $found = false;
    foreach($users as $user) {
        if($user['name'] === $name && $user['password'] === $password) {
            $found = true;
            break;
        }
    }
    if($found)
        echo "Dang nhap thanh cong! ";
    else { 
        echo "Sai tai khoan hoac mat khau! ";
    }

?>