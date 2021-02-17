<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }

  public function searchByHotel()
  {
    $keyword = $this->input->get('q');
    $data['title'] = 'Hotel';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    
    $this->db->select('*');
    $this->db->from('hotel');
    $this->db->like('name', $keyword);
    $data['hotel'] = $this->db->get()->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('user/hotellist', $data);
    $this->load->view('templates/footer');

  }


}
