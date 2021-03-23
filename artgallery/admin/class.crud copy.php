<?php 
    session_start();
    ob_start();
    require_once 'dbconfig.php';
    class crud{

        private $db;
        private $dbuser=DBUSER;
        private $dbpassword=DBPWD;
        private $dbhost=DBHOST;
        private $dbname=DBNAME;
        

        public function __construct(){

            try {
                $this->db=new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname.';charset=utf8', $this->dbuser,$this->dbpassword);
                
            } catch (Exception $e) {
                
                die("Bağlantı Başarısız: ".$e->getMessage());    
            }    

            
        }


        public function userLogin($userUserName,$userPassword,$rememberMe){

            try {
                
                $check=$this->db->prepare("SELECT * FROM users WHERE user_username=? AND user_password=? And user_status=?");

                if(isset($_COOKIE['usersLogin'])){
                    $check->execute([$userUserName,md5(openssl_decrypt($userPassword,"AES-128-ECB","userSolve")),1]);
                }else{
                    $check->execute([$userUserName,md5($userPassword),1]);
                }

                if($check->rowCount()==1){

                    $userData=$check->fetch(PDO::FETCH_ASSOC);

                    $_SESSION["user"]=[
                        "userUserName"=>$userData['user_username'],
                        "userName"=>$userData['user_name'],
                        "userLastName"=>$userData['user_lastname'],
                        "userPhoto"=>$userData['user_photo'],
                        "userID"=>$userData['user_id'],
                        "userEmail"=>$userData['user_email']
                    ];

                    if(!empty($rememberMe) AND empty($_COOKIE['usersLogin'])){

                        $userCookie=[
                            "userUserName"=>$userUserName,
                            "userPassword"=>openssl_encrypt($userPassword,"AES-128-ECB","userSolve") 
                        ];

                        setcookie("usersLogin",json_encode($userCookie),strtotime("+30 days"),"/");
                    }else if (empty($rememberMe)){
                        setcookie("usersLogin",json_encode($userCookie),strtotime("-30 days"),"/");
                    }

                    return ['status'=>true];

                }else{

                    return ['status'=>false];
                }

            } catch (Exception $e) {
                
                return ['status'=>false,'error'=>$e->getMessage()];
            }

        }

        public function read($table,$options=[]){

            try {

                if (isset($options['column_name'])) {
    
                    $stmt=$this->db->prepare("SELECT * FROM $table order by {$options['column_name']} {$options['column_sort']}");
                    
                }  else {
    
                    $stmt=$this->db->prepare("SELECT * FROM $table");
    
                }
    
                
                $stmt->execute();
    
                return $stmt;
                
            } catch (Exception $e) {
                
                echo $e->getMessage();
                return false;
            }

        }

        public function imageUpload($name,$size,$tmp_name,$dir,$file_delete=null) {

            try {
    
                $allowed_files=[
                    'jpg',
                    'jpge',
                    'png',
                    'ico'
                ];
    
                $ext=strtolower(substr($name, strpos($name, '.')+1));
    
                if (in_array($ext, $allowed_files)===false) {
                    throw new Exception('Bu dosya türü kabul edilmemektedir...');
                }
    
                if ($size>2048576) {
                    throw new Exception('Dosya boyutu çok büyük...');
    
                }
    
                $name_y=uniqid().".".$ext;
    
                if (!@move_uploaded_file($tmp_name, "img/$dir/$name_y")) {
                    throw new Exception('Dosya yükleme hatası...');
                }
    
                // if (!empty($file_delete)) {
                //     unlink("img/$dir/$file_delete");
    
                //     if (strstr($dir, "user")) {
                //         $_SESSION["arts"]["art_file"]=$name_y;
                //     }
                    
                // }
                
                return $name_y;
    
    
    
            } catch (Exception $e) {
    
                return ['status' => FALSE, 'error' => $e->getMessage()];
            }
        }

        public function addValues($argse){

            $values=implode(",",array_map(function($item){
                return $item."=?";
            },array_keys($argse)));
 
            return $values;
        }

        public function insert($table,$values,$options=[]){

            try {

                if (!empty($_FILES[$options['file_name']]['name'])) {
				
                    $name_y=$this->imageUpload(
                        $_FILES[$options['file_name']]['name'],
                        $_FILES[$options['file_name']]['size'],
                        $_FILES[$options['file_name']]['tmp_name'],
                        $options['dir']
                    );
    
                    // print_r($name_y);
                    // exit;
    
                    $values+=[$options['file_name'] => $name_y];
                }
                
                $fname=$options["form_name"];
                unset($values[$options["form_name"]]);
                
                $stmt=$this->db->prepare("INSERT INTO $table SET {$this->addValues($values)}");
                $stmt->execute(array_values($values));
                //return ["status"=>true];
                    if($fname=="artistInsert"){
                        header("Location:artists.php");
                        exit;
                    }
                    else if($fname=="artInsert"){
                        header("Location:arts.php");
                        
                        exit;
                    }
 
 
            } catch (Exception $e) {
                

                return ["status"=>false,"error"=>$e->getMessage()];
                exit;
            }

        }


        public function update($table,$values,$options=[]){

            try {
                
                if (!empty($_FILES[$options['file_name']]['name'])) {

				
                    $name_y=$this->imageUpload(
                        $_FILES[$options['file_name']]['name'],
                        $_FILES[$options['file_name']]['size'],
                        $_FILES[$options['file_name']]['tmp_name'],
                        $options['dir'],
                        $values[$options['file_delete']]
                    );
    
                    // print_r($name_y);
                    // exit;
    
                    $values+=[$options['file_name'] => $name_y];
                    
                
            }
                $art_id=$values[$options['Id']];
                $fname=$options["form_name"];
                unset($values[$options["form_name"]]);
                $valuesExecute=$values;
                unset($values[$options["Id"]]);
               
                //Eski Resim Dosyasının Değerini Temizleme...
                unset($values[$options['file_delete']]);
               
                $valuesExecute=$values;
                $valuesExecute+=[$options['Id'] => $art_id];

                $stmt=$this->db->prepare("UPDATE $table SET {$this->addValues($values)} WHERE {$options['Id']}=?");
                $stmt->execute(array_values($valuesExecute));

                //return ["status"=>true];
    
                if($fname==="artistUpdate"){
                    header("Location:artists.php");
                    exit;
                }
                else if($fname==="artUpdate"){
                    header("Location:arts.php");
                    
                    exit;
                }

        

            } catch (Exception $e) {
                

                return ["status"=>false,"error"=>$e->getMessage()];
                exit;
            }

        }


        public function qSql($sql,$options=[]) {

            try {
    
                $stmt=$this->db->prepare($sql);
                $stmt->execute();
                return $stmt;
    
            } catch (Exception $e) {
    
                return ['status' => FALSE, 'error' => $e->getMessage()];
    
            }
        }

    }

?>