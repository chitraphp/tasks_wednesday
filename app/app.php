<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Task.php";

    session_start();

    if(empty($_SESSION['list_of_tasks'])){
        $_SESSION['list_of_tasks'] = array();

    }

    $app = new Silex\Application();

    $app->get("/", function(){
        // $test_task = new Task("learn php");
        // $second_task = new Task("learn javascript");
        // $third_task = new Task("learn drupal");
        //
        // $list_of_tasks = array($test_task, $second_task, $third_task);

        $output = "";

        // foreach($list_of_tasks as $task){
        //     $output = $output . "<p>" .$task->getDescription() . "</p>";
        //
        // }

        foreach(Task::getAll() as $task){
            $output = $output . "<p>" .$task->getDescription( ) . "</p>";
        }

        $output = $output . "</ul>

            <form action ='/tasks' method = 'post'>
            <label for = 'description'>Task description </label>
            <input id = 'description' name = 'description' type = 'text'>

            <button type ='submit'>Add Task</button>
            </form>

        ";

        $output .= "
            <form action='/delete_tasks' method = 'post'>
            <button type='submit'>Clear</button>
            </form>
        ";

        return $output;

    });


    $app->post("/tasks", function(){
        $task = new Task($_POST['description']);
        $task->save();
        return "
            <h1>You created a task!</h1>
            <p>" . $task->getDescription() . "</p>
            <p> <a href='/'> view your list of tasks. </a></p>
        ";

    });

     $app->post("/delete_tasks", function(){

         Task::deleteAll();
         return "
                <h1>List clearned!</h1>
                <p><a href ='/'>Home</a></p>

                ";

     });

    return $app;

?>
