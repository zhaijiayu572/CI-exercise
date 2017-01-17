<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Blog_model extends CI_Model
{
    public function get_myblog($uid){
        $this->db->select('*');
        $this->db->from('t_blogs');
        $this->db->join('t_blog_catalogs','t_blogs.CATALOG_ID=t_blog_catalogs.CATALOG_ID');
        $this->db->where('WRITER',$uid);
        $query = $this->db->get();
        return $query->result();
    }
}