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
    public function add_blog($cid,$uid,$title,$content,$type){
        $now = date("Y-m-d H:i:s");
        $arr = array(
            'CATALOG_ID'=>$cid,
            'WRITER'=>$uid,
            'TITLE'=>$title,
            'CONTENT'=>$content,
            'ADD_TIME'=>$now,
            'IS_YOURS'=>$type
        );
        $query = $this->db->insert('t_blogs',$arr);
        return $query;
    }
}