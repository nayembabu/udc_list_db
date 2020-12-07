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

        $this->load->library('session');
        $this->load->library('upload');
        $this->load->library('Ion_auth');
        $this->load->model('ion_auth_model');

        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }
        if (!$this->ion_auth->in_group(array('admin'))) {
            redirect('logout');
        }
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

    public function add_udc_person()
    {
        $div_auto_iid = $this->input->post('div_auto_iid');
        $dis_a_iidddd = $this->input->post('dis_a_iidddd');
        $up_auto_iidddd = $this->input->post('up_auto_iidddd');
        $un_a_idid = $this->input->post('un_a_idid');
        $udc_name = $this->input->post('udc_name');
        $udc_phone_no_1 = $this->input->post('udc_phone_no_1');
        $udc_phone_no_two = $this->input->post('udc_phone_no_two');
        $udc_phone_no_three = $this->input->post('udc_phone_no_three');
        $udc_email_add = $this->input->post('udc_email_add');
        $udc_remark = $this->input->post('udc_remark');

        $data = array(
                    'div_a_iddd' => $div_auto_iid,
                    'dist_a_iddd' => $dis_a_iidddd,
                    'up_a_iddd' => $up_auto_iidddd,
                    'un_a_iddd' => $un_a_idid,
                    'udc_per_name' => $udc_name,
                    'udc_phone_no' => $udc_phone_no_1,
                    'udc_phone_no_2' => $udc_phone_no_two,
                    'udc_phone_no_3' => $udc_phone_no_three,
                    'udc_email_no' => $udc_email_add,
                    'remarks' => $udc_remark, 
                );
        $this->main_model->insert_udc_person($data);
        $this->session->set_flashdata('add_messege', 'Added Succesfully');
        redirect('add');
    }
}
