<?php echo $this->session->flashdata('success'); ?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ajukan Cuti</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('admin/ajukan_cuti') ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="jenis_cuti">Nama Pegawai</label>
                                <select class="custom-select mb-3 js-example-basic-multiple-limit" multiple name="nama_pegawai[]">
                                    <option value="" disabled>Pilih Pegawai</option>
                                    <?php foreach ($pegawai as $pgw) : ?>
                                        <option value="<?= $pgw['id']; ?>"><?= $pgw['nama_lengkap']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('nama_pegawai[]', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="jenis_cuti">Jenis Cuti</label>
                                <select class="custom-select mb-3" name="jenis_cuti">
                                    <option value="" disabled>Pilih Jenis Cuti</option>
                                    <?php foreach ($jenis_cuti as $jc) : ?>
                                        <option value="<?= $jc['id']; ?>"><?= $jc['jenis_cuti']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('jenis_cuti', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="alasan_cuti">Alasan Cuti</label>
                                <input type="text" class="form-control" id="alasan_cuti" name="alasan_cuti">
                                <?= form_error('alasan_cuti', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="selama">Selama</label>
                                <input type="text" class="form-control" id="selama" name="selama">
                                <?= form_error('selama', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="mulai_tanggal">Mulai Tanggal</label>
                                <input type="date" class="form-control" id="mulai_tanggal" name="mulai_tanggal">
                                <?= form_error('mulai_tanggal', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="sampai_tanggal">Sampai Tanggal</label>
                                <input type="date" class="form-control" id="sampai_tanggal" name="sampai_tanggal">
                                <?= form_error('sampai_tanggal', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="alamat_menjalankan_cuti">Alamat Menjalankan Cuti</label>
                                <textarea name="alamat_menjalankan_cuti" id="alamat_menjalankan_cuti" rows="10" cols="30" class="form-control"></textarea>
                                <?= form_error('alamat_menjalankan_cuti', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary ml-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>assets/js/core/jquery.3.2.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.basic-datatables').DataTable({});

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
    $(".js-example-basic-multiple-limit").select2({
        tags: true,
        allowClear: true,
    });
</script>