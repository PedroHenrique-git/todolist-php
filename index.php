<?php
    require_once 'utils/start-session.php';

    \utils\startSession();

    $isLoggedIn = $_SESSION['user_id'] && $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/styles/pages/index.css">
    <title>Todo list app</title>
</head>
<body>
    <header class="header">
        <div class="header__title">
            <h1>Todo list app</h1>
        </div>
    </header>
    
    <?php if(!$isLoggedIn) : ?>
        <nav class="nav">
            <ul class="nav__list">
                <li class="nav__list--item">
                    <a href='./modules/user/view/create-account.php'>create account</a>
                </li>
                <li class="nav__list--item">
                    <a href='./modules/auth/view/login.php'>login</a>
                </li>
            </ul>
        </nav>
    <?php endif; ?>
    
    <?php if($isLoggedIn) : ?>
        <nav class="nav">
            <ul class="nav__list">
                <li class="nav__list--item">
                    <a href='./modules/task/view/show-tasks.php'>see your tasks</a>
                </li>
                <li class="nav__list--item">
                    <a href='./modules/auth/controller/auth-controller.php?action=logout'>logout</a>
                </li>
            </ul>
        </nav>
    <?php endif; ?>
</body>
</html>