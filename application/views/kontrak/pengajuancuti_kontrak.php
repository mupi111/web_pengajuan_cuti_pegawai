    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-light">
                <h3 class="card-title"><i class="fa fa-list text-blue"></i> Data Pengajuan Cuti</h3>
                <div class="text-right">
                  <button type="button" class="btn btn-sm btn-outline-primary" onclick="add()" title="Add Data Pengajuan Cuti kontrak"><i class="fas fa-plus"></i> Add</button>
                  <a href="<?php echo base_url('pengajuancutikontrak/download') ?>" type="button" class="btn btn-sm btn-outline-info" id="dwn_menu" target="_blank" title="Download"><i class="fas fa-download"></i> Download</a>
                  <a href="<?= base_url('backup/backupdb'); ?>" type="button" class="btn btn-sm btn-outline-warning" title="Backup"><i class="fas fa-hdd"></i> Backup Database</a>
                  <a href="<?php echo base_url('pengajuancutikontrak/pdf') ?>" type="button" class="btn btn-sm btn-outline-info" id="dwn_menu" target="_blank" title="Download"><i class="fas fa-download"></i> Download</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="pengajuancuti_kontrak" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr class="bg-info">
                      <th>NIP/NRP</th>
                      <th>Nama</th>
                      <th>Unit Kerja</th>
                      <th>Keperluan</th>
                      <th>Tgl Awal</th>
                      <th>Tgl Akhir</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- Modal Hapus-->
    <!-- <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Konfirmasi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="idhapus" id="idhapus">
            <p>Apakah anda yakin ingin menghapus data ini <strong class="text-konfirmasi"> </strong> ?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success btn-xs" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-danger btn-xs" id="konfirmasi">Hapus</button>
          </div>
        </div>
      </div>
    </div> -->

    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title ">View Pengajuan Cuti Pegawai Kontrak</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center" id="md_def">
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <script type="text/javascript">
      var save_method; //for save method string
      var table;

      $(document).ready(function() {

        table = $("#pengajuancuti_kontrak").DataTable({
          "responsive": true,
          "autoWidth": false,
          "language": {
            "sEmptyTable": "Data Pengajuan Cuti Pegawai Kontrak Belum Ada"
          },
          "processing": true, //Feature control the processing indicator.
          "serverSide": true, //Feature control DataTables' server-side processing mode.
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
            "url": "<?php echo site_url('pengajuancutikontrak/ajax_list') ?>",
            "type": "POST"
          },
          //Set column definition initialisation properties.
          "columnDefs": [{
            "targets": [-1], //last column
            "render": function(data, type, row) {

              return "<a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" title=\"View\" onclick=\"view(" + row[7] + ")\"><i class=\"fas fa-eye\"></i></a> <a class=\"btn btn-xs btn-outline-primary\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit(" + row[7] + ")\"><i class=\"fas fa-edit\"></i></a>"  ;
            },

            "orderable": false, //set not orderable
          }, ],
        });
        $("input").change(function() {
          $(this).parent().parent().removeClass('has-error');
          $(this).next().empty();
          $(this).removeClass('is-invalid');
        });
        $("textarea").change(function() {
          $(this).parent().parent().removeClass('has-error');
          $(this).next().empty();
          $(this).removeClass('is-invalid');
        });
        $("select").change(function() {
          $(this).parent().parent().removeClass('has-error');
          $(this).next().empty();
          $(this).removeClass('is-invalid');
        });
      });

      function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
      }

      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });


      //view
      function view(id) {
        $('.modal-title').text('View Pengajuan Cuti Pegawai Kontrak');
        $("#modal-default").modal('show');
        $.ajax({
          url: '<?php echo base_url('pengajuancutikontrak/view'); ?>',
          type: 'post',
          data: 'table=tbl_pengajuan_ppnpn&id=' + id,
          success: function(respon) {
            $("#md_def").html(respon);
          }
        })
      }

      //delete
      // function delpengajuancutikontrak(id) {

      //   Swal.fire({
      //     title: 'Are you sure?',
      //     text: "You won't be able to revert this!",
      //     icon: 'warning',
      //     showCancelButton: true,
      //     confirmButtonColor: '#3085d6',
      //     cancelButtonColor: '#d33',
      //     confirmButtonText: 'Yes, delete it!'
      //   }).then((result) => {
      //     if (result.value) {
      //       $.ajax({
      //         url: "<?php echo site_url('pengajuancutikontrak/delete'); ?>",
      //         type: "POST",
      //         data: "id_pengajuancutikontrak=" + id,
      //         cache: false,
      //         dataType: 'json',
      //         success: function(respone) {
      //           if (respone.status == true) {
      //             reload_table();
      //             Swal.fire(
      //               'Deleted!',
      //               'Your file has been deleted.',
      //               'success'
      //             );
      //           } else {
      //             Toast.fire({
      //               icon: 'error',
      //               title: 'Delete Error!!.'
      //             });
      //           }
      //         }
      //       });
      //     } else if (result.dismiss === Swal.DismissReason.cancel) {
      //       Swal(
      //         'Cancelled',
      //         'Your imaginary file is safe :)',
      //         'error'
      //       )
      //     }
      //   })
      // }


      function add() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Pengajuan Cuti Pegawai Kontrak'); // Set Title to Bootstrap modal title
      }

      function edit(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
          url: "<?php echo site_url('pengajuancutikontrak/edit') ?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('[name="id_ppnpn"]').val(data.id_ppnpn);
            $('[name="nrpnip"]').val(data.nrpnip);
            $('[name="nama"]').val(data.nama);
            $('[name="unit_kerja"]').val(data.unit_kerja);
            $('[name="keperluan"]').val(data.keperluan);
            $('[name="tgl_awal"]').val(data.tgl_awal);
            $('[name="tgl_akhir"]').val(data.tgl_akhir);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Pengajuan Cuti Pegawai Kontrak'); // Set title to Bootstrap modal title

          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
          }
        });
      }

      function save() {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable
        if (save_method == 'add') {
          url = "<?php echo site_url('pengajuancutikontrak/insert') ?>";
        } else {
          url = "<?php echo site_url('pengajuancutikontrak/update') ?>";
        }

        $.ajax({
          url: url,
          type: "POST",
          data: $('#form').serialize(),
          dataType: "JSON",
          success: function(data) {

            if (data.status) //if success close modal and reload ajax table
            {
              $('#modal_form').modal('hide');
              reload_table();
              Toast.fire({
                icon: 'success',
                title: 'Success!!.'
              });
            } else {
              for (var i = 0; i < data.inputerror.length; i++) {
                $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
                $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]).addClass('invalid-feedback');
              }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled', false); //set button enable 


          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled', false); //set button enable 

          }
        });
      }
    </script>


    <!-- Bootstrap modal -->
    <div class="modal fade" id="modal_form" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <div class="modal-header">
            <h3 class="modal-title">Data Pengajuan Cuti Form</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body form">
            <form action="#" id="form" class="form-horizontal">
              <input type="hidden" value="" name="id" />
              <div class="card-body">
                <div class="form-group row ">
                  <label for="nrpnip" class="col-sm-3 col-form-label">NRP/NIP</label>
                  <div class="col-sm-9 kosong">
                    <input type="text" class="form-control" name="nrpnip" id="nrpnip" placeholder="NRP / NIP">
                  </div>
                </div>
                <div class="form-group row ">
                  <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                  <div class="col-sm-9 kosong">
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Pegawai">
                  </div>
                </div>
                <div class="form-group row ">
                  <label for="unit_kerja" class="col-sm-3 col-form-label">Unit Kerja</label>
                  <div class="col-sm-9 kosong">
                    <input type="text" class="form-control" name="unit_kerja" id="unit_kerja" placeholder="Unit Kerja">
                  </div>
                </div>
                <div class="form-group row ">
                  <label for="keperluan" class="col-sm-3 col-form-label">Keperluan</label>
                  <div class="col-sm-9 kosong">
                    <textarea class="form-control" name="keperluan" id="keperluan" placeholder="Keperluan"></textarea>
                  </div>
                </div>
                <div class="form-group row ">
                  <label for="tgl_awal" class="col-sm-3 col-form-label">Tanggal Awal</label>
                  <div class="col-sm-9 kosong">
                    <input type="date" class="form-control" name="tgl_awal" id="tgl_awal">
                  </div>
                </div>
                <div class="form-group row ">
                  <label for="tgl_akhir" class="col-sm-3 col-form-label">Tanggal Akhir</label>
                  <div class="col-sm-9 kosong">
                    <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir">
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End Bootstrap modal -->