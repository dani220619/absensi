<?php echo $this->session->flashdata('success'); ?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Unduh Format</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="nama_pegawai">Nama Pegawai</label>
                                <select class="custom-select mb-3 js-example-basic-multiple-limit" name="nama_pegawai" required>
                                    <option value="" selected>Nama Pegawai</option>
                                    <?php foreach ($pegawai as $pgw) : ?>
                                        <option value="<?= $pgw['id']; ?>"><?= $pgw['nama_lengkap']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jenis_cuti">Jenis Cuti</label>
                                <select class="custom-select mb-3" name="jenis_cuti" required>
                                    <option value="" selected>Pilih Jenis Cuti</option>
                                    <?php foreach ($jenis_cuti as $jc) : ?>
                                        <option value="<?= $jc['id']; ?>"><?= $jc['jenis_cuti']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- input cuti -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Ajukan Cuti</h4>
                            <a href="<?= base_url('admin/ajukan_cuti') ?>" class="btn btn-sm btn-primary btn-round ml-auto">
                                <i class="fa fa-plus"></i>
                                Tambah
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead class="center">
                                    <tr>
                                        <th>NO</th>
                                        <th>NIP</th>
                                        <th>NAMA LENGKAP</th>
                                        <th>JENIS CUTI</th>
                                        <th>STATUS CUTI</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody class="center">
                                    <?php $no = 1;
                                    foreach ($pegawai as $pgw) : ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $pgw['nip']; ?></td>
                                            <td><?= $pgw['nama_lengkap']; ?></td>
                                            <td><?= $pgw['jenis_cuti'] ?></td>
                                            <?php if ($pgw['status_cuti'] == 0) : ?>
                                                <td><span class="badge badge-danger">Belum Upload</span></td>
                                            <?php elseif ($pgw['status_cuti'] == 2) : ?>
                                                <td><span class="badge badge-danger">Pending</span></td>
                                            <?php else : ?>
                                                <td><span class="badge badge-danger">Disetujui</span></td>
                                            <?php endif; ?>
                                            <td>
                                                <div class="form-button-action text-center">
                                                    <a href="#" data-target="#exampleModal3" type="button" data-toggle="modal" title="Edit Data" class="text-primary">
                                                        <i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit Data"></i>
                                                    </a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Jenis Cuti</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="" method="POST">
                                                                        <div class="form-group">
                                                                            <label for="jenis_cuti">Jenis Cuti</label>
                                                                            <input type="text" class="form-control" id="jenis_cuti" name="jenis_cuti" value="">
                                                                            <input type="text" class="form-control" id="id" name="id" value="" hidden>
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="" class="text-danger mx-3" data-toggle="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-times"></i></a>
                                                    <a href="" class="text-warning" data-toggle="tooltip" data-placement="top" title="Detail Data"><i class="fas fa-eye"></i></a>
                                                    <?php if ($pgw['status_cuti'] == 0) : ?>
                                                        <a href="" class="text-secondary ml-3" data-toggle="tooltip" data-placement="top" title="Upload Data"><i class="fas fa-upload"></i></a>
                                                    <?php endif; ?>
                                                    <a href="<?= base_url('admin/cetak_formulir_cuti/') . $pgw['id_cuti'] ?>" class="text-secondary ml-3" data-toggle="tooltip" data-placement="top" title="Download Format"><i class="fas fa-download"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php $no++;
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title"><?= $title; ?></h4>
                            <button class="btn btn-sm btn-primary btn-round ml-auto" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-plus"></i>
                                Tambah
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="POST">
                                                <div class="form-group">
                                                    <label for="jenis_cuti">Jenis Cuti</label>
                                                    <input type="text" class="form-control" id="jenis_cuti" name="jenis_cuti" placeholder="Masukan Jenis Cuti">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead class="center">
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Cuti</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="center">
                                    <tr>
                                        <td></td>
                                        <td style="width: 65%;"></td>
                                        <td>
                                            <div class="form-button-action">
                                                <button data-target="#exampleModal1" type="button" data-toggle="modal" title="Edit Data" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                    <i class="fa fa-edit"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Jenis Cuti</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="" method="POST">
                                                                    <div class="form-group">
                                                                        <label for="jenis_cuti">Jenis Cuti</label>
                                                                        <input type="text" class="form-control" id="jenis_cuti" name="jenis_cuti" value="">
                                                                        <input type="text" class="form-control" id="id" name="id" value="" hidden>
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="" class="btn btn-link btn-danger btn-lg tombol-hapus"><i class="fa fa-times"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>assets/js/core/jquery.3.2.1.min.js"></script>
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable({});

        $('#multi-filter-select').DataTable({
            "pageLength": 5,
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });

                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });

        // Add Row
        $('#add-row').DataTable({
            "pageLength": 5,
        });

        var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-simple-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-simple-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        $('#addRowButton').click(function() {
            $('#add-row').dataTable().fnAddData([
                $("#addName").val(),
                $("#addPosition").val(),
                $("#addOffice").val(),
                action
            ]);
            $('#addRowModal').modal('hide');

        });
    });
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('.tombol-hapus').on('click', function(e) {
        e.preventDefault();

        const href = $(this).attr('href');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            }
        })
    });
</script>
<script>
    $(".js-example-basic-multiple-limit").select2();
</script>