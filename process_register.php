<?php
    $name = strtolower(htmlspecialchars($_POST['name'] ?? ''));
    $password = strtolower(htmlspecialchars($_POST['new_password'] ?? ''));
    echo "$name <br>";
    echo "$password <br>";

    $file = __DIR__ . "/user.json";

    function check_username($name) {
        $users = json_decode(file_get_contents('user.json'), true);
        foreach($users as $user) {
            if($name === $user['name']) {
                echo "exists";
                return;
            }
        }
        echo "ok";
    }
    if($_GET['action'] ?? '' === 'check') {
        $name = strtolower(htmlspecialchars($_GET['username'] ?? ''));
        check_username($name);
        exit;
    }

    if (file_exists($file) && filesize($file) > 0) {
        $json = file_get_contents($file);
        $users = json_decode($json, true);
        if (!is_array($users)) {
            $users = [];
        }
    } else {
        $users = []; 
    }

    $user = [
        'name' => $name,
        'password' => $password
    ];

    $users[] = $user;

    $jsonData = json_encode($users, JSON_PRETTY_PRINT);

    $result = file_put_contents($file, $jsonData);

?>