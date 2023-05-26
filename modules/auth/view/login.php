<?php
    require_once(dirname(__FILE__) . '../../../../utils/start-session.php');

    \utils\startSession();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/styles/pages/login.css">
    <title>Login</title>
</head>
<body>
    <main class="container">
        <h1 class="title">Login</h1>

        <div class="form-container">
            <form action="../controller/auth-controller.php?action=login" method="post" class="form">
                <div class="form-group">
                    <label for="email" class="form-label">Email: </label>
                    <input type="email" name="email" id="email" class="form-input">
                </div>
    
                <?php if(isset($_SESSION['auth']['errors']['login'])) : ?>
                    <div class="form-error">
                        <?=$_SESSION['auth']['errors']['login'] ?>
                    </div>
                <?php endif; ?>
    
                <div class="form-group">
                    <label for="password" class="form-label">Password: </label>
                    <input type="password" name="password" id="password" class="form-input">
                </div>
    
                <?php if(isset($_SESSION['auth']['errors']['password'])) : ?>
                    <div class="form-error">
                        <?=$_SESSION['auth']['errors']['password'] ?>
                    </div>
                <?php endif; ?>
    
                <button class="form-submit">login</button>
            </form>
    
            <?php if(isset($_SESSION['auth']['errors']['catch'])) : ?>
                <div class="form-error">
                    <?=$_SESSION['auth']['errors']['catch'] ?>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>