<!doctype html>
<?php 
session_start();

//____session delete___//
if (isset($_GET['session'])) 
    {
        if ($_GET['session'] === 'destroy') 
        {
            session_destroy();
            header('Location: index.php');
        }
    }

//___variables___//
$todoList = isset($_SESSION['todoList'])?$_SESSION['todoList']:'';
$doneList = isset($_SESSION['doneList'])?$_SESSION['doneList']:'';

if (!empty($todoList) || !empty($doneList)) {
    $todoOrDoneEmpty = true;
}

if(isset($_POST['submit']))
{
    if (!empty($_POST['job'])) {
        $_SESSION['todoList'][] = $_POST['job'];
        header('Location: index.php');
    }
    else{
        $warning = true;
    }  
}

elseif ( isset($_POST['done'])) 
{
    unset($_SESSION['todoList'][array_search($_POST['done'], $todoList)]);
    $_SESSION['doneList'][] = $_POST['done'];
    header('Location: index.php');
}

elseif ( isset($_POST['todo']) ) 
{
    unset($_SESSION['doneList'][array_search($_POST['todo'], $doneList)]);
    $_SESSION['todoList'][] = $_POST['todo'];
    header('Location: index.php');
}

elseif ( isset($_POST['deleteTodo']) ) 
{
    unset($_SESSION['todoList'][array_search($_POST['deleteTodo'], $todoList)]);
    header('Location: index.php');
}

elseif ( isset($_POST['deleteDone']) ) 
{
    unset($_SESSION['doneList'][array_search($_POST['deleteDone'], $doneList)]);
    header('Location: index.php');    
}

if(empty($todoList) && empty($doneList))
    $message = "Je hebt nog geen TODO's toegevoegd. Zo weinig werk of meesterplanner?";

elseif(empty($todoList))
    $message = "Schouderklopje, alles is gedaan!";

?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Todo App</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
<body>
<div class="container">
<div class="wrapper">
    <section>
        <h1>ToDo App</h1>
        <?php if ($warning): ?>
        <div class="warning">Ahh, damn. Lege todos zijn niet toegestaan...</div>
        <?php endif ?>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">

        <!--TODO LIST-->
        <?php if ($todoOrDoneEmpty): ?>
            <h3>Nog te doen</h3>
            <?php if (empty($todoList)): ?>
                 <p><?=$message ?></p>
            <?php endif ?>
            <ul>
                <?php foreach ($todoList as $job): ?>
                    <li>
                    <span class='todoLi'>
                        <button class="done" id="done" type="hidden" name="done" value="<?=$job ?>"></button>
                        <span class="todoTxt"><?=$job ?></span>
                    </span> 
                        <button class="delete" id="deleteTodo" type="submit" name="deleteTodo" value="<?=$job ?>">x</button>
                    </li>
                <?php endforeach ?>
            </ul>
        
        <?php else: ?>
            <p><?=$message ?></p>
        <?php endif ?>
        <!--end of TODO LIST-->
    
    <?php if ($todoOrDoneEmpty): ?>
            <h3>Done and done!</h3>
            <?php if (empty($doneList)): ?>
                <p>Werk aan de winkel</p>
            <?php endif ?>
            <!--DONE LIST-->
            <ul>
                <?php foreach ($doneList as $job): ?>
                    <li>
                    <span class='doneLi'>
                        <button class="todo" id="todo" type="hidden" name="todo" value="<?=$job ?>"> </button>
                        <span class="doneTxt"><?=$job ?></span>
                    </span>
                        <button class="delete" id="deleteDone" type="submit" name="deleteDone" value="<?=$job ?>">x</button>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
        </form>
        <!--end of DONE LIST-->
        
        <!--TOEVOEGEN-->
        <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <h2>Todo toevoegen</h2>
            <p>Beschrijving: <input id="job" type="text" name="job" value="" /></p>
            <button class="addItem" id="submit" type="submit" name="submit">Toevoegen</button>
        </form>
        <!--end of TOEVOEGEN-->
            
        <p><a href="?session=destroy">begin opnieuw</a></p>
        
        <!--Debugging-->
        <!--<h2>dump van de $_SESSION-array (voor debugging)</h2>
        <pre><?php var_dump($_SESSION) ?></pre> -->
        <!--end of Debugging-->
    </section>
</div>
</div>
    <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
</body>
</html>