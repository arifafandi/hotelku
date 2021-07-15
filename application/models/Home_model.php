<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{
    function get_rooms_type()
    {
        $query = "SELECT * FROM rooms_type ORDER BY id DESC";
        $data['rooms_type'] = $this->db->query($query)->result();

        return $data;
    }

    function get_rooms_available()
    {
        $query = "SELECT COUNT(rooms.id) AS jumlah, rooms_type.name AS type FROM rooms INNER JOIN rooms_type ON rooms.id_type = rooms_type.id WHERE rooms.status = 'unbooked' GROUP BY rooms.id_type";
        $data['rooms_available'] = $this->db->query($query)->result();

        return $data;
    }

    function get_detail_rooms($id)
    {
        $query = "SELECT * FROM rooms_type WHERE id = '$id' ORDER BY id DESC LIMIT 1";
        $query = $this->db->query($query);

        return $query;
    }

    // function get_room_booking($id)
    // {
    //     $query = "SELECT a.number AS number FROM rooms a INNER JOIN rooms_type b ON a.id_type = b.id WHERE a.id_type = '$id' AND a.status = 'unbooked' LIMIT 1";
    //     $data['rooms_free'] = $this->db->query($query)->result();

    //     return $data;
    // }

    function get_history($id)
    {
        $query = "SELECT a.*, b.name AS type_name, b.price AS type_price, b.image AS image FROM transactions a INNER JOIN rooms_type b ON a.id_type = b.id WHERE a.id_user = '$id' ORDER BY a.id DESC";
        $data['history'] = $this->db->query($query)->result();

        return $data;
    }

    function get_rooms()
    {
        $query = "SELECT * FROM rooms";
        $data['rooms'] = $this->db->query($query)->result();

        return $data;
    }

    function get_menus()
    {
        $query = "SELECT * FROM menus WHERE display = '1'";
        $data['menus'] = $this->db->query($query)->result();

        return $data;
    }
}
