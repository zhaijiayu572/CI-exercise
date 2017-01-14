<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model
{
    public function register_user($name,$pass){
        $arr =array(
            'uname' => $name,
            'pass' => $pass
        );
        $query = $this->db->insert('user',$arr);
        return $query;

    }
    public function check_name($name){
        $query = $this->db->get_where('user',array('uname'=>$name));
        return $query->row();
    }
    public function check_login($name,$pass){
        $query = $this->db->get_where('user',array('uname'=>$name,'pass'=>$pass));
        return $query->row();
    }

}