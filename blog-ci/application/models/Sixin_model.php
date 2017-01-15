<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sixin_model extends CI_Model
{
    public function insert_letter($sid,$rid,$scontent){
        $now = date("Y-m-d");
        $data = array(
            'sid'=>$sid,
            'rid'=>$rid,
            'scontent'=>$scontent,
            'stime'=>$now
        );
        $query =$this->db->insert('Sixin',$data);
        return $query;
    }
    public function select_unread($uid){
        $this->db->from('Sixin');
        $this->db->where('rid',$uid);
        $this->db->where('flag',0);
        $query = $this->db->count_all_results();
        return $query;

    }
    public function get_letter($uid){
        $query = $this->db->query("select * from sixin,user where sixin.sid = user.uid and rid ='$uid'");
        return $query->result();
    }
}