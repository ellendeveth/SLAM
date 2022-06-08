<?php
require_once('../bootstrap.php');

    if (!empty($_POST)) {
        $task = $_POST['task'];
        $postid = $_POST['postid'];
        $userid = $_POST['userid'];

        try {
            $t = new Task();
            $t->setTask($task);
            $t->setPost_id($postid);
            $t->setUser_id($userid);
            $t->save();

            // success
            $result = [
                "status" => "success",
                "message" => "task was saved.",
                "data" => [
                    "task" => htmlspecialchars($task)
                ]
            ];
        } catch (Throwable $t) {
            // error
            $result = [
                "status" => "error",
                "message" => "Something went wrong."
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($result);
    }
