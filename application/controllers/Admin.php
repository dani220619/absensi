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
                $this->Mod_admin->updatepegawai($id, $save);
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
                $this->Mod_admin->updatepegawai($id, $save);
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
            $this->Mod_admin->updatepegawai($id_user, $save);
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

    public function backup_data()
    {
        $data["title"]         = "Backup Database";
        $data['users'] = $this->db->get_where(
            'users',
            ['username' => $this->session->userdata('username')]
        )->row_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/backup_data', $data);
        $this->load->view('template/footer');
    }

    public function pegawai()
    {
        $data['title'] = "Data Pegawai";
        $data['users'] = $this->db->get_where(
            'users',
            ['username' => $this->session->userdata('username')]
        )->row_array();
        $data['is_active'] = ['Y', 'N'];
        $data['user_level'] = $this->Mod_admin->userlevel();
        $data['pegawai'] = $this->Mod_admin->pegawai()->result();
        // dead($data['is_active']);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/pegawai', $data);
        $this->load->view('template/footer');
    }
    public function add_pegawai()
    {
        $data['title'] = "Data Pegawai";
        $data['users'] = $this->db->get_where(
            'users',
            ['username' => $this->session->userdata('username')]
        )->row_array();
        // dead($data['users']);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/add_pegawai', $data);
        $this->load->view('template/footer');
    }
    public function insert_pegawai()
    {
        // var_dump($this->input->post('username'));
        // $this->_validate();
        $id = rand(000, 999);
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
                    'id' => $id,
                    'nip' => $this->input->post('nip'),
                    'username' => $this->input->post('username'),
                    'nama_lengkap' => $this->input->post('nama_lengkap'),
                    'email' => $this->input->post('email'),
                    'password'  => get_hash($this->input->post('password')),
                    'id_level'  => '2',
                    'is_active' => 'Y',
                    'image' => $gambar['file_name'],
                );
                $save1 = array(
                    'nip' => $this->input->post('nip'),
                    'npwp' => $this->input->post('npwp'),
                    'unit_kerja'  => $this->input->post('unit_kerja'),
                    'sub_unit_kerja'  => $this->input->post('sub_unit_kerja'),
                    'status_pegawai'  => $this->input->post('status_pegawai'),
                    'nama_jabatan'  => $this->input->post('nama_jabatan'),
                    'gol_pangkat'  => $this->input->post('gol_pangkat'),
                    'taspen'  => $this->input->post('taspen'),
                    'tempat_lahir'  => $this->input->post('tempat_lahir'),
                    'jenis_kelamin'  => $this->input->post('jenis_kelamin'),
                    'alamat'  => $this->input->post('alamat'),
                    'kota'  => $this->input->post('kota'),
                    'provinsi'  => $this->input->post('provinsi'),
                    'kabupaten'  => $this->input->post('kabupaten'),
                    'kode_pos'  => $this->input->post('kode_pos'),
                    'no_wa'  => $this->input->post('no_wa'),
                    'status_keluarga'  => $this->input->post('status_keluarga'),
                    'agama'  => $this->input->post('agama'),
                    'pen_terahir'  => $this->input->post('pen_terahir'),
                    'jurusan'  => $this->input->post('jurusan'),
                    'nama_sekolah'  => $this->input->post('nama_sekolah'),
                    'lulusan'  => $this->input->post('lulusan'),
                    'tlp'  => $this->input->post('tlp'),
                    'date_created' => date("Y-m-d H:i:s"),
                );
                // dead($save);
                $this->db->insert("users", $save);
                $this->db->insert("pegawai", $save1);
                $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Admin telah Ditambahkan',
                    icon: 'success'
                    });
                </script>");
                redirect('admin/pegawai');
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'id' => $id,
                    'nip' => $this->input->post('nip'),
                    'username' => $this->input->post('username'),
                    'nama_lengkap' => $this->input->post('nama_lengkap'),
                    'email' => $this->input->post('email'),
                    'password'  => get_hash($this->input->post('password')),
                    'id_level'  => '2',
                    'is_active' => 'Y',
                );
                $save1 = array(
                    'nip' => $this->input->post('nip'),
                    'npwp' => $this->input->post('npwp'),
                    'unit_kerja'  => $this->input->post('unit_kerja'),
                    'sub_unit_kerja'  => $this->input->post('sub_unit_kerja'),
                    'status_pegawai'  => $this->input->post('status_pegawai'),
                    'nama_jabatan'  => $this->input->post('nama_jabatan'),
                    'gol_pangkat'  => $this->input->post('gol_pangkat'),
                    'taspen'  => $this->input->post('taspen'),
                    'tempat_lahir'  => $this->input->post('tempat_lahir'),
                    'jenis_kelamin'  => $this->input->post('jenis_kelamin'),
                    'alamat'  => $this->input->post('alamat'),
                    'kota'  => $this->input->post('kota'),
                    'provinsi'  => $this->input->post('provinsi'),
                    'kabupaten'  => $this->input->post('kabupaten'),
                    'kode_pos'  => $this->input->post('kode_pos'),
                    'no_wa'  => $this->input->post('no_wa'),
                    'status_keluarga'  => $this->input->post('status_keluarga'),
                    'agama'  => $this->input->post('agama'),
                    'pen_terahir'  => $this->input->post('pen_terahir'),
                    'jurusan'  => $this->input->post('jurusan'),
                    'nama_sekolah'  => $this->input->post('nama_sekolah'),
                    'lulusan'  => $this->input->post('lulusan'),
                    'tlp'  => $this->input->post('tlp'),
                    'date_created' => date("Y-m-d H:i:s"),
                );
                // dead($save1);
                $this->db->insert("users", $save);
                $this->db->insert("pegawai", $save1);
                $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Admin telah Ditambahkan',
                    icon: 'success'
                    });
                </script>");
                redirect('admin/pegawai');
                // echo json_encode(array("status" => TRUE));
            }
        }
    }

    public function update_pegawai($id)
    {
        $data['users'] = $this->db->get_where(
            'users',
            ['username' => $this->session->userdata('username')]
        )->row_array();
        $data['pegawai'] = $this->Mod_admin->pegawaiedit($id)->row_array();
        // dead($data['pegawai']);
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/edit_pegawai', $data);
        $this->load->view('template/footer');
    }

    public function edit_pegawai()
    {
        if (!empty($_FILES['imagefile']['name'])) {
            // $this->_validate();
            $nip = $this->input->post('nip');

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
                        'nip' => $this->input->post('nip'),
                        'username' => $this->input->post('username'),
                        'nama_lengkap' => $this->input->post('nama_lengkap'),
                        'email' => $this->input->post('email'),
                        'password'  => get_hash($this->input->post('password')),
                        'id_level'  => '2',
                        'is_active' => 'Y',
                        'image' => $gambar['file_name'],
                    );
                    $save1 = array(
                        'nip' => $this->input->post('nip'),
                        'npwp' => $this->input->post('npwp'),
                        'unit_kerja'  => $this->input->post('unit_kerja'),
                        'sub_unit_kerja'  => $this->input->post('sub_unit_kerja'),
                        'status_pegawai'  => $this->input->post('status_pegawai'),
                        'nama_jabatan'  => $this->input->post('nama_jabatan'),
                        'gol_pangkat'  => $this->input->post('gol_pangkat'),
                        'taspen'  => $this->input->post('taspen'),
                        'tempat_lahir'  => $this->input->post('tempat_lahir'),
                        'jenis_kelamin'  => $this->input->post('jenis_kelamin'),
                        'alamat'  => $this->input->post('alamat'),
                        'kota'  => $this->input->post('kota'),
                        'provinsi'  => $this->input->post('provinsi'),
                        'kabupaten'  => $this->input->post('kabupaten'),
                        'kode_pos'  => $this->input->post('kode_pos'),
                        'no_wa'  => $this->input->post('no_wa'),
                        'status_keluarga'  => $this->input->post('status_keluarga'),
                        'agama'  => $this->input->post('agama'),
                        'pen_terahir'  => $this->input->post('pen_terahir'),
                        'jurusan'  => $this->input->post('jurusan'),
                        'nama_sekolah'  => $this->input->post('nama_sekolah'),
                        'lulusan'  => $this->input->post('lulusan'),
                        'tlp'  => $this->input->post('tlp'),
                        'date_created' => date("Y-m-d H:i:s"),
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'nip' => $this->input->post('nip'),
                        'username' => $this->input->post('username'),
                        'nama_lengkap' => $this->input->post('nama_lengkap'),
                        'email' => $this->input->post('email'),
                        'id_level'  => '2',
                        'is_active' => 'Y',
                        'image' => $gambar['file_name'],
                    );
                    $save1 = array(
                        'nip' => $this->input->post('nip'),
                        'npwp' => $this->input->post('npwp'),
                        'unit_kerja'  => $this->input->post('unit_kerja'),
                        'sub_unit_kerja'  => $this->input->post('sub_unit_kerja'),
                        'status_pegawai'  => $this->input->post('status_pegawai'),
                        'nama_jabatan'  => $this->input->post('nama_jabatan'),
                        'gol_pangkat'  => $this->input->post('gol_pangkat'),
                        'taspen'  => $this->input->post('taspen'),
                        'tempat_lahir'  => $this->input->post('tempat_lahir'),
                        'jenis_kelamin'  => $this->input->post('jenis_kelamin'),
                        'alamat'  => $this->input->post('alamat'),
                        'kota'  => $this->input->post('kota'),
                        'provinsi'  => $this->input->post('provinsi'),
                        'kabupaten'  => $this->input->post('kabupaten'),
                        'kode_pos'  => $this->input->post('kode_pos'),
                        'no_wa'  => $this->input->post('no_wa'),
                        'status_keluarga'  => $this->input->post('status_keluarga'),
                        'agama'  => $this->input->post('agama'),
                        'pen_terahir'  => $this->input->post('pen_terahir'),
                        'jurusan'  => $this->input->post('jurusan'),
                        'nama_sekolah'  => $this->input->post('nama_sekolah'),
                        'lulusan'  => $this->input->post('lulusan'),
                        'tlp'  => $this->input->post('tlp'),
                        'date_created' => date("Y-m-d H:i:s"),
                    );
                }
                // dead($save);

                $g = $this->Mod_admin->getImageuser($nip)->row_array();
                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/user/' . $g['image']);
                }
                $this->Mod_admin->updateuserlev($nip, $save);
                $this->Mod_admin->updatepegawai($nip, $save1);
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
                        'nip' => $this->input->post('nip'),
                        'username' => $this->input->post('username'),
                        'nama_lengkap' => $this->input->post('nama_lengkap'),
                        'email' => $this->input->post('email'),
                        'password'  => get_hash($this->input->post('password')),
                        'id_level'  => '2',
                        'is_active' => 'Y',
                    );
                    $save1 = array(
                        'nip' => $this->input->post('nip'),
                        'npwp' => $this->input->post('npwp'),
                        'unit_kerja'  => $this->input->post('unit_kerja'),
                        'sub_unit_kerja'  => $this->input->post('sub_unit_kerja'),
                        'status_pegawai'  => $this->input->post('status_pegawai'),
                        'nama_jabatan'  => $this->input->post('nama_jabatan'),
                        'gol_pangkat'  => $this->input->post('gol_pangkat'),
                        'taspen'  => $this->input->post('taspen'),
                        'tempat_lahir'  => $this->input->post('tempat_lahir'),
                        'jenis_kelamin'  => $this->input->post('jenis_kelamin'),
                        'alamat'  => $this->input->post('alamat'),
                        'kota'  => $this->input->post('kota'),
                        'provinsi'  => $this->input->post('provinsi'),
                        'kabupaten'  => $this->input->post('kabupaten'),
                        'kode_pos'  => $this->input->post('kode_pos'),
                        'no_wa'  => $this->input->post('no_wa'),
                        'status_keluarga'  => $this->input->post('status_keluarga'),
                        'agama'  => $this->input->post('agama'),
                        'pen_terahir'  => $this->input->post('pen_terahir'),
                        'jurusan'  => $this->input->post('jurusan'),
                        'nama_sekolah'  => $this->input->post('nama_sekolah'),
                        'lulusan'  => $this->input->post('lulusan'),
                        'tlp'  => $this->input->post('tlp'),
                        'date_created' => date("Y-m-d H:i:s"),
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'nip' => $this->input->post('nip'),
                        'username' => $this->input->post('username'),
                        'nama_lengkap' => $this->input->post('nama_lengkap'),
                        'email' => $this->input->post('email'),
                        'id_level'  => '2',
                        'is_active' => 'Y',
                    );
                    $save1 = array(
                        'nip' => $this->input->post('nip'),
                        'npwp' => $this->input->post('npwp'),
                        'unit_kerja'  => $this->input->post('unit_kerja'),
                        'sub_unit_kerja'  => $this->input->post('sub_unit_kerja'),
                        'status_pegawai'  => $this->input->post('status_pegawai'),
                        'nama_jabatan'  => $this->input->post('nama_jabatan'),
                        'gol_pangkat'  => $this->input->post('gol_pangkat'),
                        'taspen'  => $this->input->post('taspen'),
                        'tempat_lahir'  => $this->input->post('tempat_lahir'),
                        'jenis_kelamin'  => $this->input->post('jenis_kelamin'),
                        'alamat'  => $this->input->post('alamat'),
                        'kota'  => $this->input->post('kota'),
                        'provinsi'  => $this->input->post('provinsi'),
                        'kabupaten'  => $this->input->post('kabupaten'),
                        'kode_pos'  => $this->input->post('kode_pos'),
                        'no_wa'  => $this->input->post('no_wa'),
                        'status_keluarga'  => $this->input->post('status_keluarga'),
                        'agama'  => $this->input->post('agama'),
                        'pen_terahir'  => $this->input->post('pen_terahir'),
                        'jurusan'  => $this->input->post('jurusan'),
                        'nama_sekolah'  => $this->input->post('nama_sekolah'),
                        'lulusan'  => $this->input->post('lulusan'),
                        'tlp'  => $this->input->post('tlp'),
                        'date_created' => date("Y-m-d H:i:s"),
                    );
                }
                dead($save);
                $this->Mod_admin->updateuserlev($nip, $save);
                $this->Mod_admin->updateuserlev($nip, $save1);
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
            $nip = $this->input->post('nip');
            if ($this->input->post('password')) {
                $save  = array(
                    'nip' => $this->input->post('nip'),
                    'username' => $this->input->post('username'),
                    'nama_lengkap' => $this->input->post('nama_lengkap'),
                    'email' => $this->input->post('email'),
                    'password'  => get_hash($this->input->post('password')),
                    'id_level'  => '2',
                    'is_active' => 'Y',
                );
                $save1 = array(
                    'nip' => $this->input->post('nip'),
                    'npwp' => $this->input->post('npwp'),
                    'unit_kerja'  => $this->input->post('unit_kerja'),
                    'sub_unit_kerja'  => $this->input->post('sub_unit_kerja'),
                    'status_pegawai'  => $this->input->post('status_pegawai'),
                    'nama_jabatan'  => $this->input->post('nama_jabatan'),
                    'gol_pangkat'  => $this->input->post('gol_pangkat'),
                    'taspen'  => $this->input->post('taspen'),
                    'tempat_lahir'  => $this->input->post('tempat_lahir'),
                    'jenis_kelamin'  => $this->input->post('jenis_kelamin'),
                    'alamat'  => $this->input->post('alamat'),
                    'kota'  => $this->input->post('kota'),
                    'provinsi'  => $this->input->post('provinsi'),
                    'kabupaten'  => $this->input->post('kabupaten'),
                    'kode_pos'  => $this->input->post('kode_pos'),
                    'no_wa'  => $this->input->post('no_wa'),
                    'status_keluarga'  => $this->input->post('status_keluarga'),
                    'agama'  => $this->input->post('agama'),
                    'pen_terahir'  => $this->input->post('pen_terahir'),
                    'jurusan'  => $this->input->post('jurusan'),
                    'nama_sekolah'  => $this->input->post('nama_sekolah'),
                    'lulusan'  => $this->input->post('lulusan'),
                    'tlp'  => $this->input->post('tlp'),
                    'date_created' => date("Y-m-d H:i:s"),
                );
            } else {
                $save  = array(
                    'nip' => $this->input->post('nip'),
                    'username' => $this->input->post('username'),
                    'nama_lengkap' => $this->input->post('nama_lengkap'),
                    'email' => $this->input->post('email'),
                    'id_level'  => '2',
                    'is_active' => 'Y',
                );
                $save1 = array(
                    'nip' => $this->input->post('nip'),
                    'npwp' => $this->input->post('npwp'),
                    'unit_kerja'  => $this->input->post('unit_kerja'),
                    'sub_unit_kerja'  => $this->input->post('sub_unit_kerja'),
                    'status_pegawai'  => $this->input->post('status_pegawai'),
                    'nama_jabatan'  => $this->input->post('nama_jabatan'),
                    'gol_pangkat'  => $this->input->post('gol_pangkat'),
                    'taspen'  => $this->input->post('taspen'),
                    'tempat_lahir'  => $this->input->post('tempat_lahir'),
                    'jenis_kelamin'  => $this->input->post('jenis_kelamin'),
                    'alamat'  => $this->input->post('alamat'),
                    'kota'  => $this->input->post('kota'),
                    'provinsi'  => $this->input->post('provinsi'),
                    'kabupaten'  => $this->input->post('kabupaten'),
                    'kode_pos'  => $this->input->post('kode_pos'),
                    'no_wa'  => $this->input->post('no_wa'),
                    'status_keluarga'  => $this->input->post('status_keluarga'),
                    'agama'  => $this->input->post('agama'),
                    'pen_terahir'  => $this->input->post('pen_terahir'),
                    'jurusan'  => $this->input->post('jurusan'),
                    'nama_sekolah'  => $this->input->post('nama_sekolah'),
                    'lulusan'  => $this->input->post('lulusan'),
                    'tlp'  => $this->input->post('tlp'),
                    'date_created' => date("Y-m-d H:i:s"),
                );
            }
            // dead($save1);
            $this->Mod_admin->updateuserlev($nip, $save);
            $this->Mod_admin->updatepegawai($nip, $save1);
            $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Admin telah Diubah',
                    icon: 'success'
                    });
                </script>");
            redirect('admin/pegawai');
            // echo json_encode(array("status" => TRUE));
        }
    }

    public function delete_pegawai($nip)
    {

        $g = $this->Mod_admin->getImageuser($nip)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/foto/user/' . $g['image']);
        }
        $this->db->delete('users', array('nip' => $nip));
        $this->db->delete('pegawai', array('nip' => $nip));
        $this->session->set_flashdata('success', "<script>
            swal({
            text: 'Admin telah dihapus',
            icon: 'success'
            });
        </script>");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function backup()
    {
        $this->load->dbutil();
        $data['setting_school'] = "DATA AKN";
        $prefs = [
            'format' => 'zip',
            'filename' => $data['setting_school']['setting_value'] . '-' . date("Y-m-d H-i-s") . '.sql'
        ];
        $backup = $this->dbutil->backup($prefs);
        $file_name = $data['setting_school']['setting_value'] . '-' . date("Y-m-d-H-i-s") . '.zip';
        $this->zip->download($file_name);
    }
    public function status_kehadiran()
    {
        $data['users'] = $this->db->get_where(
            'users',
            ['username' => $this->session->userdata('username')]
        )->row_array();
        $data['title'] = 'Status Kehadiran';

        $data['status_kehadiran'] = $this->db->get('status_kehadiran')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/status_kehadiran', $data);
        $this->load->view('template/footer');
    }
    public function tambah_status_kehadiran()
    {
        $save = [
            'status_kehadiran' => $this->input->post('status_kehadiran')
        ];
        $this->db->insert('status_kehadiran', $save);

        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Status kehadiran berhasil ditambahkan',
                    icon: 'success'
                    });
                </script>");
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function edit_status_kehadiran()
    {
        $status_kehadiran = $this->input->post('status_kehadiran');
        $id = $this->input->post('id');
        $data = [
            'status_kehadiran' => $status_kehadiran
        ];

        $this->db->where('id', $id);
        $this->db->update('status_kehadiran', $data);

        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Status kehadiran berhasil diubah',
                    icon: 'success'
                    });
                </script>");
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function hapus_status_kehadiran($id)
    {
        $where = ['id' => $id];
        $this->db->delete('status_kehadiran', $where);
        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Status kehadiran berhasil dihapus',
                    icon: 'success'
                    });
                </script>");
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function status_ketidakhadiran()
    {
        $data['users'] = $this->db->get_where(
            'users',
            ['username' => $this->session->userdata('username')]
        )->row_array();
        $data['title'] = 'Status Ketidakhadiran';

        $data['status_ketidakhadiran'] = $this->db->get('status_ketidakhadiran')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/status_ketidakhadiran', $data);
        $this->load->view('template/footer');
    }

    public function tambah_status_ketidakhadiran()
    {
        $save = [
            'status_ketidakhadiran' => $this->input->post('status_ketidakhadiran')
        ];

        $this->db->insert('status_ketidakhadiran', $save);

        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Status ketidakhadiran berhasil ditambahkan',
                    icon: 'success'
                    });
                </script>");
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function edit_status_ketidakhadiran()
    {
        $status_ketidakhadiran = $this->input->post('status_ketidakhadiran');
        $id = $this->input->post('id');
        $data = [
            'status_ketidakhadiran' => $status_ketidakhadiran
        ];

        $this->db->where('id', $id);
        $this->db->update('status_ketidakhadiran', $data);

        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Status ketidakhadiran berhasil diubah',
                    icon: 'success'
                    });
                </script>");
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function hapus_status_ketidakhadiran($id)
    {
        $where = ['id' => $id];
        $this->db->delete('status_ketidakhadiran', $where);
        $this->session->set_flashdata('success', "<script>
                    swal({
                    text: 'Status ketidakhadiran berhasil dihapus',
                    icon: 'success'
                    });
                </script>");
        redirect($_SERVER['HTTP_REFERER']);
    }
}
