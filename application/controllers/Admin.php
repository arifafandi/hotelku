<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('admin_model');
        // load helper
        $this->load->helper('konfigurasi_helper');
        //load model auth
        $this->load->model('auth_model');
    }

    public function index()
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('role') == 'admin') {
                $data['title'] = "Dashboard";
                $data['users'] = $this->admin_model->count_users();
                $data['rooms_type'] = $this->admin_model->count_rooms_type();
                $data['rooms'] = $this->admin_model->count_rooms();
                $data['transactions_success'] = $this->admin_model->count_transactions_success();
                $this->load->view('admin/dashboard', $data);
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function rooms_type()
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('role') == 'admin') {
                $data['title'] = "Rooms Type";
                $data['rooms_type'] = $this->admin_model->get_rooms_type();
                $this->load->view('admin/rooms_type', $data);
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function add_rooms_type()
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('role') == 'admin') {
                $this->form_validation->set_rules('name', 'Room Type', 'trim|required');

                $config['upload_path']          = './assets/upload/icon';
                $config['allowed_types']        = 'jpg|png|jpeg';
                $config['max_size']             = 0;
                $config['max_width']            = 0;
                $config['max_height']           = 0;
                $config['encrypt_name']         = TRUE;
                $this->load->library('upload', $config);

                if ($this->form_validation->run() == TRUE and $this->upload->do_upload('image')) {

                    $_data = array('upload_data' => $this->upload->data());
                    date_default_timezone_set('Asia/Jakarta');

                    $data = array(
                        'name' => $this->input->post('name'),
                        'image' => $_data['upload_data']['file_name'],
                        'price' => $this->input->post('price'),
                        'description' => $this->input->post('description')
                    );

                    $this->db->insert('rooms_type', $data);
                    $this->session->set_flashdata('success', "Room type successfully added.");
                    redirect(base_url('admin/rooms-type'));
                } else {
                    $this->session->set_flashdata('error', "Room type failed to add.");
                    redirect(base_url('admin/rooms-type'));
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function delete_rooms_type($id)
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('role') == 'admin') {
                if ($id == "") {
                    $this->session->set_flashdata('error', "Room type failed to remove.");
                    redirect(base_url('admin/rooms-type'));
                } else {
                    $this->db->where('id', $id);
                    $this->db->delete('rooms_type');
                    $this->session->set_flashdata('success', "Room type successfully removed.");
                    redirect(base_url('admin/rooms-type'));
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function update_rooms_type($id)
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('role') == 'admin') {
                $this->form_validation->set_rules('name', 'Room Type', 'trim|required');

                $config['upload_path']          = './assets/upload/icon';
                $config['allowed_types']        = 'jpg|png|jpeg';
                $config['max_size']             = 0;
                $config['max_width']            = 0;
                $config['max_height']           = 0;
                $config['encrypt_name']         = TRUE;
                $this->load->library('upload', $config);

                if ($this->form_validation->run() == TRUE and $this->upload->do_upload('image')) {

                    $_data = array('upload_data' => $this->upload->data());
                    date_default_timezone_set('Asia/Jakarta');

                    $data = array(
                        'name' => $this->input->post('name'),
                        'image' => $_data['upload_data']['file_name'],
                        'price' => $this->input->post('price'),
                        'description' => $this->input->post('description'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );

                    $this->db->where('id', $id);
                    $this->db->update('rooms_type', $data);
                    $this->session->set_flashdata('success', "Room type successfully edited.");
                    redirect(base_url('admin/rooms-type'));
                } elseif ($this->form_validation->run() == TRUE and !$this->upload->do_upload('image')) {
                    $data = array(
                        'name' => $this->input->post('name'),
                        'price' => $this->input->post('price'),
                        'description' => $this->input->post('description'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );

                    $this->db->where('id', $id);
                    $this->db->update('rooms_type', $data);
                    $this->session->set_flashdata('success', "Room type successfully edited.");
                    redirect(base_url('admin/rooms-type'));
                } else {
                    $this->session->set_flashdata('error', "Room type failed to edit.");
                    redirect(base_url('admin/rooms-type'));
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function rooms()
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('role') == 'admin') {
                $data['title'] = "Rooms";
                $data['rooms'] = $this->admin_model->get_rooms();
                $data['rooms_type'] = $this->admin_model->get_rooms_type();
                $this->load->view('admin/rooms', $data);
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function add_rooms()
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('role') == 'admin') {
                $this->form_validation->set_rules('number', 'Room Number', 'trim|required|is_unique[rooms.number]');
                $this->form_validation->set_rules('type', 'Room Type', 'trim|required');
                $this->form_validation->set_rules('status', 'Room Status', 'trim|required');

                if ($this->form_validation->run() == TRUE) {

                    $data = array(
                        'number' => $this->input->post('number'),
                        'id_type' => $this->input->post('type'),
                        'status' => $this->input->post('status')
                    );

                    $this->db->insert('rooms', $data);
                    $this->session->set_flashdata('success', "Room type successfully edded.");
                    redirect(base_url('admin/rooms'));
                } else {
                    $this->session->set_flashdata('error', "Room failed to add.");
                    redirect(base_url('admin/rooms'));
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function delete_rooms($id)
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('role') == 'admin') {
                if ($id == "") {
                    $this->session->set_flashdata('error', "Room failed to remove.");
                    redirect(base_url('admin/rooms'));
                } else {
                    $this->db->where('id', $id);
                    $this->db->delete('rooms');
                    $this->session->set_flashdata('success', "Room successfully removed.");
                    redirect(base_url('admin/rooms'));
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function update_rooms($id)
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('role') == 'admin') {
                $this->form_validation->set_rules('number', 'Room Number', 'trim|required');
                $this->form_validation->set_rules('type', 'Room Type', 'trim|required');
                $this->form_validation->set_rules('status', 'Room Status', 'trim|required');

                if ($this->form_validation->run() == TRUE) {

                    $data = array(
                        'number' => $this->input->post('number'),
                        'id_type' => $this->input->post('type'),
                        'status' => $this->input->post('status')
                    );

                    $this->db->where('id', $id);
                    $this->db->update('rooms', $data);
                    $this->session->set_flashdata('success', "Room successfully edited.");
                    redirect(base_url('admin/rooms'));
                } else {
                    $this->session->set_flashdata('error', "Room failed to adited.");
                    redirect(base_url('admin/rooms'));
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function booking_pending()
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('role') == 'admin') {
                $data['title'] = "Booking Pending";
                $data['pending'] = $this->admin_model->get_booking_pending();
                $data['rooms_unbooked'] = $this->admin_model->get_rooms_unbooked();
                $this->load->view('admin/booking_pending', $data);
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function approve_booking($id)
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('role') == 'admin') {
                $this->form_validation->set_rules('number', 'Room Number', 'trim|required');

                if ($this->form_validation->run() == TRUE) {

                    $data = array(
                        'id_room' => $this->input->post('number'),
                        'status' => 'SUCCESS'
                    );

                    $this->db->where('id', $id);
                    $this->db->update('transactions', $data);

                    $update_rooms = array(
                        'status' => 'booked'
                    );

                    $this->db->where('id', $this->input->post('number'));
                    $this->db->update('rooms', $update_rooms);

                    $this->session->set_flashdata('success', "Booking successfully approve.");
                    redirect(base_url('admin/booking_history'));
                } else {
                    $this->session->set_flashdata('error', "Booking failed to approve.");
                    redirect(base_url('admin/booking_pending'));
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function booking_history()
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('role') == 'admin') {
                $data['title'] = "Booking History";
                $data['history'] = $this->admin_model->get_booking_history();
                $data['rooms'] = $this->admin_model->get_rooms();
                $this->load->view('admin/booking_history', $data);
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function booking_unpaid()
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('role') == 'admin') {
                $data['title'] = "Booking Unpaid";
                $data['unpaid'] = $this->admin_model->get_booking_unpaid();
                $this->load->view('admin/booking_unpaid', $data);
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }
}
