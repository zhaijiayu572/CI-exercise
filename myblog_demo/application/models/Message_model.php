<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Message_model extends CI_Model
{
    public function show_unread($uid){
        $query = $this->db->get_where('t_messages',array('RECEIVER'=>$uid,'FLAG'=>0));
        return $query->result();
    }
    public function show_unread_num($uid){
        $this->db->select('*');
        $this->db->from('t_messages');
        $this->db->where('RECEIVER',$uid);
        $this->db->where("FLAG",0);
        $query = $this->db->count_all_results();
        return $query;
    }
    public function send_message($sender,$receiver,$content){
        $now = date('Y-m-d H:m:s');
        $data = array(
            'SENDER'=>$sender,
            "RECEIVER"=>$receiver,
            'CONTENT'=>$content,
            'ADD_TIME'=>$now
        );
        $query = $this->db->insert('t_messages',$data);
        return $query;
    }
    public function send_number($uid){
        $this->db->select('*');
        $this->db->from('t_messages');
        $this->db->where('SENDER',$uid);
        $query = $this->db->count_all_results();
        return $query;
    }
    public function receive_number($uid){
        $this->db->select('*');
        $this->db->from('t_messages');
        $this->db->where('RECEIVER',$uid);
        $query = $this->db->count_all_results();
        return $query;
    }
    public function update_state($uid){
        $data = array(
            'FLAG'=>1
        );
        $this->db->where('RECEIVER',$uid);
        $query = $this->db->update('t_messages',$data);
        return $query;
    }
    public function show_send($uid){
        $query = $this->db->get_where('t_messages',array('SENDER'=>$uid));
        return $query->result();
    }
    public function show_receive($uid){
        $this->db->select('*');
        $this->db->from('t_messages');
        $this->db->join('t_users','t_users.USER_ID=t_messages.SENDER');
        $this->db->where('RECEIVER',$uid);
        $query = $this->db->get();
        return $query->result();
    }
    public function del_msg($mid){
        $query = $this->db->delete('t_messages',array('MSG_ID'=>$mid));
        return $query;
    }
}