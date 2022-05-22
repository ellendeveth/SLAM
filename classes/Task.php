<?php

    class Task
    {
        private $task;
        private $post_id;
        private $user_id;

        /**
         * Get the value of task
         */
        public function getTask()
        {
            return $this->task;
        }

        /**
         * Set the value of task
         *
         * @return  self
         */
        public function setTask($task)
        {
            $this->task = $task;

            return $this;
        }

        /**
         * Get the value of post_id
         */
        public function getPost_id()
        {
            return $this->post_id;
        }

        /**
         * Set the value of post_id
         *
         * @return  self
         */
        public function setPost_id($post_id)
        {
            $this->post_id = $post_id;

            return $this;
        }

        /**
         * Get the value of user_id
         */
        public function getUser_id()
        {
            return $this->user_id;
        }

        /**
         * Set the value of user_id
         *
         * @return  self
         */
        public function setUser_id($user_id)
        {
            $this->user_id = $user_id;

            return $this;
        }

        public function addTask()
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('INSERT INTO tasks (task, post_id, user_id) VALUES (:task, :post_id, :user_id)');
            $statement->bindValue(':task', $this->task);
            $statement->bindValue(':post_id', $this->post_id);
            $statement->bindValue(':user_id', $this->user_id);
            return $statement->execute();
        }

        public static function getTasks($id)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('SELECT * FROM tasks INNER JOIN users on users.id = tasks.user_id WHERE post_id = :post_id');
            $statement->bindValue(':post_id', $id);
            $statement->execute();
            return $statement->fetchAll();
        }

        public static function deleteTasks($id)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('DELETE FROM tasks WHERE user_id = :id');
            $statement->bindValue(':id', $id);
            return $statement->execute();
        }
    }
