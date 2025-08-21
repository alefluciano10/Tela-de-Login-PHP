<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dev Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
   <form method="POST">
       <h1>Developer Login</h1>

       <?php

              // Initialize variables
           $username = trim(htmlspecialchars($_POST['username'] ?? ''));
           $password = trim($_POST['password'] ?? '');
           $token = trim($_POST['token'] ?? '');

              // Define correct credentials
           $correctUsername = "admin";
           $correctPasswordHash = password_hash("password123", PASSWORD_DEFAULT);
           $correctToken    = "PROGRAMMING";

           $message = '';
           $status = '';

           if ($_SERVER['REQUEST_METHOD'] === 'POST') {
              // --- LOGIN VIA TOKEN ---
             if (!empty($token) && empty($username) && empty($password)) {
                 if (hash_equals($correctToken, $token)) {
                     $message = "✅ Access granted via token. Welcome to the system!";
                     $status  = "success";
                     session_start();
                     session_regenerate_id(true);
                     $_SESSION['auth'] = 'token';
            } else {
                $message = "⛔ Invalid token.";
                $status  = "error";
           }

             // --- LOGIN VIA USERNAME + PASSWORD ---
           } elseif (!empty($username) && !empty($password) && empty($token)) {
             if ($username === $correctUsername && password_verify($password, $correctPasswordHash)) {
                 $message = "✅ Access granted. Welcome, {$username}!";
                 $status  = "success";
                 session_start();
                 session_regenerate_id(true);
                 $_SESSION['auth'] = 'user';
           } else {
               $message = "⛔ Invalid username or password.";
               $status  = "error";
           }

            // --- INVALID INPUT ---
           } else {
               $message = "⚠️ Please enter your credentials or your token.";
               $status  = "warning";
           }
    }
            // --- END OF LOGIN LOGIC ---
       ?>

       <?php if($message): ?>
           <div class="message <?php echo $status; ?>"><?php echo $message; ?></div>
       <?php endif; ?>

       <div class="form-group <?php echo $status; ?>">
           <input type="text" id="username" name="username" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>">
           <i class='bx bxs-user'></i>
       </div>

       <div class="form-group <?php echo $status; ?>">
           <input type="password" id="password" name="password" placeholder="Password">
           <i class='bx bxs-lock'></i>
       </div>

       <div class="form-group <?php echo $status; ?>">
           <input type="text" id="token" name="token" placeholder="Token">
           <i class='bx bxs-key'></i>
       </div>

       <div class="check">
           <label>
               <input type="checkbox">
               Remember Password
           </label>
           <a href="#">Forgot Password?</a>
       </div>

       <button type="submit" class="submit">Login</button>

       <div class="register">
           <p>Don't have an account? <a href="#">Register</a></p>
       </div>
   </form>
</div>

</body>
</html>
