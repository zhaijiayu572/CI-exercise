<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Blog_model extends CI_Model
{
    public function get_blog(){
        $query = $this->db->query('select * from blog,user where blog.uid = user.uid');
        return $query->result();
    }
    public function search($key){
        $query = $this->db->query("select * from blog,user where blog.uid = user.uid and title like '%".$key."%'");
        return $query->result();
    }
}