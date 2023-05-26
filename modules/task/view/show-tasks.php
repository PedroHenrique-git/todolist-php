<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User tasks</title>
</head>
<body>
    <?php 
        require_once(dirname(__FILE__) . '../../repository/relational-db/task-repository-relational-db.php');
        require_once(dirname(__FILE__) . '../../../../db/connection.php');
        require_once(dirname(__FILE__) . '../../repository/relational-db/task-repository-relational-db.php');

        $pdo = \db\Connection::getInstance();
        $repository = new TaskRepositoryRelationalDb($pdo);

        session_start();
        
        $tasks = $repository->show($_SESSION['user_id']);
    ?>
    <ul>
        <?php foreach($tasks as $task) : ?>
            <li>
                <div><?=$task['task'] ?></div>
                <div><?=$task['finish'] ?></div>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>