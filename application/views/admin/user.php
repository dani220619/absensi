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
                              <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#usermodal">
                                  <i class="fa fa-plus"></i>
                                  Add User
                              </button>
                          </div>
                      </div>

                      <div class="card-body">
                          <!-- Modal -->
                          <div class="table-responsive">
                              <table id="datatable" class="display table table-striped table-hover">
                                  <thead class="center">
                                      <tr>
                                          <th>NO</th>
                                          <th>IMAGE</th>
                                          <th>USERNAME</th>
                                          <th>FULL NAME</th>
                                          <!-- <th>TELPON</th> -->
                                          <th>ID LEVEL</th>

                                          <th>IS ACTIVE</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody class="center">
                                      <?php
                                        $no = 1;
                                        foreach ($user as $a) { ?>

                                          <tr>
                                              <td><?= $no++ ?></td>
                                              <td>
                                                  <img class="myImgx" src='<?php echo base_url("assets/foto/user/"); ?><?= $a->image ?> ' width="100px" height="100px">
                                              </td>
                                              <td><?= $a->username ?></td>
                                              <td><?= $a->nama_lengkap ?></td>
                                              <!-- <td><?= $a->tlp ?></td> -->
                                              <td><?= $a->nama_level ?></td>

                                              <td><?= $a->is_active ?></td>

                                              <td>
                                                  <div class="form-button-action">
                                                      <button data-target="#edit-apk<?= $a->id ?>" type="button" data-toggle="modal" title="Edit Data" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                          <i class="fa fa-edit"></i>
                                                      </button>
                                                      <a href="#!" onclick="deleteConfirm('<?php echo site_url('admin/delete_admin/' . $a->id) ?>')" class="btn btn-link btn-danger btn-lg"><i class="fa fa-times"></i></a>
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
                                                                  User
                                                              </span>
                                                          </h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">

                                                          <form action="<?= base_url('admin/update_admin'); ?>" method="post" enctype="multipart/form-data">
                                                              <div class="row">
                                                                  <input hidden type="text" class="form-control" id="id" name="id" placeholder="id" value="<?= $a->id ?>">

                                                                  <div class="col-sm-12">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Username</label>
                                                                          <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= $a->username ?>">
                                                                          <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-md-12">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Password</label>
                                                                          <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="">
                                                                          <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-sm-12">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Nama Lengkap</label>
                                                                          <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Full Name" value="<?= $a->nama_lengkap ?>">
                                                                          <?= form_error('nama_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-md-12 pr-0">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Email</label>
                                                                          <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= $a->email ?>">
                                                                          <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-md-12 pr-0">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Telpon</label>
                                                                          <input type="number" class="form-control" id="tlp" name="tlp" placeholder="Telpon" value="<?= $a->tlp ?>">
                                                                          <?= form_error('tlp', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-md-12 pr-0">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Image</label>
                                                                          <input type="file" class="form-control" id="imagefile" name="imagefile" placeholder="Image" value="<?= $a->image ?>">
                                                                          <?= form_error('image', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                      </div>
                                                                  </div>

                                                                  <div class="col-md-6 pr-0 ">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Level</label>
                                                                          <div class="col-sm-12 kosong">
                                                                              <select class="form-control" name="id_level" id="id_level">
                                                                                  <option value="<?php $a->id_level ?>" selected="selected"></option>
                                                                                  <?php
                                                                                    foreach ($user_level as $level) { ?>
                                                                                      <option <?= ($level->id_level == $a->id_level ? 'selected=""' : '') ?> value="<?= $level->id_level; ?>"><?= $level->nama_level; ?></option>
                                                                                  <?php } ?>
                                                                              </select>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-md-6 pr-0 ">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Is Active</label>
                                                                          <div class="col-sm-12 kosong">
                                                                              <select class="form-control" name="is_active" id="is_active" value="<?= $a->is_active ?>">
                                                                                  <option value="<?php $a->is_active ?>" selected="selected"></option>
                                                                                  <?php
                                                                                    foreach ($is_active as $is) { ?>
                                                                                      <option <?= ($is == $a->is_active ? 'selected=""' : '') ?> value="<?= $is; ?>"><?= $is; ?></option>
                                                                                  <?php } ?>
                                                                              </select>
                                                                          </div>
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
                          User</span>
                      <span class="fw-light">
                          Add
                      </span>
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <!-- <p class="small">Create a new row using this form, make sure you fill them all</p> -->
                  <form class="admin" method="post" action="<?= base_url('admin/insert_admin'); ?>" enctype="multipart/form-data">
                      <div class="row">
                          <input hidden type="text" class="form-control" id="id" name="id" placeholder="id" value="<?= set_value('id'); ?>">

                          <div class="col-sm-12">
                              <div class="form-group form-group-default">
                                  <label>Username</label>
                                  <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= set_value('username'); ?>">
                                  <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group form-group-default">
                                  <label>Password</label>
                                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?= set_value('password'); ?>">
                                  <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-sm-12">
                              <div class="form-group form-group-default">
                                  <label>Name Lengkap</label>
                                  <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" value="<?= set_value('nama_lengkap'); ?>">
                                  <?= form_error('nama_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-sm-12">
                              <div class="form-group form-group-default">
                                  <label>Email</label>
                                  <input type="text" class="form-control" id="email" name="email" placeholder="Nama Lengkap" value="<?= set_value('email'); ?>">
                                  <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-md-12 pr-0">
                              <div class="form-group form-group-default">
                                  <label>Telpon</label>
                                  <input type="text" class="form-control" id="tlp" name="tlp" placeholder="Telpon" value="<?= set_value('tlp'); ?>">
                                  <?= form_error('tlp', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-md-12 pr-0">
                              <div class="form-group form-group-default">
                                  <label>Image</label>
                                  <input type="file" class="form-control" id="imagefile" name="imagefile" placeholder="Image" value="<?= set_value('image'); ?>">
                                  <?= form_error('image', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-md-6 pr-0 ">
                              <div class="form-group form-group-default">
                                  <label>Level</label>
                                  <div class="col-sm-12 kosong">
                                      <select class="form-control" name="id_level" id="id_level">
                                          <option value="">Pilih Level</option>
                                          <?php
                                            foreach ($user_level as $level) { ?>
                                              <option value="<?= $level->id_level; ?>"><?= $level->nama_level; ?></option>
                                          <?php } ?>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-6 pr-0 ">
                              <div class="form-group form-group-default">
                                  <label>Is Active</label>
                                  <div class="col-sm-12 kosong">
                                      <select class="form-control" name="is_active" id="is_active">
                                          <option value=""></option>
                                          <option value="Y">Y</option>
                                          <option value="N">N</option>
                                      </select>
                                  </div>
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
          $('#datatable').DataTable();
      });
  </script>