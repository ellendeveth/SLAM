<?php

    class Competence
    {
        private $postId;
        private $competence;
        

        /**
         * Get the value of postId
         */
        public function getPostId()
        {
            return $this->postId;
        }

        /**
         * Set the value of postId
         *
         * @return  self
         */
        public function setPostId($postId)
        {
            $this->postId = $postId;

            return $this;
        }

        /**
         * Get the value of competence
         */
        public function getCompetence()
        {
            return $this->competence;
        }

        /**
         * Set the value of competence
         *
         * @return  self
         */
        public function setCompetence($competence)
        {
            $this->competence = $competence;

            return $this;
        }

        public function uploadCompetences()
        {
            $competences = $this->getCompetence();
            $competences = explode(" ", $competences);

            $conn = Db::getInstance();
            $statement = $conn->prepare("INSERT INTO competences (post_id, name) VALUES (:post_id, :competence)");

            for ($i=0; $i<count($competences); $i++) {
                $statement->bindValue(":competence", $competences[$i]);
                $statement->bindValue(":post_id", $this->postId);
                $result = $statement->execute();
            }
    
            unset($tags);
            return $result;
        }

        public static function getCompetences($postId)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM competences WHERE post_id=:post_id");
            $statement->bindValue(":post_id", $postId);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }

        public static function getCompetencesForDashboard($postId)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM competences WHERE post_id=:post_id LIMIT 3");
            $statement->bindValue(":post_id", $postId);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }

        public static function deleteCompetences($id)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare("DELETE FROM competences WHERE user_id=:id");
            $statement->bindValue(":id", $id);
            $result = $statement->execute();
            return $result;
        }
    }
