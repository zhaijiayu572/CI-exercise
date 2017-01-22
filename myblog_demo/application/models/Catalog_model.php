<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Catalog_model extends CI_Model
{
    public function get_all_catalog(){
        $query = $this->db->get('t_blog_catalogs');
        return $query->result();
    }
    public function get_all(){
        $this->db->select('*');
        $this->db->from('t_blogs');
        $this->db->join('t_blog_catalogs','t_blogs.CATALOG_ID=t_blog_catalogs.CATALOG_ID');
        $query = $this->db->get();
        return $query->result();
    }
    public function add_catalog($uid,$cname){
        $arr = array(
            'NAME'=>$cname,
            'USER_ID'=>$uid
        );
        $query = $this->db->insert('t_blog_catalogs',$arr);
        return $query;
    }
    public function update_catalog($cid,$cname){
        $this->db->where('CATALOG_ID',$cid);
        $query = $this->db->update('t_blog_catalogs',array('NAME'=>$cname));
        return $query;

    }
    public function delete_catalog($cid){
        $query = $this->db->delete('t_blog_catalogs',array('CATALOG_ID'=>$cid));
        return $query;
    }
    public function use_catalog($cid){
        $query = $this->db->query("update t_blog_catalogs set BLOG_COUNT = BLOG_COUNT+1 where CATALOG_ID='$cid'");
        return $query;
    }
}