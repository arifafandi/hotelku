<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //load model dashboard
        $this->load->model('home_model');
        $this->load->helper('konfigurasi_helper');
        //load model auth
        $this->load->model('auth_model');
    }

    public function index()
    {
        $data['title'] = "Home";
        $data['rooms_type'] = $this->home_model->get_rooms_type();
        $data['rooms_available'] = $this->home_model->get_rooms_available();
        $this->load->view('home', $data);
    }

    public function room_detail($id)
    {
        $data['title'] = "Booking";
        $query = $this->home_model->get_detail_rooms($id);
        // validasi jika data ditemukan
        if ($query->num_rows() > 0) {
            $data['detail'] = $query;
            $data['rooms_available'] = $this->home_model->get_rooms_available();
            // // load view
            $this->load->view('room_detail', $data);
        } else {
            //jika data tidak ditemukan
            show_404();
        }
    }

    public function register()
    {
        if (!$this->auth_model->logged_id()) {
            $this->load->view('register');
        } else {
            redirect(base_url());
        }
    }

    public function register_proses()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('identity', 'Identity Number', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

            date_default_timezone_set('Asia/Jakarta');

            $mail = str_replace("'", "", htmlspecialchars(strtolower($this->input->post('email')), ENT_QUOTES));

            $register = array(
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
                redirect(base_url('register'));
            } else {
                $this->db->insert('users', $register);
                $this->session->set_flashdata('success', "Register successfully");
                redirect(base_url('login'));
            }
        } else {
            $this->session->set_flashdata('error', "Registration failed.");
            redirect(base_url('register'));
        }
    }

    public function login()
    {
        if ($this->auth_model->logged_id()) {
            //jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
            if ($this->session->userdata('id_group') == '1') {
                redirect(base_url('admin'));
            } else {
                redirect(base_url());
            }
        } else {
            //jika session belum terdaftar
            //set form validation
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            //set message form validation
            $this->form_validation->set_message('required', '<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> {field} tidak boleh kosong!</div>');

            //cek validasi
            if ($this->form_validation->run() == TRUE) {

                //get data dari FORM
                $email = str_replace("'", "", htmlspecialchars($this->input->post("email", TRUE), ENT_QUOTES));
                $password = MD5($this->input->post('password', TRUE));

                //checking data via model
                $checking = $this->auth_model->check_login('users', array('email' => $email), array('password' => $password));

                //jika ditemukan, maka create session
                if ($checking != FALSE) {
                    foreach ($checking as $apps) {
                        $session_data = array(
                            'id'   => $apps->id,
                            'id_group'   => $apps->id_group,
                            'name' => $apps->name,
                            'email' => $apps->email,
                            'password' => $apps->password,
                            'identity_number' => $apps->identity,
                            'city' => $apps->city,
                            'phone' => $apps->phone,
                            'created_at' => $apps->created_at,
                            'updated_at' => $apps->updated_at,

                        );
                        //set session userdata
                        $this->session->set_userdata($session_data);

                        if ($this->session->userdata('id_group') == '1') {
                            redirect(base_url('admin'));
                        } else {
                            redirect(base_url());
                        }
                    }
                } else {
                    $this->session->set_flashdata('error', "Email or Password wrong!");
                    $this->load->view('login');
                }
            } else {
                $this->load->view('login');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }

    public function booking()
    {
        if ($this->auth_model->logged_id()) {
            $this->form_validation->set_rules('checkin', 'Check In', 'required');
            $this->form_validation->set_rules('checkout', 'Check Out', 'required');
            if ($this->form_validation->run() == TRUE) {
                $diff = abs(strtotime($this->input->post('checkin')) - strtotime($this->input->post('checkout')));

                $years = floor($diff / (365 * 60 * 60 * 24));
                $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                $price = $this->input->post('price');
                $pricefix = $price * $days;

                $booking = array(
                    'id_user' => $this->session->userdata('id'),
                    'id_type' => $this->input->post('idtype'),
                    'check_in' => $this->input->post('checkin'),
                    'check_out' => $this->input->post('checkout'),
                    'price' => $pricefix
                );

                $this->db->insert('transactions', $booking);
                $this->session->set_flashdata('success', "Booking successfully");
                redirect(base_url('history'));
            } else {
                $this->session->set_flashdata('error', "Booking failed");
                redirect(base_url('room/') . $this->input->post('idtype'));
            }
        } else {
            redirect(base_url('login'));
        }
    }

    public function history()
    {
        $data['title'] = "History";
        if ($this->auth_model->logged_id()) {
            $data['title'] = "History";
            $data['history'] = $this->home_model->get_history($this->session->userdata('id'));
            $data['rooms'] = $this->home_model->get_rooms();
            $this->load->view('history', $data);
        } else {
            redirect(base_url('login'));
        }
    }

    public function payment($id)
    {
        if ($this->auth_model->logged_id()) {
            $config['upload_path']          = './assets/upload/payment';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 0;
            $config['max_width']            = 0;
            $config['max_height']           = 0;
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {

                $_data = array('upload_data' => $this->upload->data());
                date_default_timezone_set('Asia/Jakarta');

                $data = array(
                    'payment_proof' => $_data['upload_data']['file_name'],
                    'status' => 'PENDING'
                );

                $this->db->where('id', $id);
                $this->db->update('transactions', $data);
                $this->session->set_flashdata('success', "Payment successfully.");
                redirect(base_url('history'));
            } else {
                $this->session->set_flashdata('error', "Payment failed");
                redirect(base_url('history'));
            }
        } else {
            redirect(base_url('login'));
        }
    }
}
