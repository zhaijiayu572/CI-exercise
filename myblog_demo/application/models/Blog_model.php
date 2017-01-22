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
    public function get_blog($bid){
        $this->db->select("*");
        $this->db->from('t_blogs');
        $this->db->join('t_users','t_users.USER_ID=t_blogs.WRITER');
        $this->db->where('BLOG_ID',$bid);
        $query = $this->db->get();
        return $query->row();
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
    public function all_blog($uid){
        $this->db->select('*');
        $this->db->from("t_blogs");
        $this->db->where('WRITER',$uid);
        $query = $this->db->count_all_results();
        return $query;
    }
    public  function del_blog($bid){
       $query = $this->db->delete('t_blogs',array('BLOG_ID'=>$bid));
       return $query;
    }
    public function few_blog($uid){
        $query = $this->db->get_where('t_blogs',array('WRITER'=>$uid),3);
        return $query->result();
    }
    public function update_click($bid){
        $this->db->query("update t_blogs set CLICK_RATE = CLICK_RATE+1 where BLOG_ID='$bid'");
    }
}