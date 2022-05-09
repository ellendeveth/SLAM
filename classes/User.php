<?php
    class User
    {
        private $name;
        private $email;
        private $password;
        private $confirm;
        private $school;
        private $education;
        

        /**
         * Get the value of name
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */
        public function setName($name)
        {
            $this->name = $name;

            return $this;
        }

        /**
         * Get the value of email
         */
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */
        public function setEmail($email)
        {
            $this->email = $email;

            return $this;
        }

        /**
         * Get the value of password
         */
        public function getPassword()
        {
            return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */
        public function setPassword($password)
        {
            if (strlen($password) < 6) {
                throw new Exception("Password must be at least 6 characters long");
            }
            $this->password = $password;

            return $this;
        }

        /**
         * Get the value of confirm
         */
        public function getConfirm()
        {
            return $this->confirm;
        }

        /**
         * Set the value of confirm
         *
         * @return  self
         */
        public function setConfirm($confirm)
        {
            $this->confirm = $confirm;

            return $this;
        }

        /**
         * Get the value of school
         */
        public function getSchool()
        {
            return $this->school;
        }

        /**
         * Set the value of school
         *
         * @return  self
         */
        public function setSchool($school)
        {
            $this->school = $school;

            return $this;
        }

        /**
         * Get the value of education
         */
        public function getEducation()
        {
            return $this->education;
        }

        /**
         * Set the value of education
         *
         * @return  self
         */
        public function setEducation($education)
        {
            $this->education = $education;

            return $this;
        }

        public function register()
        {
            $options = [
                'cost' => 12,
            ];
            $password = password_hash($this->password, PASSWORD_BCRYPT, $options);
            //check password and confirm password
            if ($this->password != $this->confirm) {
                throw new Exception("Passwords do not match");
            }
            $conn = Db::getInstance();
            $statement = $conn->prepare("INSERT INTO users (name, email, password, school, education) VALUES (:name, :email, :password, :school, :education)");
            $statement->bindValue(':name', $this->name);
            $statement->bindValue(':email', $this->email);
            $statement->bindValue(':password', $password);
            $statement->bindValue(':school', $this->school);
            $statement->bindValue(':education', $this->education);
            return $statement->execute();
        }

        public function canLogin()
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare("select * from users where email = :email");
            $statement->bindValue(":email", $this->email);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $hash = $user['password'];
                if (password_verify($this->password, $hash)) {
                    return true;
                } else {
                    throw new Exception("Incorrect password. Try again.");
                }
            } else {
                throw new Exception("User does not exist.");
            }
        }
    }
