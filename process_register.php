<?php
    header('Content-Type: application/json');

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
    // Check password strength
    $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
    if(!preg_match($passwordPattern, $password)) {
        echo json_encode([
            'message' => -3,
            'error' => 'Weak password. It must be at least 8 characters long and include uppercase, lowercase, numbers, and special characters.'                    
        ]);
        exit;
    }
    // Check if username already exists
    $file = __DIR__ . "/user.json";
    if(!file_exists($file)) {
        file_put_contents($file, json_encode([]));
    }

    $userList = json_decode(file_get_contents($file), true);
    
    // Check for duplicate username
    foreach ($userList as $user) {
        if($user['name'] === $name) {
            echo json_encode([
                'message' => 0,
                'error' => 'Username already exists.'
            ]);
            exit;
        }
    }
    // Add new user to JSON
    $newUser = [
        'name' => $name,
        'password' => $password
    ];
    $userList[] = $newUser;
    file_put_contents($file, json_encode($userList, JSON_PRETTY_PRINT));

    echo json_encode([
        'message' => 1,
        'success' => 'login.php'
    ]);

?>