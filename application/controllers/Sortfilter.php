<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sortfilter extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function nameAsc()
    {
        $data['title'] = 'Hotel';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $query = "SELECT `hotel`.*
                    FROM `hotel` 
                    ORDER BY `hotel`.`name` ASC";
        $data['hotel'] = $this->db->query($query)->result_array();

        $query1 = "SELECT `room`.`price`
                    FROM `room`
                    JOIN `hotel` ON `room`.`hotel_id` = `hotel`.`id`
                    GROUP BY `hotel`.`id` ASC
                ";
        $data['room'] = $this->db->query($query1)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/hotellist', $data);
        $this->load->view('templates/footer');
    }

    public function nameDesc()
    {
        $data['title'] = 'Hotel';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $query = "SELECT `hotel`.*
                    FROM `hotel` 
                    ORDER BY `hotel`.`name` DESC";
        $data['hotel'] = $this->db->query($query)->result_array();

        $query1 = "SELECT `room`.`price`
                    FROM `room`
                    JOIN `hotel` ON `room`.`hotel_id` = `hotel`.`id`
                    GROUP BY `hotel`.`id` ASC
                ";
        $data['room'] = $this->db->query($query1)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/hotellist', $data);
        $this->load->view('templates/footer');
    }

    public function star5()
    {
        $data['title'] = 'Hotel';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $query = "SELECT `hotel`.*
                    FROM `hotel` 
                    WHERE `hotel`.`star` = 5
                ";
        $data['hotel'] = $this->db->query($query)->result_array();

        $query1 = "SELECT `room`.`price`
                    FROM `room`
                    JOIN `hotel` ON `room`.`hotel_id` = `hotel`.`id`
                    GROUP BY `hotel`.`id` ASC
                ";
        $data['room'] = $this->db->query($query1)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/hotellist', $data);
        $this->load->view('templates/footer');
    }

    public function star4()
    {
        $data['title'] = 'Hotel';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $query = "SELECT `hotel`.*
                    FROM `hotel` 
                    WHERE `hotel`.`star` = 4
                ";
        $data['hotel'] = $this->db->query($query)->result_array();

        $query1 = "SELECT `room`.`price`
                    FROM `room`
                    JOIN `hotel` ON `room`.`hotel_id` = `hotel`.`id`
                    GROUP BY `hotel`.`id` ASC
                ";
        $data['room'] = $this->db->query($query1)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/hotellist', $data);
        $this->load->view('templates/footer');
    }

    public function star3()
    {
        $data['title'] = 'Hotel';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $query = "SELECT `hotel`.*
                    FROM `hotel` 
                    WHERE `hotel`.`star` = 3
                ";
        $data['hotel'] = $this->db->query($query)->result_array();

        $query1 = "SELECT `room`.`price`
                    FROM `room`
                    JOIN `hotel` ON `room`.`hotel_id` = `hotel`.`id`
                    GROUP BY `hotel`.`id` ASC
                ";
        $data['room'] = $this->db->query($query1)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/hotellist', $data);
        $this->load->view('templates/footer');
    }

    public function star2()
    {
        $data['title'] = 'Hotel';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $query = "SELECT `hotel`.*
                    FROM `hotel` 
                    WHERE `hotel`.`star` = 2
                ";
        $data['hotel'] = $this->db->query($query)->result_array();

        $query1 = "SELECT `room`.`price`
                    FROM `room`
                    JOIN `hotel` ON `room`.`hotel_id` = `hotel`.`id`
                    GROUP BY `hotel`.`id` ASC
                ";
        $data['room'] = $this->db->query($query1)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/hotellist', $data);
        $this->load->view('templates/footer');
    }

    public function star1()
    {
        $data['title'] = 'Hotel';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $query = "SELECT `hotel`.*
                    FROM `hotel` 
                    WHERE `hotel`.`star` = 1
                ";
        $data['hotel'] = $this->db->query($query)->result_array();

        $query1 = "SELECT `room`.`price`
                    FROM `room`
                    JOIN `hotel` ON `room`.`hotel_id` = `hotel`.`id`
                    GROUP BY `hotel`.`id` ASC
                ";
        $data['room'] = $this->db->query($query1)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/hotellist', $data);
        $this->load->view('templates/footer');
    }

    public function priceless500()
    {
        $data['title'] = 'Hotel';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $query = "SELECT `hotel`.*, `room`.`price`
                    FROM `hotel` 
                    JOIN `room` ON `room`.`hotel_id` = `hotel`.`id`
                    WHERE `room`.`price` < 500000
                    GROUP BY `hotel`.`name`
                ";
        $data['hotel'] = $this->db->query($query)->result_array();

        $query1 = "SELECT `room`.`price`
                    FROM `room`
                    JOIN `hotel` ON `room`.`hotel_id` = `hotel`.`id`
                    GROUP BY `hotel`.`id` ASC
                ";
        $data['room'] = $this->db->query($query1)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/hotellist', $data);
        $this->load->view('templates/footer');
    }

    public function priceless1000()
    {
        $data['title'] = 'Hotel';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $query = "SELECT `hotel`.*, `room`.`price`
                    FROM `hotel` 
                    JOIN `room` ON `room`.`hotel_id` = `hotel`.`id`
                    WHERE `room`.`price` < 1000000
                    GROUP BY `hotel`.`name`
                ";
        $data['hotel'] = $this->db->query($query)->result_array();

        $query1 = "SELECT `room`.`price`
                    FROM `room`
                    JOIN `hotel` ON `room`.`hotel_id` = `hotel`.`id`
                    GROUP BY `hotel`.`id` ASC
                ";
        $data['room'] = $this->db->query($query1)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/hotellist', $data);
        $this->load->view('templates/footer');
    }

    public function pricemore1000()
    {
        $data['title'] = 'Hotel';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $query = "SELECT `hotel`.*, `room`.`price`
                    FROM `hotel` 
                    JOIN `room` ON `room`.`hotel_id` = `hotel`.`id`
                    WHERE `room`.`price` > 1000000
                    GROUP BY `hotel`.`name`
                ";
        $data['hotel'] = $this->db->query($query)->result_array();

        $query1 = "SELECT `room`.`price`
                    FROM `room`
                    JOIN `hotel` ON `room`.`hotel_id` = `hotel`.`id`
                    GROUP BY `hotel`.`id` ASC
                ";
        $data['room'] = $this->db->query($query1)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/hotellist', $data);
        $this->load->view('templates/footer');
    }
}
