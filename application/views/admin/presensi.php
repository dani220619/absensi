  <style>
      .center {
          text-align: center;
      }
  </style>
  <?php echo $this->session->flashdata('success'); ?>
  <div class="main-panel">
      <div class="content">
          <div class="page-inner">
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-header">
                          <div class="d-flex align-items-center">
                              <h4 class="card-title"><?= $title ?></h4>
                              <a href="<?= base_url('admin/tarik_presensi') ?>" class="btn btn-primary btn-round ml-auto">
                                  <i class="fa fa-plus"></i>
                                  Tarik Presensi
                              </a>
                          </div>
                      </div>

                      <div class="card-body">
                          <!-- Modal -->
                          <div class="table-responsive">
                              <table id="datatable" class="display table table-striped table-hover">
                                  <thead class="center">
                                      <tr>
                                          <th>NO</th>
                                          <th>NAMA PEGAWAI</th>
                                          <th>STATUS</th>
                                          <th>TANGGAL/WAKTU</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody class="center">
                                      <?php
                                        $no = 1;
                                        foreach ($presensi as $a) { ?>
                                          <tr>
                                              <td><?= $no++ ?></td>
                                              <td><?= $a->id_user ?></td>
                                              <td><?= $a->status_presensi ?></td>
                                              <td><?= $a->tanggl_waktus ?></td>
                                              <td>
                                                  <div class="form-button-action">
                                                      <a href="#!" onclick="deleteConfirm('<?php echo site_url('admin/delete_jadwal_kerja/' . $a->id) ?>')" class="btn btn-link btn-danger btn-lg"><i class="fa fa-times"></i></a>

                                                  </div>
                                              </td>
                                          </tr>
                                          <div class="modal fade" id="edit-apk<?= $a->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header no-bd">
                                                          <h5 class="modal-title">
                                                              <span class="fw-mediumbold">
                                                                  Edit</span>
                                                              <span class="fw-light">
                                                                  Jadwal kerja
                                                              </span>
                                                          </h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">

                                                          <form action="<?= base_url('admin/update_jadwal_kerja'); ?>" method="post" enctype="multipart/form-data">
                                                              <div class="row">
                                                                  <input hidden type="text" class="form-control" id="id" name="id" placeholder="id" value="<?= $a->id ?>">
                                                                  <div class="col-sm-12">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Hari</label>
                                                                          <input type="text" class="form-control" id="hari" name="hari" placeholder="Hari" value="<?= $a->hari ?>">
                                                                          <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-sm-12">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Jam Masuk</label>
                                                                          <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" placeholder="Jam Masuk" value="<?= $a->jam_masuk ?>">
                                                                          <?= form_error('jam_masuk', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-sm-12">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Jam Keluar</label>
                                                                          <input type="time" class="form-control" id="jam_keluar" name="jam_keluar" placeholder="Jam Keluar" value="<?= $a->jam_keluar ?>">
                                                                          <?= form_error('jam_keluar', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                              <div class="modal-footer no-bd">
                                                                  <button type="submit" id="addRowButton" class="btn btn-primary">Edit</button>
                                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                              </div>
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">×</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
                                                      <div class="modal-footer">
                                                          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                          <a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      <?php } ?>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="modal fade" id="usermodal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header no-bd">
                  <h5 class="modal-title">
                      <span class="fw-mediumbold">
                          Tambah Jadwal Kerja</span>
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <!-- <p class="small">Create a new row using this form, make sure you fill them all</p> -->
                  <form class="Jadwal kerja" method="post" action="<?= base_url('admin/insert_jadwal_kerja'); ?>" enctype="multipart/form-data">
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group form-group-default">
                                  <label>Hari</label>
                                  <input type="text" class="form-control" id="hari" name="hari" placeholder="hari" value="<?= set_value('hari'); ?>">
                                  <?= form_error('hari', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-sm-12">
                              <div class="form-group form-group-default">
                                  <label>Jam Masuk</label>
                                  <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" placeholder="Jam Masuk" value="<?= set_value('jam_masuk'); ?>">
                                  <?= form_error('jam_masuk', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-sm-12">
                              <div class="form-group form-group-default">
                                  <label>Jam Keluar</label>
                                  <input type="time" class="form-control" id="jam_keluar" name="jam_keluar" placeholder="Jam Keluar" value="<?= set_value('jam_keluar'); ?>">
                                  <?= form_error('jam_keluar', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer no-bd">
                          <button type="submit" id="addRowButton" class="btn btn-primary">Add</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div>
                  </form>
              </div>

          </div>
      </div>
  </div>

  <script>
      function deleteConfirm(url) {
          $('#btn-delete').attr('href', url);
          $('#deleteModal').modal();
      }
  </script>
  <script>
      $(document).ready(function() {
          $(' #datatable').DataTable();
      });
  </script>