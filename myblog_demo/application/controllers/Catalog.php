<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Catalog_model");
    }
    public function add_catalog(){
        $result = $this->Catalog_model->get_all_catalog();
        $arr['catalog'] = $result;
        $this->load->view("blogCatalogs",$arr);
    }
    public function do_add_catalog(){
        $uid = $this->session->uid;
        $cname = $this->input->post('name');
        $result = $this->Catalog_model->add_catalog($uid,$cname);
        if($result){
            redirect('Blog/addblog');
        }else{
            redirect('Catalog/add_catalog');
        }
    }
    public function editcatalog(){
//        $cname = $this->uri->segment(4);

        $cname = $this->input->get('cname');//为什么用uri获取不了
        $cid = $this->input->get('cid');
        $arr['cid'] = $cid;
        $arr['cname'] = $cname;
        $result = $this->Catalog_model->get_all_catalog();
        $arr['catalog'] = $result;
        $this->load->view("editCatalog",$arr);
    }
    public function do_editcatalog(){
        $cname = $this->input->post('name');
        $cid = $this->input->post('cid');
        $query = $this->Catalog_model->update_catalog($cid,$cname);
        if($query){
            redirect('Catalog/add_catalog');
        }else{
            echo "<script>alert('error')</script>";
            echo "<script>location='".site_url('Catalog/add_catalog')."'</script>";
        }
    }
    public  function del_catalog(){
        $cid = $this->input->get('cid');
        $rs = $this->Catalog_model->delete_catalog($cid);
        if($rs){
            redirect('Catalog/add_catalog');
        }else{
            echo "<script>alert('错误')</script>";
            echo "<script>location='".site_url('Catalog/add_catalog')."'</script>>";
        }
    }
}