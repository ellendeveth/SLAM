<?php
    class Project
    {
        private $title;
        private $description;
        private $user_id;
        private $id;

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

        /**
         * Get the value of id
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */
        public function setId($id)
        {
            $this->id = $id;

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

        public static function getProjectById($id)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('SELECT * FROM posts INNER JOIN users ON posts.user_id = users.id WHERE posts.id = :id');
            $statement->bindValue(':id', $id);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        public static function getMembersByProject($id)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('SELECT * from team INNER JOIN users on team.user_id = users.id WHERE post_id = :id');
            $statement->bindValue(':id', $id);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getMyProjects($id)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('SELECT * FROM team INNER JOIN users ON team.user_id = users.id INNER JOIN posts ON team.post_id = posts.id WHERE team.user_id = :id');
            $statement->bindValue(':id', $id);
            $statement->execute();
            $projects =  $statement->fetchAll(PDO::FETCH_ASSOC);
            if (empty($projects)) {
                throw new Exception('Je zit momenteel nog niet in een project');
            }
            return $projects;
        }


        public function addMember()
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('INSERT INTO team (user_id, post_id) VALUES (:user_id, :post_id)');
            $statement->bindValue(':user_id', $this->user_id);
            $statement->bindValue(':post_id', $this->id);
            return $statement->execute();
        }

        public static function getOrganisationOfProject($id)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare('SELECT * FROM posts INNER JOIN users ON posts.user_id = users.id WHERE posts.id = :id');
            $statement->bindValue(':id', $id);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
    }
