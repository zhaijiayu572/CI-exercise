<?php
class Register extends CI_Model
{
    public function check_name($name){
        $query = $this->db->query("select * from user where uname = '$name'");
        $row = $query->row();
        if($row){
            return true;
        }else{
            return false;
        }
    }
    public function register_user($name,$pass){
        $query = $this->db->query("insert into user(uname,pass) values('$name','$pass')");
        if($query){
            return true;
        }else{
            return false;
        }
    }
}