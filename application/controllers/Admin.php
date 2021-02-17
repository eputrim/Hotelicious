<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('graphic_model');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['hasil'] = $this->graphic_model->userperbulan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function hotel()
    {
        $data['title'] = 'Hotel Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['hotel'] = $this->db->get('hotel')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/hotel', $data);
        $this->load->view('templates/footer');
    }

    public function viewHotel($hotel_id)
    {
        $data['title'] = 'Hotel Detail';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['hotel'] = $this->db->get_where('hotel', ['id' => $hotel_id])->row_array();

        $query = "SELECT `hotel`.*, `hotel_feature`.*, `hotel_detail`.* 
                    FROM `hotel` 
                    JOIN `hotel_detail` ON `hotel_detail`.`hotel_id` = `hotel`.`id` 
                    JOIN `hotel_feature` ON `hotel_detail`.`feature_id` = `hotel_feature`.`id` 
                    WHERE `hotel`.`id` = $hotel_id
                    GROUP BY `hotel_detail`.`feature_id`
                ";
        $data['hotel_feature'] = $this->db->query($query)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/viewhotel', $data);
        $this->load->view('templates/footer');
    }

    public function addHotel()
    {
        $data['title'] = 'Hotel Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['hotel'] = $this->db->get('hotel')->result_array();

        $this->form_validation->set_rules('name', 'Hotel Name', 'required');
        $this->form_validation->set_rules('location', 'Hotel Address', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('star', 'Star', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/hotel', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'name' => $this->input->post('name', true),
                'location' => $this->input->post('location', true),
                'city' => $this->input->post('city', true),
                'star' => $this->input->post('star', true),
                'image' => 'default.jpg',
            ];

            $this->db->insert('hotel', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New hotel has been added!</div>');
            redirect('admin/hotel');
        }
    }

    public function editHotel($hotel_id)
    {
        $data['title'] = 'Edit Hotel';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['hotel'] = $this->db->get_where('hotel', ['id' => $hotel_id])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/edithotel', $data);
        $this->load->view('templates/footer');
    }

    public function doEditHotel()
    {
        $this->form_validation->set_rules('name', 'Hotel Name', 'required');
        $this->form_validation->set_rules('location', 'Hotel Address', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('star', 'Star', 'required');

        if ($this->form_validation->run() == false) {
            redirect('admin/edithotel');
        } else {
            $id = $this->input->post('id');
            $name = $this->input->post('name');
            $location = $this->input->post('location');
            $city = $this->input->post('city');
            $star = $this->input->post('star');

            $data['hotel'] = $this->db->get_where('hotel', ['id' => $id])->row_array();

            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '2000';
                $config['upload_path']   = './assets/img/hotel/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['hotel']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/hotel/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->set('location', $location);
            $this->db->set('city', $city);
            $this->db->set('star', $star);
            $this->db->where('id', $id);
            $this->db->update('hotel');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Edit has been saved!</div>');
            redirect('admin/hotel');
        }
    }

    public function facilityToHotel($hotel_id)
    {
        $data['title'] = 'Add Hotel Facilities';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['hotel'] = $this->db->get_where('hotel', ['id' => $hotel_id])->row_array();
        $data['hotel_feature'] = $this->db->get('hotel_feature')->result_array();

        $query = "SELECT `hotel_feature`.*
                    FROM `hotel_feature`
                    JOIN `hotel_detail` ON `hotel_detail`.`feature_id` = `hotel_feature`.`id`
                    JOIN `hotel` ON `hotel`.`id` = `hotel_detail`.`hotel_id`
                    WHERE `hotel`.`id` = $hotel_id 
                    GROUP BY `hotel_detail`.`feature_id`
                ";
        $data['used'] = $this->db->query($query)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/facilitytohotel', $data);
        $this->load->view('templates/footer');
    }

    public function addFacilityToHotel()
    {
        $data['title'] = 'Add Hotel Facilities';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $hotel_id = $this->input->post('id', true);

        $data['hotel_feature'] = $this->db->get('hotel_feature')->result_array();
        $data['hotel_detail'] = $this->db->get_where('hotel_detail', ['hotel_id' => $hotel_id])->result_array();

        $this->form_validation->set_rules('name', 'Hotel Name', 'required');
        $this->form_validation->set_rules('facility_id', 'New Hotel Facility', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/facilitytohotel/' . $hotel_id, $data);
            $this->load->view('templates/footer');
        } else {
            $feature_id = $this->input->post('facility_id', true);

            $data = [
                'hotel_id' => $hotel_id,
                'feature_id' => $feature_id
            ];
            $this->db->insert('hotel_detail', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New hotel facility has been added!</div>');
            redirect('admin/viewhotel/' . $hotel_id);
        }
    }

    public function deleteHotel($hotel_id)
    {
        $data = $this->db->get_where('hotel', ['id' => $hotel_id])->row_array();
        $this->db->delete('hotel', $data);

        $data1 = $this->db->get_where('room', ['hotel_id' => $hotel_id])->result_array();
        $a = $this->db->get_where('room', ['hotel_id' => $hotel_id])->num_rows();

        for ($i = 0; $i < $a; $i++) {
            $this->db->delete('room', $data1[$i]);
        };

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hotel successfully deleted!</div>');
        redirect('admin/hotel');
    }

    public function hotelFacility()
    {
        $data['title'] = 'Hotel Facilities';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['hotel_feature'] = $this->db->get('hotel_feature')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/hotelfacility', $data);
        $this->load->view('templates/footer');
    }

    public function addHotelFacility()
    {
        $data['title'] = 'Hotel Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['hotel_feature'] = $this->db->get('hotel_feature')->result_array();

        $this->form_validation->set_rules('name', 'Hotel Facility Name', 'required|trim');
        $this->form_validation->set_rules('icon', 'Hotel Facility Icon Code', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/hotelfacility', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'feature' => $this->input->post('name', true),
                'icon' => $this->input->post('icon', true),
            ];

            $this->db->insert('hotel_feature', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New hotel facility has been added!</div>');
            redirect('admin/hotelfacility');
        }
    }

    public function editHotelFacility($feature_id)
    {
        $data['title'] = 'Edit Hotel Facility';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['hotel_feature'] = $this->db->get_where('hotel_feature', ['id' => $feature_id])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/edithotelfacility', $data);
        $this->load->view('templates/footer');
    }

    public function doEditHotelFacility()
    {
        $this->form_validation->set_rules('name', 'Hotel Facility Name', 'required|trim');
        $this->form_validation->set_rules('icon', 'Hotel Facility Icon Code', 'required');

        if ($this->form_validation->run() == false) {
            redirect('admin/edithotelfacility');
        } else {
            $id = $this->input->post('id');
            $name = $this->input->post('name');
            $icon = $this->input->post('icon');

            $data['hotel_feature'] = $this->db->get_where('hotel_feature', ['id' => $id])->row_array();

            $this->db->set('feature', $name);
            $this->db->set('icon', $icon);
            $this->db->where('id', $id);
            $this->db->update('hotel_feature');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Edit has been saved!</div>');
            redirect('admin/hotelfacility');
        }
    }

    public function deleteHotelFacility($feature_id)
    {
        $data = $this->db->get_where('hotel_feature', ['id' => $feature_id])->row_array();
        $this->db->delete('hotel_feature', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hotel Facility successfully deleted!</div>');
        redirect('admin/hotelfacility');
    }

    public function room()
    {
        $data['title'] = 'Room Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['hotel1'] = $this->db->get('hotel')->result_array();
        $data['room'] = $this->db->get('room')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/room', $data);
        $this->load->view('templates/footer');
    }

    public function facilityToRoom($room_id)
    {
        $data['title'] = 'Add Room Facilities';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['room'] = $this->db->get_where('room', ['id' => $room_id])->row_array();
        $data['room_feature'] = $this->db->get('room_feature')->result_array();

        $query = "SELECT `room_feature`.*
                    FROM `room_feature`
                    JOIN `room_detail` ON `room_detail`.`feature_id` = `room_feature`.`id`
                    JOIN `room` ON `room`.`id` = `room_detail`.`room_id`
                    WHERE `room`.`id` = $room_id 
                    GROUP BY `room_detail`.`feature_id`
                ";
        $data['used'] = $this->db->query($query)->result_array();

        $query1 = "SELECT `hotel`.*
                    FROM `hotel`
                    JOIN `room` ON `room`.`hotel_id` = `hotel`.`id`
                    WHERE `room`.`id` = $room_id
                    ";
        $data['hotel'] = $this->db->query($query1)->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/facilitytoroom', $data);
        $this->load->view('templates/footer');
    }

    public function addFacilityToRoom()
    {
        $data['title'] = 'Add Room Facilities';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $room_id = $this->input->post('id', true);

        $data['room_feature'] = $this->db->get('room_feature')->result_array();
        $data['room_detail'] = $this->db->get_where('room_detail', ['room_id' => $room_id])->result_array();

        $this->form_validation->set_rules('hname', 'Hotel Name', 'required');
        $this->form_validation->set_rules('rname', 'Room Type', 'required');
        $this->form_validation->set_rules('facility_id', 'New Room Facility', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/facilitytoroom/' . $room_id, $data);
            $this->load->view('templates/footer');
        } else {
            $feature_id = $this->input->post('facility_id', true);

            $data = [
                'room_id' => $room_id,
                'feature_id' => $feature_id
            ];
            $this->db->insert('room_detail', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New room facility has been added!</div>');
            redirect('admin/viewroom/' . $room_id);
        }
    }

    public function viewRoom($room_id)
    {
        $data['title'] = 'Room Detail';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['room'] = $this->db->get_where('room', ['id' => $room_id])->row_array();

        $query = "SELECT `room`.*, `room_feature`.*, `room_detail`.* 
                    FROM `room` 
                    JOIN `room_detail` ON `room_detail`.`room_id` = `room`.`id` 
                    JOIN `room_feature` ON `room_detail`.`feature_id` = `room_feature`.`id` 
                    JOIN `hotel` ON `room`.`hotel_id` = `hotel`.`id` 
                    WHERE `room`.`id` = $room_id
                    GROUP BY `room_detail`.`feature_id`
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
        $this->load->view('admin/viewroom', $data);
        $this->load->view('templates/footer');
    }

    public function addRoom()
    {
        $data['title'] = 'Room Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['hotel'] = $this->db->get('hotel')->result_array();
        $data['room'] = $this->db->get('room')->result_array();

        $this->form_validation->set_rules('hotel_id', 'Hotel Name', 'required');
        $this->form_validation->set_rules('name', 'Room Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|greater_than[0]');
        $this->form_validation->set_rules('count', 'Room Availability', 'required|greater_than[0]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/room', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'hotel_id' => $this->input->post('hotel_id', true),
                'name' => $this->input->post('name', true),
                'price' => $this->input->post('price', true),
                'count' => $this->input->post('count', true),
                'image' => 'default.jpg',
            ];

            $this->db->insert('room', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New room has been added!</div>');
            redirect('admin/room');
        }
    }

    public function editRoom($room_id)
    {
        $data['title'] = 'Edit Room';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['room'] = $this->db->get_where('room', ['id' => $room_id])->row_array();
        $data['hotel'] = $this->db->get_where('hotel', ['id' => $data['room']['hotel_id']])->row_array();

        $query = "SELECT `room`.*, `room_feature`.*, `room_detail`.* 
                    FROM `room` 
                    JOIN `room_detail` ON `room_detail`.`room_id` = `room`.`id` 
                    JOIN `room_feature` ON `room_detail`.`feature_id` = `room_feature`.`id` 
                    JOIN `hotel` ON `room`.`hotel_id` = `hotel`.`id` 
                    WHERE `room`.`id` = $room_id
                ";
        $data['room_feature'] = $this->db->query($query)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/editroom', $data);
        $this->load->view('templates/footer');
    }

    public function doEditRoom()
    {
        $this->form_validation->set_rules('hotel_id', 'Hotel Name', 'required');
        $this->form_validation->set_rules('name', 'Room Name', 'required');
        $this->form_validation->set_rules('price', 'Price per Night', 'required|integer');
        $this->form_validation->set_rules('count', 'Room Availability', 'required|integer');

        if ($this->form_validation->run() == false) {
            redirect('admin/room');
        } else {
            $id = $this->input->post('id');
            $hotel_id = $this->input->post('hotel_id');
            $name = $this->input->post('name');
            $price = $this->input->post('price');
            $count = $this->input->post('count');

            $data['room'] = $this->db->get_where('room', ['id' => $id])->row_array();

            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '2000';
                $config['upload_path']   = './assets/img/room/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['room']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/room/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->set('price', $price);
            $this->db->set('count', $count);
            $this->db->where('id', $id);
            $this->db->update('room');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Edit has been saved!</div>');
            redirect('admin/room');
        }
    }

    public function deleteRoom($room_id)
    {
        $data = $this->db->get_where('room', ['id' => $room_id])->row_array();
        $this->db->delete('room', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Room successfully deleted!</div>');
        redirect('admin/room');
    }

    public function roomFacility()
    {
        $data['title'] = 'Room Facilities';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['room_feature'] = $this->db->get('room_feature')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/roomfacility', $data);
        $this->load->view('templates/footer');
    }

    public function addRoomFacility()
    {
        $data['title'] = 'Room Facilities';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['room_feature'] = $this->db->get('room_feature')->result_array();

        $this->form_validation->set_rules('name', 'Room Facility Name', 'required|trim');
        $this->form_validation->set_rules('icon', 'Room Facility Icon Code', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/roomfacility', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'feature' => $this->input->post('name', true),
                'icon' => $this->input->post('icon', true),
            ];

            $this->db->insert('room_feature', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New room facility has been added!</div>');
            redirect('admin/roomfacility');
        }
    }

    public function editRoomFacility($feature_id)
    {
        $data['title'] = 'Edit Room Facility';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['room_feature'] = $this->db->get_where('room_feature', ['id' => $feature_id])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/editroomfacility', $data);
        $this->load->view('templates/footer');
    }

    public function doEditRoomFacility()
    {
        $this->form_validation->set_rules('name', 'Room Facility Name', 'required|trim');
        $this->form_validation->set_rules('icon', 'Room Facility Icon Code', 'required');

        if ($this->form_validation->run() == false) {
            redirect('admin/editroomfacility');
        } else {
            $id = $this->input->post('id');
            $name = $this->input->post('name');
            $icon = $this->input->post('icon');

            $data['room_feature'] = $this->db->get_where('room_feature', ['id' => $id])->row_array();

            $this->db->set('feature', $name);
            $this->db->set('icon', $icon);
            $this->db->where('id', $id);
            $this->db->update('room_feature');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Edit has been saved!</div>');
            redirect('admin/roomfacility');
        }
    }

    public function deleteRoomFacility($feature_id)
    {
        $data = $this->db->get_where('room_feature', ['id' => $feature_id])->row_array();
        $this->db->delete('room_feature', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Room Facility successfully deleted!</div>');
        redirect('admin/roomfacility');
    }
}
