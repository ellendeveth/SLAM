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
        private $profilePicture;
        

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

        /**
         * Get the value of profilePicture
         */
        public function getProfilePicture()
        {
            return $this->profilePicture;
        }

        /**
         * Set the value of profilePicture
         *
         * @return  self
         */
        public function setProfilePicture($profilePicture)
        {
            $this->profilePicture = $profilePicture;

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
            $statement = $conn->prepare("INSERT INTO users (name, last_name, email, password, school, education, is_student) VALUES (:name, :lastname, :email, :password, :school, :education, :student)");
            $statement->bindValue(':name', $this->firstname);
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
            $statement = $conn->prepare("INSERT INTO users (name, description_vzw, email, password, is_student) VALUES (:name, :description, :email, :password, :student)");
            $statement->bindValue(':name', $this->firstname);
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
            $statement = $conn->prepare("UPDATE users SET name = :name, last_name = :lastname, school = :school, education = :education WHERE id = :id");
            $statement->bindValue(':name', $this->firstname);
            $statement->bindValue(':lastname', $this->lastname);
            $statement->bindValue(':school', $this->school);
            $statement->bindValue(':education', $this->education);
            $statement->bindValue(':id', $this->id);
            return $statement->execute();
        }

        public function updateOrganisationProfile()
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare("UPDATE users SET name = :name, description_vzw = :description WHERE id = :id");
            $statement->bindValue(':name', $this->firstname);
            $statement->bindValue(':description', $this->description);
            $statement->bindValue(':id', $this->id);
            return $statement->execute();
        }

        public static function checkPassword($id, $password)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare("select * from users where id = :id");
            $statement->bindValue(":id", $id);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                $hash = $user['password'];
                if (password_verify($password, $hash)) {
                    return true;
                } else {
                    throw new Exception('Current password is wrong. Please try again.');
                }
            } else {
                throw new Exception("User does not exist.");
            }
        }

        public function updatePassword()
        {
            $options = [
                'cost' => 12,
            ];
            $password = password_hash($this->password, PASSWORD_BCRYPT, $options);
            $conn = Db::getInstance();
            $statement = $conn->prepare("UPDATE users SET password = :password WHERE id = :id");
            $statement->bindValue(':password', $password);
            $statement->bindValue(':id', $this->id);
            return $statement->execute();
        }

        public function deleteAccount()
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare("DELETE FROM users WHERE id = :id");
            $statement->bindValue(':id', $this->id);
            return $statement->execute();
        }

        public function updatePictureInDatabase($profilePicture, $id)
        {
            $conn = Db::getInstance();
            $statement = $conn->prepare("UPDATE users SET profile_pic = :profilePicture WHERE id = :id");
            $statement->bindValue(":profilePicture", $profilePicture);
            $statement->bindValue(":id", $id);
            $statement->execute();
        }


        public function canUploadPicture($sessionId)
        {
            $fileName = $_FILES['picture']['name'];
            $fileTmpName = $_FILES['picture']['tmp_name'];
            $fileSize = $_FILES['picture']['size'];
            
            $fileTarget = 'profile_pictures/' . basename($fileName);
            $fileExtention = strtolower(pathinfo($fileTarget, PATHINFO_EXTENSION));
            
            $fileIsImage = getimagesize($fileTmpName);

            // Check if file is an image
            if ($fileIsImage !== false) {
                $canUpload = true;
            } else {
                $canUpload = false;
                throw new Exception("Your uploaded file is not an image.");
            }

            // Check if file already exists
            if (file_exists($fileTarget)) {
                $canUpload = true;
            }

            // Check if file-size is under 2MB
            if ($fileSize > 2097152) { // 2097152 bytes
                $canUpload = false;
                throw new Exception('Image size can not be larger than 2MB, try again.');
            }

            // Check if format is JPG, JPEG or PNG
            if ($fileExtention != 'jpg' && $fileExtention != 'jpeg' && $fileExtention != 'png' && !empty($fileName)) {
                $canUpload = false;
                throw new Exception("This filetype is not supported. Upload a jpg or png.");
            }

            // Upload file when no errors
            if ($canUpload) {
                if (move_uploaded_file($fileTmpName, $fileTarget)) {
                    $profilePicture = basename($fileName);
                    $this->setProfilePicture($profilePicture);
                    $this->updatePictureInDatabase($profilePicture, $sessionId);
                }
            }
        }
    }
