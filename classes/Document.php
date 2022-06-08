<?php
    class Document {
        private $projectId;
        private $github;
        private $figma;
        private $trello;
        private $word;

        /**
         * Get the value of projectId
         */ 
        public function getProjectId()
        {
                return $this->projectId;
        }

        /**
         * Set the value of projectId
         *
         * @return  self
         */ 
        public function setProjectId($projectId)
        {
                $this->projectId = $projectId;

                return $this;
        }

        /**
         * Get the value of github
         */ 
        public function getGithub()
        {
                return $this->github;
        }

        /**
         * Set the value of github
         *
         * @return  self
         */ 
        public function setGithub($github)
        {
                $this->github = $github;

                return $this;
        }

        /**
         * Get the value of figma
         */ 
        public function getFigma()
        {
                return $this->figma;
        }

        /**
         * Set the value of figma
         *
         * @return  self
         */ 
        public function setFigma($figma)
        {
                $this->figma = $figma;

                return $this;
        }

        /**
         * Get the value of trello
         */ 
        public function getTrello()
        {
                return $this->trello;
        }

        /**
         * Set the value of trello
         *
         * @return  self
         */ 
        public function setTrello($trello)
        {
                $this->trello = $trello;

                return $this;
        }

        /**
         * Get the value of word
         */ 
        public function getWord()
        {
                return $this->word;
        }

        /**
         * Set the value of word
         *
         * @return  self
         */ 
        public function setWord($word)
        {
                $this->word = $word;

                return $this;
        }

        public function addDocument(){
            $conn = Db::getInstance();
            $statement = $conn->prepare('UPDATE posts SET doc_github = :github, doc_figma = :figma, doc_trello = :trello, doc_word = :word WHERE id = :project_id');
            $statement->bindValue(':project_id', $this->projectId);
            $statement->bindValue(':github', $this->github);
            $statement->bindValue(':figma', $this->figma);
            $statement->bindValue(':trello', $this->trello);
            $statement->bindValue(':word', $this->word);
            $statement->execute();
        }
    }