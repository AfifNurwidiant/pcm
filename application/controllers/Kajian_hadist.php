<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kajian_hadist extends CI_Controller
{

    public function index()
    {

        $this->load->view('templates/navbar');
        $this->load->view('kajian_hadist');
        $this->load->view('templates/footer');
    }
    // surat masuk admin

}
