<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Create By ARYO
 */
class Mod_admin extends CI_Model
{
    public function count_all()
    {

        $this->db->from('aplikasi');
        return $this->db->count_all_results();
    }

    function getAll()
    {
        return $this->db->get("aplikasi");
    }
    function getAplikasi($id)
    {
        $this->db->where("id", $id);
        return $this->db->get("aplikasi")->row();
    }

    function updateAplikasi($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('aplikasi', $data);
    }

    function getImage($id)
    {
        $this->db->select('logo');
        $this->db->from('aplikasi');
        $this->db->where('id', $id);
        return $this->db->get();
    }
    function userlevel()
    {
        return $this->db->order_by('id_level ASC')
            ->get('userlevel')
            ->result();
    }
    public function admin()
    {
        $query = $this->db->query("
        select u.*, ul.nama_level 
        from users u
        left join userlevel ul
        on u.id_level=ul.id_level
        ");
        return $query;
    }

    function cekUsername($username)
    {
        $this->db->where("username", $username);
        return $this->db->get("users");
    }
    function getImageuser($id)
    {
        $this->db->select('image');
        $this->db->from('users');
        $this->db->where('id', $id);
        return $this->db->get();
    }
    function updateUser($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }
    function deleteAdmin($id, $table)
    {
        $this->db->where('id', $id);
        $this->db->delete($table);
    }
    public function pegawai()
    {
        $query = $this->db->query("
        select u.*, ul.nama_level 
        from users u
        left join userlevel ul
        on u.id_level=ul.id_level
        where u.id_level = '2'
        ");
        return $query;
    }
    public function pegawaiedit($id)
    {
        $query = $this->db->query("
        select u.*, ul.nama_level 
        from users u
        left join userlevel ul
        on u.id_level=ul.id_level
        where u.id_level = '2' and u.nip = '" . $id . "'
        ");
        return $query;
    }
    function updatepegawai($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }
}
