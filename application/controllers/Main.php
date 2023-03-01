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

        // if (!$this->ion_auth->logged_in()) {
        //     redirect('login', 'refresh');
        // }
        // if (!$this->ion_auth->in_group(array('admin'))) {
        //     redirect('logout');
        // }
    }

    
    public function index()
    {
        $userid = $this->ion_auth->user()->row()->id;
        $data['get_user_payment'] = $this->main_model->row_count_of_udcinfo_which_active($userid);
        $data['pay_count'] = $this->main_model->payment_complete($userid);
        $this->load->view('partials/header');
        $this->load->view('admin/index', $data);
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
    
    public function get_udc_info_by_json_new()
    {
        $search_data = $this->input->get('search_info');                
        $data = $this->main_model->search_udc_info_new($search_data);
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
        $requUser = $this->ion_auth->user()->row()->id;
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
        $check_mobile_entry = $this->main_model->check_mobile_entry($udc_phone_no_1);
        if (empty($check_mobile_entry)) {
            $data = array(
                        'user_idp' => $requUser,
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
        }else {
            $this->session->set_flashdata('wrong_messege', 'This Phone Already added.');
            redirect('add');
        }
    }

    /**
     *  search section from new table: udc_info_s
     *  data will be get by two way 
     *  district wise data and union wise data 
     */

    public function search_old() {

        $this->load->view('partials/header');
        $this->load->view('admin/old_search');
        $this->load->view('partials/footer');
    }

    
    public function search_new() {

        $this->load->view('partials/header');
        $this->load->view('admin/new_search');
        $this->load->view('partials/footer');
    }

    // Get row count 
    public function row_count() {
        
        $data['users'] = $this->main_model->_getAll_user();
        $this->load->view('partials/header');
        $this->load->view('admin/row_countPageAdm', $data);
        $this->load->view('partials/footer'); 
    }
    /**
     *  get user wise data from  db
     *  return count
     */
    public function getDataAsUser(){
        $userid = $this->input->post('userid');
        $data['counts'] = $this->main_model->row_count_of_udcinfo($userid);
        $data['payment_complete'] = $this->main_model->payment_complete($userid);
        echo json_encode($data);
    }
    
    public function getDataBYUser_idddD(){
        $userid = $this->input->post('userid');
        $data = $this->main_model->row_count_of_udcinfo($userid);
        echo json_encode($data);
    }

    public function entry_payment_count()
    {
        $payment_count_no = $this->input->post('payment_count_no');
        $userId = $this->input->post('userId');
        $data = array(
                    'pmnt_number' => $payment_count_no, 
                    'users_iid' => $userId,
                    'pmnt_date' => time()
                );
        $this->main_model->entry_payment_count($data);
    }

    public function entryforAdmin()
    {
        $data['all_div'] = $this->main_model->get_all_div();
        $this->load->view('partials/header');
        $this->load->view('admin/add_form_admin', $data);
        $this->load->view('partials/footer');
    }

    public function udc_add_2()
    {
        $requUser = $this->ion_auth->user()->row()->id;
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
        $check_mobile_entry = $this->main_model->check_mobile_entry($udc_phone_no_1);
        if (empty($check_mobile_entry)) {
            $data = array(
                        'user_idp' => $requUser,
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
            $data['succ'] = 'Added Succesfully';
        }else {
            $data['wrong'] = 'This Phone Already added.';
        }
        echo json_encode($data);
    }

    public function udc_data_activity()
    {
        $data_a_iid = $this->input->post('udc_data_a_iid');
        $data_activity = $this->input->post('udc_data_activity');
        if ($data_activity == 1) {
            $activity_id = 0;
        }elseif ($data_activity == 0) {
            $activity_id = 1;
        }else {
            $activity_id = 1;
        }

        $data_array = array(
                        'activity' => $activity_id, 
                    );
        $this->main_model->update_udc_data_activity($data_array, $data_a_iid);
    }

    public function get_udc_info_by_union()
    {
        $data['all_div'] = $this->main_model->get_all_div();
        $this->load->view('partials/header');
        $this->load->view('admin/get_udc_list', $data);
        $this->load->view('partials/footer');
    }

    public function get_udc_info_by_un_auto_id()
    {
        $un_auto_iddd = $this->input->get('un_auto_iddd');
        $data = $this->main_model->get_udc_info_by_un_auto_id($un_auto_iddd);
        echo json_encode($data);
    }

    public function get_udc_info_by_all()
    {
        $data['all_div'] = $this->main_model->get_all_div();
        $this->load->view('partials/header');
        $this->load->view('admin/get_udc', $data);
        $this->load->view('partials/footer');
    }

    public function get_un_info_by_div_a_id()
    {
        $auto_id = $this->input->get('auto_id');
        $data = $this->main_model->get_un_info_by_div_a_id($auto_id);
        echo json_encode($data);
    }

    public function get_un_info_by_dist_a_id()
    {
        $auto_id = $this->input->get('auto_id');
        $data = $this->main_model->get_un_info_by_dist_a_id($auto_id);
        echo json_encode($data);
    }

    public function get_un_info_by_up_id()
    {
        $auto_id = $this->input->get('auto_id');
        $data = $this->main_model->get_un_info_by_up_id($auto_id);
        echo json_encode($data);
    }

    public function get_un_info_by_un_id()
    {
        $auto_id = $this->input->get('auto_id');
        $data = $this->main_model->get_un_info_by_un_id($auto_id);
        echo json_encode($data);
    }

    public function all_udc_list()
    {
        $data['all_udc'] = $this->main_model->get_all_udc_lists();
        $this->load->view('partials/header');
        $this->load->view('admin/get_all_udc_lists', $data);
        $this->load->view('partials/footer');
    }

    public function getAllUdcForDownloadExcel()
    {
        $data['all_div'] = $this->main_model->get_all_div();
        $this->load->view('partials/header');
        $this->load->view('admin/get_all_udc_for_download_excel', $data);
        $this->load->view('partials/footer');
    }
}
