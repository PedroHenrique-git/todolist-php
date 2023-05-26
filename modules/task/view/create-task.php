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
    <title>Create task</title>
</head>
<body>
    <main>
        <h1>Create a new task</h1>

        <form action="../controller/task-controller.php?action=create" method="post">
            <div>
                <label for="task">Task: </label>
                <input type="text" name="task" id="task">
            </div>

            <?php if(isset($_SESSION['create-task']['errors']['task'])) : ?>
                <div>
                    <?=$_SESSION['create-account']['errors']['task'] ?>
                </div>
            <?php endif; ?>

            <div>
                <label for="password">Finish: </label>
                <select name="finish" id="finish">
                    <option value="yes">yes</option>
                    <option value="no" selected>no</option>
                </select>
            </div>

            <button>create task</button>
        </form>

        <?php if(isset($_SESSION['create-task']['errors']['catch'])) : ?>
            <div>
                <?=$_SESSION['create-task']['errors']['catch'] ?>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>