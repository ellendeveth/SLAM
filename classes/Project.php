<?php
    class Project
    {
        private $title;
        private $description;
        private $user_id;

        /**
         * Get the value of title
         */
        public function getTitle()
        {
            return $this->title;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */
        public function setTitle($title)
        {
            $this->title = $title;

            return $this;
        }

        /**
         * Get the value of description
         */
        public function getDescription()
        {
            return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */
        public function setDescription($description)
        {
            $this->description = $description;

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

        public function uploadProject()
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('INSERT INTO posts (title, description, date, user_id) VALUES (:title, :description, now() ,:user_id)');
            $statement->bindValue(':title', $this->title);
            $statement->bindValue(':description', $this->description);
            $statement->bindValue(':user_id', $this->user_id);
            return $statement->execute();
        }

        public static function getAllProjects()
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('SELECT * FROM posts INNER JOIN users ON posts.user_id = users.id');
            $statement->execute();
            return $statement->fetchAll();
        }
    }
