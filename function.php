<?php

    Class crudApp{
        private $conn;

        public function __construct(){
            #database host, database username, database password, database name

            $dbhost = 'localhost';
            $dbuser = 'root';
            $dbpass = '';
            $dbname = 'crudapp';

            $this->conn=mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

            if (!$this->conn) {
                die("Database Connection Error");
            }
        }

        public function addData($data){
            $std_name = $data['std_name'];
            $std_roll = $data['std_roll'];
            $std_img = $_FILES['std_image']['name'];
            $tmp_name = $_FILES['std_image']['tmp_name'];

            $query = "INSERT INTO students(std_name, std_roll, std_image) VALUES('$std_name', $std_roll, '$std_img')";
            if (mysqli_query($this->conn, $query)) {
                move_uploaded_file($tmp_name, 'upload_img/' . $std_img);
                return "Information Added Successfully";
            }
        }

        public function displayData(){
            $query = "SELECT * from students";

            if (mysqli_query($this->conn, $query)) {
                $returnData = mysqli_query($this->conn, $query);

                return $returnData;
            }
        }

        public function displayDataById($id){
            $query = "SELECT * from students where std_id = $id";

            if (mysqli_query($this->conn, $query)) {
                $returnData = mysqli_query($this->conn, $query);

                $studentData= mysqli_fetch_assoc($returnData);
                return $studentData;
            }
        }

        public function updateData($data){

                // $datas = $_GET['id'];

                // $catch_img = "SELECT * from students where std_id = $datas";
                // $deleteImg = mysqli_query($this->conn, $catch_img);
                // $img_info = mysqli_fetch_assoc($deleteImg);
                // unlink('upload_img/'.$img_info['std_image']);

                
                if (empty($_FILES['u_std_image']['name'])) {
                    $std_img = $data['old-image'];

                    $std_id = $data['u_id'];
                    $std_name = $data['u_std_name'];
                    $std_roll = $data['u_std_roll'];
                    $std_img = $_FILES['u_std_image']['name'];
                    $tmp_name = $_FILES['u_std_image']['tmp_name'];

                    $query = "UPDATE students set std_name = '$std_name', std_roll = $std_roll where std_id = $std_id";

                    if (mysqli_query($this->conn, $query)) {
                        
                        move_uploaded_file($tmp_name, 'upload_img/' . $std_img);
                        return "Information Updated Successfully";
                    }
                }
                

                else {

                        $datas = $_GET['id'];

                        $catch_img = "SELECT * from students where std_id = $datas";
                        $deleteImg = mysqli_query($this->conn, $catch_img);
                        $img_info = mysqli_fetch_assoc($deleteImg);
                        unlink('upload_img/'.$img_info['std_image']);

                        $std_id = $data['u_id'];
                        $std_name = $data['u_std_name'];
                        $std_roll = $data['u_std_roll'];
                        $std_img = $_FILES['u_std_image']['name'];
                        $tmp_name = $_FILES['u_std_image']['tmp_name'];

                        $query = "UPDATE students set std_name = '$std_name', std_roll = $std_roll, std_image = '$std_img' where std_id = $std_id";

                        if (mysqli_query($this->conn, $query)) {
                            
                            move_uploaded_file($tmp_name, 'upload_img/' . $std_img);
                            return "Information Updated Successfully";
                    }
                }

                // $std_id = $data['u_id'];
                //         $std_name = $data['u_std_name'];
                //         $std_roll = $data['u_std_roll'];
                //         $std_img = $_FILES['u_std_image']['name'];
                //         $tmp_name = $_FILES['u_std_image']['tmp_name'];

                //         $query = "UPDATE students set std_name = '$std_name', std_roll = $std_roll, std_image = '$std_img' where std_id = $std_id";

                //         if (mysqli_query($this->conn, $query)) {
                            
                //             move_uploaded_file($tmp_name, 'upload_img/' . $std_img);
                //             return "Information Updated Successfully";
                //     }

        }

        public function deleteData($delete_id){

            $catch_img = "SELECT * from students where std_id = $delete_id";
            $deleteImg = mysqli_query($this->conn, $catch_img);
            $img_info = mysqli_fetch_assoc($deleteImg);
            unlink('upload_img/'.$img_info['std_image']);

            $query = "DELETE FROM students where std_id = $delete_id";

            if (mysqli_query($this->conn, $query)) {

                return "Information Deleted Successfully";
                header("location: index.php");
            }
        }
    }

?>