<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: tekiyowa
 * Date: 2017/1/17
 * Time: 上午11:56
 */
class User_model extends CI_Model
{
    public function insert_reg($arr){
        $query = $this->db->insert('t_users',$arr);
        return $query;
    }
    public function select_login($account,$pass){
        $query = $this->db->get_where('t_users',array('ACCOUNT'=>$account,'PASSWORD'=>$pass));
        return $query->row();
    }
}