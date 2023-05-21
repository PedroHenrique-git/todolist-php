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
    <title>Create account</title>
</head>
<body>
    <main>
        <h1>Create your account</h1>

        <form action="../controller/user-controller.php?action=create" method="post">
            <div>
                <label for="email">Email: </label>
                <input type="email" name="email" id="email">
            </div>

            <?php if(isset($_SESSION['create-account']['errors']['email'])) : ?>
                <div>
                    <?=$_SESSION['create-account']['errors']['email'] ?>
                </div>
            <?php endif; ?>

            <div>
                <label for="password">Password: </label>
                <input type="password" name="password" id="password">
            </div>

            <?php if(isset($_SESSION['create-account']['errors']['password'])) : ?>
                <div>
                    <?=$_SESSION['create-account']['errors']['password'] ?>
                </div>
            <?php endif; ?>

            <button>create account</button>
        </form>

        <?php if(isset($_SESSION['create-account']['errors']['catch'])) : ?>
            <div>
                <?=$_SESSION['create-account']['errors']['catch'] ?>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>