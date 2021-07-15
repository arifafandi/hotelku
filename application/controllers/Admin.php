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
            if ($this->session->userdata('id_group') == '1') {
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
            if ($this->session->userdata('id_group') == '1') {
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
            if ($this->session->userdata('id_group') == '1') {
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
            if ($this->session->userdata('id_group') == '1') {
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
            if ($this->session->userdata('id_group') == '1') {
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
            if ($this->session->userdata('id_group') == '1') {
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
            if ($this->session->userdata('id_group') == '1') {
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
            if ($this->session->userdata('id_group') == '1') {
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
            if ($this->session->userdata('id_group') == '1') {
                $this->form_validation->set_rules('number', 'Room Number', 'trim|required');
                $this->form_validation->set_rules('type', 'Room Type', 'trim|required');
                $this->form_validation->set_rules('status', 'Room Status', 'trim|required');

                if ($this->form_validation->run() == TRUE) {

                    $data = array(
                        'number' => $this->input->post('number'),
                        'id_type' => $this->input->post('type'),
                        'status' => $this->input->post('status'),
                        'updated_at' => date('Y-m-d H:i:s')
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
            if ($this->session->userdata('id_group') == '1') {
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
            if ($this->session->userdata('id_group') == '1') {
                $this->form_validation->set_rules('number', 'Room Number', 'trim|required');

                if ($this->form_validation->run() == TRUE) {

                    $data = array(
                        'id_room' => $this->input->post('number'),
                        'status' => 'SUCCESS',
                        'updated_at' => date('Y-m-d H:i:s')
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
            if ($this->session->userdata('id_group') == '1') {
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
            if ($this->session->userdata('id_group') == '1') {
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

    public function users()
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('id_group') == '1') {
                $data['title'] = "Users Management";
                $data['users'] = $this->admin_model->get_users();
                $data['groups'] = $this->admin_model->get_groups();
                $this->load->view('admin/users', $data);
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function add_user()
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('id_group') == '1') {
                $this->form_validation->set_rules('name', 'Name', 'trim|required');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.email]');
                $this->form_validation->set_rules('password', 'Password', 'trim|required');
                $this->form_validation->set_rules('identity', 'Identity Number', 'trim|required');
                $this->form_validation->set_rules('city', 'City', 'trim|required');
                $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
                $this->form_validation->set_rules('group', 'Group', 'trim|required');

                if ($this->form_validation->run() == TRUE) {

                    date_default_timezone_set('Asia/Jakarta');

                    $mail = str_replace("'", "", htmlspecialchars(strtolower($this->input->post('email')), ENT_QUOTES));

                    $add = array(
                        'id_group' => $this->input->post('group'),
                        'name' => $this->input->post('name'),
                        'email' => strtolower(strtolower($this->input->post('email'))),
                        'password' => MD5($this->input->post('password')),
                        'identity_number' => $this->input->post('identity'),
                        'city' => $this->input->post('city'),
                        'phone' => $this->input->post('phone')
                    );

                    $cek_email = $this->db->query("SELECT * FROM users WHERE email = '$mail'");

                    if ($cek_email->num_rows()) {
                        $this->session->set_flashdata('error', "Email already exists.");
                        redirect(base_url('admin/users'));
                    } else {
                        $this->db->insert('users', $add);
                        $this->session->set_flashdata('success', "Add User successfully");
                        redirect(base_url('admin/users'));
                    }
                } else {
                    $this->session->set_flashdata('error', "Add User failed.");
                    redirect(base_url('admin/users'));
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function delete_user($id)
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('id_group') == '1') {
                if ($id == "") {
                    $this->session->set_flashdata('error', "User failed to remove.");
                    redirect(base_url('admin/users'));
                } else {
                    $this->db->where('id', $id);
                    $this->db->delete('users');
                    $this->session->set_flashdata('success', "User successfully removed.");
                    redirect(base_url('admin/users'));
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function edit_user($id)
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('id_group') == '1') {
                $this->form_validation->set_rules('name', 'Name', 'trim|required');
                $this->form_validation->set_rules('email', 'Email', 'trim|required');
                $this->form_validation->set_rules('identity', 'Identity Number', 'trim|required');
                $this->form_validation->set_rules('city', 'City', 'trim|required');
                $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
                $this->form_validation->set_rules('group', 'Group', 'trim|required');

                if ($this->form_validation->run() == TRUE) {

                    date_default_timezone_set('Asia/Jakarta');

                    if ($this->input->post('password') == '') {
                        $add = array(
                            'id_group' => $this->input->post('group'),
                            'name' => $this->input->post('name'),
                            'email' => strtolower(strtolower($this->input->post('email'))),
                            'identity_number' => $this->input->post('identity'),
                            'city' => $this->input->post('city'),
                            'phone' => $this->input->post('phone'),
                            'updated_at' => date('Y-m-d H:i:s')
                        );
                    }

                    if ($this->input->post('password') != '') {
                        $add = array(
                            'id_group' => $this->input->post('group'),
                            'name' => $this->input->post('name'),
                            'email' => strtolower(strtolower($this->input->post('email'))),
                            'password' => MD5($this->input->post('password')),
                            'identity_number' => $this->input->post('identity'),
                            'city' => $this->input->post('city'),
                            'phone' => $this->input->post('phone'),
                            'updated_at' => date('Y-m-d H:i:s')
                        );
                    }

                    $this->db->where('id', $id);
                    $this->db->update('users', $add);
                    $this->session->set_flashdata('success', "User successfully edited");
                    redirect(base_url('admin/users'));
                } else {
                    $this->session->set_flashdata('error', "Failed to adit user.");
                    redirect(base_url('admin/users'));
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function groups()
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('id_group') == '1') {
                $data['title'] = "Groups Management";
                $data['groups'] = $this->admin_model->get_groups();
                $this->load->view('admin/groups', $data);
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function add_group()
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('id_group') == '1') {
                $this->form_validation->set_rules('name', 'Name', 'trim|required');
                $this->form_validation->set_rules('description', 'Description', 'trim|required');

                if ($this->form_validation->run() == TRUE) {

                    $add = array(
                        'name' => $this->input->post('name'),
                        'description' => $this->input->post('description')
                    );

                    $this->db->insert('groups', $add);
                    $this->session->set_flashdata('success', "Add Group successfully");
                    redirect(base_url('admin/groups'));
                } else {
                    $this->session->set_flashdata('error', "Add Group failed.");
                    redirect(base_url('admin/groups'));
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function delete_group($id)
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('id_group') == '1') {
                if ($id == "") {
                    $this->session->set_flashdata('error', "Group failed to remove.");
                    redirect(base_url('admin/groups'));
                } else {
                    $this->db->where('id', $id);
                    $this->db->delete('groups');
                    $this->session->set_flashdata('success', "Group successfully removed.");
                    redirect(base_url('admin/groups'));
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function edit_group($id)
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('id_group') == '1') {
                $this->form_validation->set_rules('name', 'Name', 'trim|required');
                $this->form_validation->set_rules('description', 'Description', 'trim|required');

                if ($this->form_validation->run() == TRUE) {

                    date_default_timezone_set('Asia/Jakarta');

                    $add = array(
                        'name' => $this->input->post('name'),
                        'description' => $this->input->post('description'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );

                    $this->db->where('id', $id);
                    $this->db->update('groups', $add);
                    $this->session->set_flashdata('success', "Group successfully edited");
                    redirect(base_url('admin/groups'));
                } else {
                    $this->session->set_flashdata('error', "Failed to adit group.");
                    redirect(base_url('admin/groups'));
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function menus()
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('id_group') == '1') {
                $data['title'] = "Menus Management";
                $data['menus'] = $this->admin_model->get_menus();
                $this->load->view('admin/menus', $data);
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function add_menu()
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('id_group') == '1') {
                $this->form_validation->set_rules('name', 'Name', 'trim|required');
                $this->form_validation->set_rules('url', 'URL', 'trim|required');
                $this->form_validation->set_rules('display', 'Display', 'trim|required');

                if ($this->form_validation->run() == TRUE) {

                    $add = array(
                        'name' => $this->input->post('name'),
                        'url' => $this->input->post('url'),
                        'icon' => $this->input->post('icon'),
                        'display' => $this->input->post('display')
                    );

                    $this->db->insert('menus', $add);
                    $this->session->set_flashdata('success', "Add Menu successfully");
                    redirect(base_url('admin/menus'));
                } else {
                    $this->session->set_flashdata('error', "Add Menu failed.");
                    redirect(base_url('admin/menus'));
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function delete_menu($id)
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('id_group') == '1') {
                if ($id == "") {
                    $this->session->set_flashdata('error', "Group failed to remove.");
                    redirect(base_url('admin/groups'));
                } else {
                    $this->db->where('id', $id);
                    $this->db->delete('groups');
                    $this->session->set_flashdata('success', "Group successfully removed.");
                    redirect(base_url('admin/groups'));
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function edit_menu($id)
    {
        if ($this->auth_model->logged_id()) {
            if ($this->session->userdata('id_group') == '1') {
                $this->form_validation->set_rules('name', 'Name', 'trim|required');
                $this->form_validation->set_rules('url', 'URL', 'trim|required');
                $this->form_validation->set_rules('display', 'Display', 'trim|required');

                if ($this->form_validation->run() == TRUE) {

                    $add = array(
                        'name' => $this->input->post('name'),
                        'url' => $this->input->post('url'),
                        'icon' => $this->input->post('icon'),
                        'display' => $this->input->post('display')
                    );

                    $this->db->where('id', $id);
                    $this->db->update('menus', $add);
                    $this->session->set_flashdata('success', "Menu successfully edited");
                    redirect(base_url('admin/menus'));
                } else {
                    $this->session->set_flashdata('error', "Failed to edit Menu.");
                    redirect(base_url('admin/menus'));
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url('login'));
        }
    }
}
