<?php 
require_once 'koneksi.php';

class login {
    protected $db;
    public function __construct ($con){
        $this->db=$con;
    } 

    public function logincheck($nip,$username,$password){
        $loginuser = $this->db->prepare("SELECT * from login where nip='$nip' and username='$username' and password='$password'");
        $loginuser->execute();
        session_start();

        while($row=$loginuser->fetch(PDO::FETCH_ASSOC))
        {
            if($loginuser->rowCount()==1){
                $_SESSION['username'] = $username;
                $_SESSION['hak_akses'] = $row['hak_akses'];
                $_SESSION['status'] = "login";
            
                if($_SESSION['hak_akses']=='user'){
                    header("location:index.php");
                }
                
                if($_SESSION['hak_akses']=='administrator'){
                    header("location:admin.php");
                }
            }
        }
    }
}

$login = new login($con);
