<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    function get_rooms_type()
    {
        $query = "SELECT * FROM rooms_type ORDER BY id DESC";
        $data['rooms_type'] = $this->db->query($query)->result();

        return $data;
    }

    function get_rooms()
    {
        $query = "SELECT a.*, b.name AS type FROM rooms a INNER JOIN rooms_type b ON a.id_type = b.id ORDER BY a.id DESC";
        $data['rooms'] = $this->db->query($query)->result();

        return $data;
    }

    function get_booking_pending()
    {
        $query = "SELECT a.*, b.identity_number, b.name, c.name AS type_name FROM transactions a INNER JOIN users b ON a.id_user = b.id INNER JOIN rooms_type c ON a.id_type = c.id WHERE status = 'PENDING' ORDER BY id DESC";
        $data['pending'] = $this->db->query($query)->result();

        return $data;
    }

    function get_rooms_unbooked()
    {
        $query = "SELECT * FROM rooms WHERE status = 'unbooked'";
        $data['rooms_unbooked'] = $this->db->query($query)->result();

        return $data;
    }

    function get_booking_history()
    {
        $query = "SELECT a.*, b.identity_number, b.name, c.name AS type_name FROM transactions a INNER JOIN users b ON a.id_user = b.id INNER JOIN rooms_type c ON a.id_type = c.id WHERE status = 'SUCCESS' ORDER BY id DESC";
        $data['history'] = $this->db->query($query)->result();

        return $data;
    }

    function get_booking_unpaid()
    {
        $query = "SELECT a.*, b.identity_number, b.name, c.name AS type_name FROM transactions a INNER JOIN users b ON a.id_user = b.id INNER JOIN rooms_type c ON a.id_type = c.id WHERE status = 'UNPAID' ORDER BY id DESC";
        $data['unpaid'] = $this->db->query($query)->result();

        return $data;
    }

    public function count_rooms_type()
    {
        $sql = "SELECT count(id) as id FROM rooms_type";
        $result = $this->db->query($sql);
        return $result->row()->id;
    }

    public function count_rooms()
    {
        $sql = "SELECT count(id) as id FROM rooms";
        $result = $this->db->query($sql);
        return $result->row()->id;
    }

    public function count_transactions_success()
    {
        $sql = "SELECT count(id) as id FROM transactions WHERE status = 'SUCCESS'";
        $result = $this->db->query($sql);
        return $result->row()->id;
    }

    public function count_users()
    {
        $sql = "SELECT count(id) as id FROM users";
        $result = $this->db->query($sql);
        return $result->row()->id;
    }

    function get_users()
    {
        $query = "SELECT * FROM users ORDER BY id DESC";
        $data['users'] = $this->db->query($query)->result();

        return $data;
    }

    function get_groups()
    {
        $query = "SELECT * FROM groups ORDER BY id DESC";
        $data['groups'] = $this->db->query($query)->result();

        return $data;
    }
}
