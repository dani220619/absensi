 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js">
 </script>
 <div class="main-panel">
     <div class="content">
         <div class="page-inner">
             <div class="col-md-12">
                 <div class="card">
                     <div class="card-header">
                         <div class="card-title">Tambah Pegawai</div>
                     </div>
                     <form class="simpanan" method="post" action="<?= base_url('admin/insert_pegawai'); ?>" enctype="multipart/form-data">
                         <div class="card-body">
                             <div class="row">
                                 <!-- <input hidden type="number" class="form-control" id="id" name="id" placeholder="Masukan id"> -->
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="nip">NIP</label>
                                         <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukan Nip">
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="npwp">NPWP</label>
                                         <input type="text" class="form-control" id="npwp" name="npwp" placeholder="Masukan Npwp">
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="username">USERNAME</label>
                                         <input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username">
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="nama_lengkap">NAMA LENGKAP</label>
                                         <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukan Nama Lengkap">
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="email">EMAIL</label>
                                         <input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email">
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="password">PASSWORD</label>
                                         <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password">
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label>UNIT KERJA</label>
                                         <div class="col-md-12 col-lg-12 kosong">
                                             <select class="form-control" name="unit_kerja" id="unit_kerja">
                                                 <option value=""></option>
                                                 <option value="Akademi Komunitas Seni Dan budaya Yogyakarta" selected>Akademi Komunitas Seni Dan budaya Yogyakarta</option>
                                             </select>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label>SUB UNIT KERJA</label>
                                         <div class="col-md-12 col-lg-12 kosong">
                                             <select class="form-control" name="sub_unit_kerja" id="sub_unit_kerja">
                                                 <option value=""></option>
                                                 <option value="Kepala Sub Bagian Tata Usaha">KEPALA SUB BAGIAN TATA USAHA</option>
                                                 <option value="Koordinator Program Studi Seni Tari">KOORDINATOR PROGRAM STUDI SENI TARI</option>
                                                 <option value="Koordinator Program Studi Seni Karawitan">KOORDINATOR PROGRAM STUDI SENI KARAWITAN</option>
                                                 <option value="Kepala Unit Penelitian Dan Pengabdian Kepada Masyarakat Dan Penjamin Mutu">KEPALA UNIT PENELITIAN DAN PENGABDIAN KEPADA MASYARAKAT DAN PENJAMINAN MUTU</option>
                                                 <option value="Koordinator Program Studi Kriya Kulit">KOORDINATOR PROGRAM STUDI KRIYA KULIT</option>
                                                 <option value="Kelompok Jabatan Fungsional">KELOMPOK JABATAN FUNGSIONAL</option>
                                             </select>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label>STATUS PEGAWAI</label>
                                         <div class="col-md-12 col-lg-12 kosong">
                                             <select class="form-control" name="status_pegawai" id="status_pegawai">
                                                 <option value=""></option>
                                                 <option id="pns" value="pns">PNS</option>
                                                 <option id="non_pns" value="non pns">NON PNS</option>
                                             </select>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6" id="jbt">
                                     <div class="form-group">
                                         <label for="nama_jabatan">NAMA JABATAN</label>
                                         <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" placeholder="Masukan Nama Jabatan">
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6" id="golpang">
                                     <div class="form-group">
                                         <label for="gol_pangkat">GOLONGAN/PANGKAT</label>
                                         <input type="text" class="form-control" id="gol_pangkat" name="gol_pangkat" placeholder="Masukan Golongan/Pangkat">
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6" id="tasp">
                                     <div class="form-group">
                                         <label for="taspen">TASPEN</label>
                                         <input type="text" class="form-control" id="taspen" name="taspen" placeholder="Masukan Taspen">
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>

                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="tempat_lahir">TEMPAT LAHIR</label>
                                         <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Masukan Tempat Lahir">
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label>JENIS KELAMIN</label>
                                         <div class="col-md-12 col-lg-12 kosong">
                                             <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                                 <option value=""></option>
                                                 <option value="laki-laki">Laki-Laki</option>
                                                 <option value="perempuan">Perempuan</option>
                                             </select>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="alamat">ALAMAT</label>
                                         <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat">
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="kota">KOTA</label>
                                         <input type="text" class="form-control" id="kota" name="kota" placeholder="Masukan Kota">
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="provinsi">PROVINSI</label>
                                         <input type="text" class="form-control" id="provinsi" name="provinsi" placeholder="Masukan Provinsi">
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="kabupaten">KABUPATEN</label>
                                         <input type="text" class="form-control" id="kabupaten" name="kabupaten" placeholder="Masukan Kabupaten">
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="kode_pos">KODE POS</label>
                                         <input type="text" class="form-control" id="kode_pos" name="kode_pos" placeholder="Masukan Kode Pos">
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="no_wa">NOMOR WHATSAPP</label>
                                         <input type="text" class="form-control" id="no_wa" name="no_wa" placeholder="Masukan No Whatsapp">
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="tlp">NOMOR TELEPON</label>
                                         <input type="text" class="form-control" id="tlp" name="tlp" placeholder="Masukan Nomor Telepon">
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="status_keluarga">STATUS KELUARGA</label>
                                         <input type="text" class="form-control" id="status_keluarga" name="status_keluarga" placeholder="Masukan Status Keluarga">
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label>AGAMA</label>
                                         <div class="col-md-12 col-lg-12 kosong">
                                             <select class="form-control" name="agama" id="agama">
                                                 <option value=""></option>
                                                 <option value="Islam">Islam</option>
                                                 <option value="Protestan">Protestan</option>
                                                 <option value="Katolik">Katolik</option>
                                                 <option value="Hindu">Hindu</option>
                                                 <option value="Buddha">Buddha</option>
                                                 <option value="Khonghucu">Khonghucu</option>
                                             </select>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="pen_terahir">PENDIDIKAN TERAHIR</label>
                                         <input type="text" class="form-control" id="pen_terahir" name="pen_terahir" placeholder="Masukan Pendidikan Terahir">
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="jurusan">JURUSAN</label>
                                         <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Masukan Jurusan">
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="nama_sekolah">NAMA SEKOLAH</label>
                                         <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" placeholder="Masukan Nama Sekolah">
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="lulusan">TAHUN LULUSAN</label>
                                         <input type="text" class="form-control" id="lulusan" name="lulusan" placeholder="Masukan Lulusan">
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="image">FOTO</label>
                                         <input type="file" class="form-control" id="image" name="imagefile" placeholder="Masukan Foto">
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="card-action">
                             <button class="btn btn-success">Submit</button>
                             <a href="<?= base_url('admin/pegawai') ?>" class="btn btn-danger">Cancel</a>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <script type="text/javascript">
     $(document).ready(function() {
         $("#jbt").hide();
         $("#golpang").hide();
         $("#tasp").hide();
         $("#pns").on('click', function() {
             $("#jbt").show('slow');
             $("#golpang").show('slow');
             $("#tasp").show('slow');
         })
         $("#non_pns").on('click', function() {
             $("#jbt").hide('slow');
             $("#golpang").hide('slow');
             $("#tasp").hide('slow');
         })
     });
 </script>