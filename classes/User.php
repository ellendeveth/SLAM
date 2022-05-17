<?php
    class User
    {
        private $firstname;
        private $lastname;
        private $email;
        private $password;
        private $confirm;
        private $school;
        private $education;
        private $student;
        private $id;
        private $description;
        

        /**
         * Get the value of name
         */
        public function getFirstname()
        {
            return $this->firstname;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */
        public function setFirstname($firstname)
        {
            $this->firstname = $firstname;

            return $this;
        }

        public function getLastname()
        {
            return $this->lastname;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */
        public function setLastname($lastname)
        {
            $this->lastname = $lastname;

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
        /**
        * Get the value of student
        */
        public function getStudent()
        {
            return $this->student;
        }

        /**
         * Set the value of student
         *
         * @return  self
         */
        public function setStudent($student)
        {
            $this->student = $student;

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
        
        public function registerStudent()
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
            $statement = $conn->prepare("INSERT INTO users (name, lastname, email, password, school, education, is_student) VALUES (:name, :lastname, :email, :password, :school, :education, :student)");
            $statement->bindValue(':name', $this->name);
            $statement->bindValue(':lastname', $this->lastname);
            $statement->bindValue(':email', $this->email);
            $statement->bindValue(':password', $password);
            $statement->bindValue(':school', $this->school);
            $statement->bindValue(':education', $this->education);
            $statement->bindValue(':student', $this->student);
            return $statement->execute();
        }
        public function registerOrganisation()
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
            $statement = $conn->prepare("INSERT INTO users (name, description, email, password, is_student) VALUES (:name, :description, :email, :password, :student)");
            $statement->bindValue(':name', $this->name);
            $statement->bindValue(':description', $this->description);
            $statement->bindValue(':email', $this->email);
            $statement->bindValue(':password', $password);
            $statement->bindValue(':student', $this->student);
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

        public static function getIdByEmail($email)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare("select id from users where email = :email");
            $statement->bindValue(":email", $email);
            $statement->execute();
            $result = $statement->fetch();
            return $result['id'];
        }

        public static function getStudentById($id)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * from users WHERE id = :id AND is_student = 1 ");
            $statement->bindValue(":id", $id);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return true;
            } else {
                return false;
            }
        }

        public static function getUserDataFromId($id)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM users WHERE id = :id");
            $statement->bindValue(':id', $id);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        public function updateStudentProfile()
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare("UPDATE users SET name = :name, lastname = :lastname, school = :school, education = :education WHERE id = :id");
            $statement->bindValue(':name', $this->name);
            $statement->bindValue(':lastname', $this->lastname);
            $statement->bindValue(':email', $this->email);
            $statement->bindValue(':school', $this->school);
            $statement->bindValue(':education', $this->education);
            $statement->bindValue(':id', $this->id);
            return $statement->execute();
        }

        public function updateOrganisationProfile()
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare("UPDATE users SET name = :name, description = :description WHERE id = :id");
            $statement->bindValue(':name', $this->name);
            $statement->bindValue(':description', $this->description);
            $statement->bindValue(':id', $this->id);
            return $statement->execute();
        }
    }
