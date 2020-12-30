<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function search_udc_info($search_data)
    {
        $this->db->like('udc_mobile_no', $search_data);
        $sql = $this->db->get('raw_data');
        return $sql->result();        
    }

    public function mobile_for_sms()
    {
        $sql = $this->db->get('raw_data');
        return $sql->result(); 
    }

    public function get_all_div()
    {
        $sql = $this->db->get('div_list');
        return $sql->result(); 
    }

    public function get_dis_info_by_div_a_id($div_iidd)
    {
        $this->db->where('division_id', $div_iidd);
        $sql = $this->db->get('dist_list');
        return $sql->result(); 
    }

    public function get_up_info_by_dis_a_id($dis_id)
    {
        $this->db->where('district_id', $dis_id);
        $sql = $this->db->get('up_list');
        return $sql->result(); 
    }

    public function get_un_info_by_up_a_id($up_a_idd)
    {
        $this->db->where('upazilla_id', $up_a_idd);
        $sql = $this->db->get('un_list');
        return $sql->result(); 
    }

    public function get_udc_info_by_un_bn_name($un_bn_name)
    {
        $this->db->where('union_name', $un_bn_name);
        $sql = $this->db->get('raw_data');
        return $sql->result(); 
    }

    public function insert_udc_person($data)
    {
        $this->db->insert('udc_info_s', $data);
    }

    public function check_mobile_entry($udc_phone_no_1)
    {
        $this->db->where('udc_phone_no', $udc_phone_no_1);
        $sql = $this->db->get('udc_info_s');
        return $sql->row();    
    }
    /** 
     *  return all users from users table
     * 
     */
    public function _getAll_user(){
        $data = $this->db->get('users');
        return $data->result();
    }

    public function row_count_of_udcinfo($userid) {
        $this->db->where('user_idp', $userid);
        $query = $this->db->get('udc_info_s');
        return $query->result();
    }

    public function payment_complete($userid){
        $this->db->where('users_iid', $userid);
        $query = $this->db->get('payment_user');
        return  $query->result();
    }
}
