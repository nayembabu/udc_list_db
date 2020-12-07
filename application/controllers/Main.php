<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

    /**
     *
     *	main controller for all methods
     *
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->model('main_model');
    }

    
    public function index()
    {
        $this->load->view('partials/header');
        $this->load->view('admin/index');
        $this->load->view('partials/footer');
    }


    public function add()
    {
        $data['all_div'] = $this->main_model->get_all_div();
        $this->load->view('partials/header');
        $this->load->view('admin/add_form', $data);
        $this->load->view('partials/footer');
    }


    public function search()
    {
        $this->load->view('partials/header');
        $this->load->view('admin/search');
        $this->load->view('partials/footer');
    }

    public function get_udc_info_by_json()
    {
        $search_data = $this->input->get('search_info');                
        $data = $this->main_model->search_udc_info($search_data);
        echo json_encode($data);
    }

    public function mobile_for_sms()
    {
        $data['all_mobile_no'] = $this->main_model->mobile_for_sms();
        $this->load->view('partials/header');
        $this->load->view('admin/mobile_for_sms', $data);
        $this->load->view('partials/footer');
    }

    public function get_dis_info_by_div_a_id()
    {
        $div_iidd = $this->input->get('div_auto_iid');      
        $data = $this->main_model->get_dis_info_by_div_a_id($div_iidd);
        echo json_encode($data);
    }

    public function get_up_info_by_dis_a_id()
    {
        $dis_id = $this->input->get('dis_auto_iid');      
        $data = $this->main_model->get_up_info_by_dis_a_id($dis_id);
        echo json_encode($data);
    }

    public function get_un_info_by_up_a_id()
    {
        $up_a_idd = $this->input->get('up_auto_id');      
        $data = $this->main_model->get_un_info_by_up_a_id($up_a_idd);
        echo json_encode($data);
    }

    public function get_udc_info_by_un_bn_name()
    {
        $un_bn_name = $this->input->get('un_bn_name');      
        $data = $this->main_model->get_udc_info_by_un_bn_name($un_bn_name);
        echo json_encode($data);
    }
}
