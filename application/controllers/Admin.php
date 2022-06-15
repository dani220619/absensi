<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('user_agent');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Mod_admin');
    }
    public function index()
    {
        $data['users'] = $this->db->get_where(
            'users',
            ['username' => $this->session->userdata('username')]
        )->row_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/footer');
    }
    public function aplikasi()
    {
        $data['title'] = "Aplikasi";
        $data['users'] = $this->db->get_where(
            'users',
            ['username' => $this->session->userdata('username')]
        )->row_array();
        $data['apl'] = $this->db->get('aplikasi')->result();
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/aplikasi', $data);
        $this->load->view('template/footer');
    }
    public function update_aplikasi()
    {
        if (!empty($_FILES['imagefile']['name'])) {

            $id = $this->input->post('id');
            $nama = slug($this->input->post('logo'));
            $config['upload_path']   = './assets/foto/logo/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '6000';
            $config['max_width']     = '6000';
            $config['max_height']    = '6024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();
                $save  = array(
                    'nama_owner' => $this->input->post('nama_owner'),
                    'title' => $this->input->post('title'),
                    'nama_aplikasi'  => $this->input->post('nama_aplikasi'),
                    'copy_right'  => $this->input->post('copy_right'),
                    'tahun' => $this->input->post('tahun'),
                    'versi' => $this->input->post('versi'),
                    'logo' => $gambar['file_name']
                );
                // dead($save);
                $g = $this->Mod_admin->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/logo/' . $g['logo']);
                }

                $this->Mod_admin->updateAplikasi($id, $save);
                $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Update Aplikasi Berhasil',
                    icon: 'success'
                    });
                </script>");
                redirect('admin/aplikasi');
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'nama_owner' => $this->input->post('nama_owner'),
                    'title' => $this->input->post('title'),
                    'nama_aplikasi'  => $this->input->post('nama_aplikasi'),
                    'copy_right'  => $this->input->post('copy_right'),
                    'tahun' => $this->input->post('tahun'),
                    'versi' => $this->input->post('versi')
                );
                $this->Mod_admin->updateAplikasi($id, $save);
                $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Update Aplikasi Berhasil',
                    icon: 'success'
                    });
                </script>");
                redirect('admin/aplikasi');
            }
        } else {

            $id = $this->input->post('id');
            $save  = array(
                'nama_owner' => $this->input->post('nama_owner'),
                'alamat'    => $this->input->post('alamat'),
                'tlp'       => $this->input->post('tlp'),
                'title' => $this->input->post('title'),
                'nama_aplikasi'  => $this->input->post('nama_aplikasi'),
                'copy_right'  => $this->input->post('copy_right'),
                'tahun' => $this->input->post('tahun'),
                'versi' => $this->input->post('versi')
            );
            // dead($save);
            $this->Mod_admin->updateAplikasi($id, $save);
            $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Update Aplikasi Berhasil',
                    icon: 'success'
                    });
                </script>");

            redirect('admin/aplikasi');
        }
    }
    public function user()
    {
        $data['title'] = "User Data";
        $data['users'] = $this->db->get_where(
            'users',
            ['username' => $this->session->userdata('username')]
        )->row_array();
        $data['is_active'] = ['Y', 'N'];
        $data['user_level'] = $this->Mod_admin->userlevel();
        $data['user'] = $this->Mod_admin->admin()->result();
        // dead($data['is_active']);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/user', $data);
        $this->load->view('template/footer');
    }
    public function insert_admin()
    {
        // var_dump($this->input->post('username'));
        // $this->_validate();
        $username = $this->input->post('username');
        $cek = $this->Mod_admin->cekUsername($username);
        if ($cek->num_rows() > 0) {
            echo json_encode(array("error" => "Username Sudah Ada!!"));
        } else {
            $nama = slug($this->input->post('username'));
            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();

                $save  = array(
                    'username' => $this->input->post('username'),
                    'nama_lengkap' => $this->input->post('nama_lengkap'),
                    'email' => $this->input->post('email'),
                    'password'  => get_hash($this->input->post('password')),
                    'id_level'  => $this->input->post('id_level'),
                    'tlp'  => $this->input->post('tlp'),
                    'is_active' => $this->input->post('is_active'),
                    'date_created' => date("Y-m-d H:i:s"),
                    'image' => $gambar['file_name']
                );
                // dead($save);
                $this->db->insert("users", $save);
                $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Admin telah Ditambahkan',
                    icon: 'success'
                    });
                </script>");
                redirect($_SERVER['HTTP_REFERER']);
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nama_lengkap' => $this->input->post('nama_lengkap'),
                    'email' => $this->input->post('email'),
                    'password'  => get_hash($this->input->post('password')),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('id_level'),
                    'is_active' => $this->input->post('is_active'),
                    'date_created' => date("Y-m-d H:i:s")
                );
                // dead($save);
                $this->db->insert("users", $save);
                $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Admin telah Ditambahkan',
                    icon: 'success'
                    });
                </script>");
                redirect($_SERVER['HTTP_REFERER']);
                // echo json_encode(array("status" => TRUE));
            }
        }
    }
    public function update_admin()
    {
        if (!empty($_FILES['imagefile']['name'])) {
            // $this->_validate();
            $id = $this->input->post('id');

            $nama = slug($this->input->post('username'));

            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();
                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nama_lengkap' => $this->input->post('nama_lengkap'),
                        'email' => $this->input->post('email'),
                        'password'  => get_hash($this->input->post('password')),
                        'id_level'  => $this->input->post('id_level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'date_created' => date("Y-m-d H:i:s"),
                        'image' => $gambar['file_name']
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nama_lengkap' => $this->input->post('nama_lengkap'),
                        'email' => $this->input->post('email'),
                        'id_level'  => $this->input->post('id_level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'date_created' => date("Y-m-d H:i:s"),
                        'image' => $gambar['file_name']
                    );
                }
                // dead($save);

                $g = $this->Mod_admin->getImageuser($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/user/' . $g['image']);
                }
                $this->Mod_admin->updateUser($id, $save);
                $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Admin telah Diubah',
                    icon: 'success'
                    });
                </script>");
                redirect($_SERVER['HTTP_REFERER']);
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload

                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nama_lengkap' => $this->input->post('nama_lengkap'),
                        'email' => $this->input->post('email'),
                        'password'  => get_hash($this->input->post('password')),
                        'id_level'  => $this->input->post('id_level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'date_created' => date("Y-m-d H:i:s"),
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nama_lengkap' => $this->input->post('nama_lengkap'),
                        'email' => $this->input->post('email'),
                        'id_level'  => $this->input->post('id_level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'date_created' => date("Y-m-d H:i:s"),
                    );
                }
                // dead($save);
                $this->Mod_admin->updateUser($id, $save);
                $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Admin telah Diubah',
                    icon: 'success'
                    });
                </script>");
                redirect($_SERVER['HTTP_REFERER']);
                // echo json_encode(array("status" => TRUE));
            }
        } else {
            $id_user = $this->input->post('id');
            if ($this->input->post('password')) {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nama_lengkap' => $this->input->post('nama_lengkap'),
                    'email' => $this->input->post('email'),
                    'id_level'  => $this->input->post('id_level'),
                    'tlp'  => $this->input->post('tlp'),
                    'is_active' => $this->input->post('is_active'),
                    'date_created' => date("Y-m-d H:i:s"),
                );
            } else {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nama_lengkap' => $this->input->post('nama_lengkap'),
                    'email' => $this->input->post('email'),
                    'id_level'  => $this->input->post('id_level'),
                    'tlp'  => $this->input->post('tlp'),
                    'is_active' => $this->input->post('is_active'),
                    'date_created' => date("Y-m-d H:i:s"),
                );
            }
            // dead($save);
            $this->Mod_admin->updateUser($id_user, $save);
            $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Admin telah Diubah',
                    icon: 'success'
                    });
                </script>");
            redirect($_SERVER['HTTP_REFERER']);
            // echo json_encode(array("status" => TRUE));
        }
    }

    public function delete_admin($id)
    {

        $g = $this->Mod_admin->getImageuser($id)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/foto/user/' . $g['image']);
        }
        $this->Mod_admin->deleteAdmin($id, 'users');
        $this->session->set_flashdata('success', "<script>
            swal({
            text: 'Admin telah dihapus',
            icon: 'success'
            });
        </script>");
        redirect($_SERVER['HTTP_REFERER']);
    }
}