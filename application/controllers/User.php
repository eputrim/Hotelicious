<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->helper('date');
    }

    public function index()
    {
        $data['title'] = 'Hotel';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['hotel'] = $this->db->get('hotel')->result_array();
        $query = "SELECT `room`.`price`
                    FROM `room`
                    JOIN `hotel` ON `room`.`hotel_id` = `hotel`.`id`
                    GROUP BY `hotel`.`id` ASC
                ";
        $data['room'] = $this->db->query($query)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/hotellist', $data);
        $this->load->view('templates/footer');
    }

    public function hotelDetail($hotel_id)
    {
        $data['title'] = 'Hotel';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['hotel'] = $this->db->get_where('hotel', ['id' => $hotel_id])->row_array();
        $data['room'] = $this->db->get_where('room', ['hotel_id' => $hotel_id])->result_array();

        $query = "SELECT `hotel`.*, `hotel_feature`.*, `hotel_detail`.* 
                    FROM `hotel` 
                    JOIN `hotel_detail` ON `hotel_detail`.`hotel_id` = `hotel`.`id` 
                    JOIN `hotel_feature` ON `hotel_detail`.`feature_id` = `hotel_feature`.`id` 
                    WHERE `hotel`.`id` = $hotel_id
                ";
        $data['hotel_feature'] = $this->db->query($query)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/hoteldetail', $data);
        $this->load->view('templates/footer');
    }

    public function roomDetail($room_id)
    {
        $data['title'] = 'Hotel';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['room'] = $this->db->get_where('room', ['id' => $room_id])->row_array();

        $query = "SELECT `room`.*, `room_feature`.*, `room_detail`.* 
                    FROM `room` 
                    JOIN `room_detail` ON `room_detail`.`room_id` = `room`.`id` 
                    JOIN `room_feature` ON `room_detail`.`feature_id` = `room_feature`.`id` 
                    JOIN `hotel` ON `room`.`hotel_id` = `hotel`.`id` 
                    WHERE `room`.`id` = $room_id
                ";
        $data['room_feature'] = $this->db->query($query)->result_array();

        $query2 = "SELECT `hotel`.`name`
                    FROM `hotel`
                    JOIN `room` ON `room`.`hotel_id` = `hotel`.`id`
                    WHERE `room`.`id` = $room_id
                ";
        $data['hotel'] = $this->db->query($query2)->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/roomdetail', $data);
        $this->load->view('templates/footer');
    }

    public function bookRoom($room_id)
    {
        $data['title'] = 'Hotel';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['room'] = $this->db->get_where('room', ['id' => $room_id])->row_array();

        $query = "SELECT `hotel`.`name`
                    FROM `hotel`
                    JOIN `room` ON `room`.`hotel_id` = `hotel`.`id`
                    WHERE `room`.`id` = $room_id
                 ";
        $data['hotel'] = $this->db->query($query)->row_array();

        if ($data['room']['count'] < 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sorry, we are out of this type of room. Please choose another one.</div>');
            redirect('user/roomdetail/$room_id');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/bookroom', $data);
            $this->load->view('templates/footer');
        }
    }

    public function compareData()
    {
        $startDate = strtotime($this->input->post('checkin', true));
        $endDate = strtotime($this->input->post('checkout', true));

        if ($endDate > $startDate) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function bookProcess($room_id)
    {
        $data['title'] = 'Hotel';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['room'] = $this->db->get_where('room', ['id' => $room_id])->row_array();

        $query = "SELECT `hotel`.`name`
                    FROM `hotel`
                    JOIN `room` ON `room`.`hotel_id` = `hotel`.`id`
                    WHERE `room`.`id` = $room_id
                ";
        $data['hotel'] = $this->db->query($query)->row_array();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('checkin', 'Check-in Date', 'required|callback_compareData', [
            'callback_compareDate' => 'The end date can not be lesser than the start date!',
        ]);
        $this->form_validation->set_rules('checkout', 'Check-out Date', 'required|callback_compareData');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/bookroom', $data);
            $this->load->view('templates/footer');
        } else {
            $checkin = $this->input->post('checkin', true);
            $checkout = $this->input->post('checkout', true);

            $diff = strtotime($checkin) - strtotime($checkout);
            // 1 day = 24 hours 
            // 24 * 60 * 60 = 86400 seconds 
            $duration = abs(round($diff / 86400));
            $price = $data['room']['price'] * $duration;

            $data['booking'] = [
                'user_id' => $data['user']['id'],
                'name' => $this->input->post('name', true),
                'phone' => $this->input->post('phone', true),
                'email' => $this->input->post('email', true),
                'room_id' => $room_id,
                'check_in' => $checkin,
                'check_out' => $checkout,
                'duration' => $duration,
                'price' => $price,
                'order_date' => time()
            ];

            $this->db->insert('orders', $data['booking']);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Booking Success!</div>');

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/bookdetail', $data);
            $this->load->view('templates/footer');
        }
    }

    public function orders()
    {
        $data['title'] = 'Order History';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['orders'] = $this->db->get_where('orders', ['user_id' => $data['user']['id']])->result_array();

        $userid = $data['user']['id'];
        $query = "SELECT `hotel`.* 
                    FROM `hotel`
                    JOIN `room` ON `room`.`hotel_id` = `hotel`.`id`
                    JOIN `orders` ON `orders`.`room_id` = `room`.`id`
                    WHERE `orders`.`user_id` = $userid
                ";
        $data['hotel'] = $this->db->query($query)->result_array();

        $query1 = "SELECT `room`.*
                    FROM `room`
                    JOIN `orders` ON `room`.`id` = `orders`.`room_id`
                    WHERE `orders`.`user_id` = $userid
                ";
        $data['room'] = $this->db->query($query1)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/orders', $data);
        $this->load->view('templates/footer');
    }

    public function vieworders($orders_id)
    {
        $data['title'] = 'Order History';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['booking'] = $this->db->get_where('orders', ['id' => $orders_id])->row_array();

        $orderroom = $data['booking']['room_id'];
        $query = "SELECT `room`.*
                    FROM `room`
                    JOIN `orders` ON `orders`.`room_id` = `room`.`id`
                    WHERE `room`.`id` = $orderroom
                ";
        $data['room'] = $this->db->query($query)->row_array();

        $query2 = "SELECT `hotel`.`name`
                    FROM `hotel`
                    JOIN `room` ON `room`.`hotel_id` = `hotel`.`id`
                    WHERE `room`.`id` = $orderroom
                ";
        $data['hotel'] = $this->db->query($query2)->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/bookdetail', $data);
        $this->load->view('templates/footer');
    }

    public function profile()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/profile', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('birthdate', 'Birth Date', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name', true);
            $email = $this->input->post('email', true);
            $birthdate = $this->input->post('birthdate', true);

            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2000';
                $config['upload_path']   = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->set('birthdate', $birthdate);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Edit has been saved!</div>');
            redirect('user/profile');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[6]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password can not be the same as current password!</div>');
                    redirect('user/changepassword');
                } else {
                    //password ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed!</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }
}
