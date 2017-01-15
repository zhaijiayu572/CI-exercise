<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Blog_model extends CI_Model
{
    public function get_blog($index){
        $this->db->select('*');
        $this->db->from('blog');
        $this->db->join('user',"user.uid=blog.uid");
        $this->db->limit(2,$index);
        $query = $this->db->get();
        return $query->result();
    }
    public function search($key){
        $this->db->select('*');
        $this->db->from('blog');
        $this->db->join('user',"user.uid=blog.uid");
        $this->db->like('title',$key);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_allblog(){
        $result =  $this->db->count_all('blog');
        return $result;
    }
    public function get_catalog(){
        $query = $this->db->get('catalog');
        return $query->result();
    }
    public function insert_Blog($cid,$title,$content,$uid){
        $now = date("Y-m-d");
        $data = array(
            'uid'=>$uid,
            'title'=>$title,
            'cid'=>$cid,
            'content'=>$content,
            'time'=>$now
        );
        $query = $this->db->insert('blog',$data);
        return $query;
    }
    public function insert_catalog($cname){
        $data = array(
            'cname'=>$cname
        );
        $query = $this->db->insert('catalog',$data);
        return $query;
    }
    public function get_screen($cid){
        $this->db->select('*');
        $this->db->from('blog');
        $this->db->join('user','user.uid=blog.uid');
        $this->db->where('cid',$cid);
        $query = $this->db->get();
        return $query->result();
    }
    public function update_hits($wid){
        $query = $this->db->query("update blog set hits=hits+1 where wid='$wid'");
        return $query;
    }
    public function show_blog($wid){
        $this->db->select('*');
        $this->db->from('blog');
        $this->db->join('user','user.uid=blog.uid');
        $this->db->where('wid',$wid);
        $query = $this->db->get();
        return $query->result();
    }
    function get_comment($wid){
        $this->db->select('*');
        $this->db->from('comment');
        $this->db->join('user','user.uid=comment.uid');
        $this->db->where('wid',$wid);
        $query = $this->db->get();
        return $query->result();
    }
    function insert_comment($pcon,$uid,$wid){
        $now = date("Y-m-d");
        $data = array(
            'pcon'=>$pcon,
            'uid'=>$uid,
            'wid'=>$wid,
            'ptime'=>$now
        );
        $query = $this->db->insert('comment',$data);
        return $query;
    }
}