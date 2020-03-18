<?php

class Dashboard extends CI_Controller
{
    public function index()
    {
        $this->load->view('templates_administrator/tampilan');

        $this->load->view('administrator/dashboard');
    }
}
