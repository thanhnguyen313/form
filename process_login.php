<?php
    $name = htmlspecialchars($_POST['name'] ?? '');
    $password = htmlspecialchars($_POST['password'] ?? '');
    // Check username
    if(!preg_match('/^[a-zA-Z0-9_]+$/', $name)) {
        echo json_encode([
            'message' => -2,
            'error' => 'Invalid username. Only letters, numbers, and underscores are allowed.'
        ]);
        exit;
    }
    $file = __DIR__ . "/user.json";
    if(!file_exists($file)) {
        file_put_contents($file, json_encode([]));
    }
    $found = false;
    $userList = json_decode(file_get_contents($file), true);
    foreach ($userList as $user) {
        if($user['name'] === $name && $user['password'] === $password) {
            echo json_encode([
                'message' => 1,
                'success' => 'success.php'
            ]);
            $found = true; 
            break;
        }
    }
    if(!$found) {
        echo json_encode([
            'message' => 0,
            'error' => 'Incorrect password or account does not exist.'
        ]);
    }
?>