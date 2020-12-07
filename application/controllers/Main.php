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
    }

    
    public function index()
    {
        $this->load->view('partials/header');
        $this->load->view('admin/index');
        $this->load->view('partials/footer');
    }


    public function add()
    {
        $this->load->view('partials/header');
        $this->load->view('admin/add_form');
        $this->load->view('partials/footer');
    }


    public function search()
    {
        $this->load->view('partials/header');
        $this->load->view('admin/search');
        $this->load->view('partials/footer');
    }
}
