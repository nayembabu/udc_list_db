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

    public function search_udc_info_new($search_data)
    {
        $this->db->where('activity', 1);
        $this->db->like('udc_phone_no', $search_data);
        $this->db->join('un_list', 'un_list.un_id = udc_info_s.un_a_iddd', 'left');
        $this->db->join('up_list', 'up_list.up_id = udc_info_s.up_a_iddd', 'left');
        $this->db->join('dist_list', 'dist_list.dist_id = udc_info_s.dist_a_iddd', 'left');
        $this->db->join('div_list', 'div_list.div_id = udc_info_s.div_a_iddd', 'left');
        $sql = $this->db->get('udc_info_s');
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
        $this->db->join('un_list', 'un_list.un_id = udc_info_s.un_a_iddd', 'left');
        $this->db->join('up_list', 'up_list.up_id = udc_info_s.up_a_iddd', 'left');
        $this->db->join('dist_list', 'dist_list.dist_id = udc_info_s.dist_a_iddd', 'left');
        $this->db->join('div_list', 'div_list.div_id = udc_info_s.div_a_iddd', 'left');
        $query = $this->db->get('udc_info_s');
        return $query->result();
    }

    public function row_count_of_udcinfo_which_active($userid) {
        $this->db->where('activity', 1);
        $this->db->where('user_idp', $userid);
        $this->db->join('un_list', 'un_list.un_id = udc_info_s.un_a_iddd', 'left');
        $this->db->join('up_list', 'up_list.up_id = udc_info_s.up_a_iddd', 'left');
        $this->db->join('dist_list', 'dist_list.dist_id = udc_info_s.dist_a_iddd', 'left');
        $this->db->join('div_list', 'div_list.div_id = udc_info_s.div_a_iddd', 'left');
        $query = $this->db->get('udc_info_s');
        return $query->result();
    }

    public function payment_complete($userid){
        $this->db->select_sum('pmnt_number');
        $this->db->where('users_iid', $userid);
        $query = $this->db->get('payment_user');
        return $query->row()->pmnt_number;
    }

    public function entry_payment_count($data)
    {
        $this->db->insert('payment_user', $data);
    }

    public function update_udc_data_activity($data_array, $data_a_iid)
    {
        $this->db->where('udc_list_auto_p_iidd', $data_a_iid);        
        $this->db->update('udc_info_s', $data_array);
    }

    public function get_udc_info_by_un_auto_id($un_auto_iddd)
    {
        $this->db->where('activity', 1);
        $this->db->where('un_a_iddd', $un_auto_iddd);
        $this->db->join('un_list', 'un_list.un_id = udc_info_s.un_a_iddd', 'left');
        $this->db->join('up_list', 'up_list.up_id = udc_info_s.up_a_iddd', 'left');
        $this->db->join('dist_list', 'dist_list.dist_id = udc_info_s.dist_a_iddd', 'left');
        $this->db->join('div_list', 'div_list.div_id = udc_info_s.div_a_iddd', 'left');
        $query = $this->db->get('udc_info_s');
        return $query->result();
    }
    
    public function get_un_info_by_div_a_id($auto_id)
    {
        $this->db->where('activity', 1);
        $this->db->where('div_a_iddd', $auto_id);
        $this->db->join('un_list', 'un_list.un_id = udc_info_s.un_a_iddd', 'left');
        $this->db->join('up_list', 'up_list.up_id = udc_info_s.up_a_iddd', 'left');
        $this->db->join('dist_list', 'dist_list.dist_id = udc_info_s.dist_a_iddd', 'left');
        $this->db->join('div_list', 'div_list.div_id = udc_info_s.div_a_iddd', 'left');
        $query = $this->db->get('udc_info_s');
        return $query->result();
    }
    
    public function get_un_info_by_dist_a_id($auto_id)
    {
        $this->db->where('activity', 1);
        $this->db->where('dist_a_iddd', $auto_id);
        $this->db->join('un_list', 'un_list.un_id = udc_info_s.un_a_iddd', 'left');
        $this->db->join('up_list', 'up_list.up_id = udc_info_s.up_a_iddd', 'left');
        $this->db->join('dist_list', 'dist_list.dist_id = udc_info_s.dist_a_iddd', 'left');
        $this->db->join('div_list', 'div_list.div_id = udc_info_s.div_a_iddd', 'left');
        $query = $this->db->get('udc_info_s');
        return $query->result();
    }
    
    public function get_un_info_by_up_id($auto_id)
    {
        $this->db->where('activity', 1);
        $this->db->where('up_a_iddd', $auto_id);
        $this->db->join('un_list', 'un_list.un_id = udc_info_s.un_a_iddd', 'left');
        $this->db->join('up_list', 'up_list.up_id = udc_info_s.up_a_iddd', 'left');
        $this->db->join('dist_list', 'dist_list.dist_id = udc_info_s.dist_a_iddd', 'left');
        $this->db->join('div_list', 'div_list.div_id = udc_info_s.div_a_iddd', 'left');
        $query = $this->db->get('udc_info_s');
        return $query->result();
    }
    
    public function get_un_info_by_un_id($auto_id)
    {
        $this->db->where('activity', 1);
        $this->db->where('un_a_iddd', $auto_id);
        $this->db->join('un_list', 'un_list.un_id = udc_info_s.un_a_iddd', 'left');
        $this->db->join('up_list', 'up_list.up_id = udc_info_s.up_a_iddd', 'left');
        $this->db->join('dist_list', 'dist_list.dist_id = udc_info_s.dist_a_iddd', 'left');
        $this->db->join('div_list', 'div_list.div_id = udc_info_s.div_a_iddd', 'left');
        $query = $this->db->get('udc_info_s');
        return $query->result();
    }

    public function get_all_udc_lists()
    {
        $this->db->join('un_list', 'un_list.un_id = udc_info_s.un_a_iddd', 'left');
        $this->db->join('up_list', 'up_list.up_id = udc_info_s.up_a_iddd', 'left');
        $this->db->join('dist_list', 'dist_list.dist_id = udc_info_s.dist_a_iddd', 'left');
        $this->db->join('div_list', 'div_list.div_id = udc_info_s.div_a_iddd', 'left');
        $query = $this->db->get('udc_info_s');
        return $query->result();
    }
}
