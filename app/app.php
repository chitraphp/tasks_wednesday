<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Task.php";

    $app = new Silex\Application();

    $app->get("/", function(){
        $test_task = new Task("learn php");
        $second_task = new Task("learn javascript");
        $third_task = new Task("learn drupal");

        $list_of_tasks = array($test_task, $second_task, $third_task);

        $output = "";

        foreach($list_of_tasks as $task){
            $output = $output . "<p>" .$task->getDescription() . "</p>";

        }

        return $output;

    });

    return $app;

?>
