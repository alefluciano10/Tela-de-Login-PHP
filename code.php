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
           $username = $_POST['username'] ?? '';
           $password = $_POST['password'] ?? '';
           $token    = $_POST['token'] ?? '';

           $correctUsername = "admin";
           $correctPassword = "password123";
           $correctToken    = "PROGRAMMING";

           $message = '';
           $status = '';

           if ($_SERVER['REQUEST_METHOD'] === 'POST') {
               if (($username === $correctUsername && $password === $correctPassword) ||
                   ($username === $correctUsername && $token === $correctToken)) {
                   $message = "✅ Access granted. Welcome, $username!";
                   $status = "success";
               } else {
                   $message = "⛔ Access denied. Please check your credentials or token.";
                   $status = "error";
               }
           }
       ?>

       <?php if($message): ?>
           <div class="message <?php echo $status; ?>"><?php echo $message; ?></div>
       <?php endif; ?>

       <div class="form-group <?php echo $status; ?>">
           <input type="text" id="username" name="username" placeholder="Username" required value="<?php echo htmlspecialchars($username); ?>">
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
