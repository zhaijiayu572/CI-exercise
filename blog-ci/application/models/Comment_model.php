<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Comment_model extends CI_Model
{
    public function insert_reply($pid,$pcon,$wid,$uid){
        $now = date("Y-m-d");
        $data = array(
            'pflag'=>$pid,
            'pcon'=>$pcon,
            'wid'=>$wid,
            'ptime'=>$now,
            'uid'=>$uid
        );
        $query = $this->db->insert('comment',$data);
        return $query;
    }
}