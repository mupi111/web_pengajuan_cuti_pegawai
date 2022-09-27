  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-light">
                <h3 class="card-title"><i class="fa fa-list text-blue"></i> Data Pegawai</h3>
                <div class="text-right">
                  <button type="button" class="btn btn-sm btn-outline-primary" onclick="add()" title="Add Data Pegawai"><i class="fas fa-plus"></i> Add</button>
                  <a href="<?php echo base_url('datapegawai/excel') ?>" type="button" class="btn btn-sm btn-outline-success" id="dwn_menu" target="_blank" title="Download Excel"><i class="fas fa-download"></i> Excel</a>
                  <a href="<?php echo base_url('datapegawai/pdf') ?>" type="button" class="btn btn-sm btn-outline-danger" id="dwn_menu" target="_blank" title="Print PDF"><i class="fas fa-download"></i> Print</a>
                  <a href="<?=base_url('backup/backupdb');?>" type="button" class="btn btn-sm btn-outline-warning"  title="Backup" ><i class="fas fa-hdd"></i> Backup Database</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="data_pegawai" class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr class="bg-info">
                    <th>Foto</th>
                    <th>NIP/NRP</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Masa Kerja</th>
                    <th>Unit Kerja</th>
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
    <div class="modal fade" id="myModal" >
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
            <p>Apakah anda yakin ingin menghapus menu <strong class="text-konfirmasi"> </strong> ?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success btn-xs" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-danger btn-xs" id="konfirmasi">Hapus</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content" >
          <div class="modal-header">
            <h4 class="modal-title ">View Data pegawai</h4>
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

    //datatables
    table =$("#data_pegawai").DataTable({
        "responsive": true,
        "autoWidth": false,
        "language": {
        "sEmptyTable": "Data Pegawai Belum Ada"
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('datapegawai/ajax_list')?>",
            "type": "POST"
        },
         //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [-1], //last column
            "render": function ( data, type, row ) {

              return "<a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" title=\"View\" onclick=\"view("+row[6]+")\"><i class=\"fas fa-eye\"></i></a> <a class=\"btn btn-xs btn-outline-primary\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit("+row[6]+")\"><i class=\"fas fa-edit\"></i></a>";

            },

            "orderable": false, //set not orderable
        },
        {
          "targets": [0],
          "render": function(data , type , row){
            if (row[0]!=null) {
             return "<img class=\"myImgx\"  src='<?php echo base_url("assets/foto/user/");?>"+row[0]+"' width=\"100px\" height=\"100px\">";
            }else{
              return "<img class=\"myImgx\"  src='<?php echo base_url("assets/foto/user/default-150x150.png");?>' width=\"100px\" height=\"100px\">";
            }
        }
        },
        ],
      });

 //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
        $(this).removeClass('is-invalid');
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
        $(this).removeClass('is-invalid');
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
        $(this).removeClass('is-invalid');
    });

});

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

//view
function view(id){
      $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('.modal-title').text('View Data pegawai');
    $("#modal-default").modal('show');
    $.ajax({
      url : '<?php echo base_url('datapegawai/view'); ?>',
      type : 'post',
      data : 'table=tbl_data_pegawai&id='+id,
      success : function(respon){
        $("#md_def").html(respon);
      }
    })
  }

  //Delete
function delete_datapegawai(id){
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {

    $.ajax({
      url:"<?php echo site_url('datapegawai/delete');?>",
      type:"POST",
      data:"id="+id,
      cache:false,
      dataType: 'json',
      success:function(respone){
        if (respone.status == true) {
          reload_table();
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            );
        }else{
          Toast.fire({
            icon: 'error',
            title: 'Delete Error!!.'
          });
        }
      }
    });

  })
}

function add()
{
  save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Pegawai'); // Set Title to Bootstrap modal title
  }

function edit(id){
 save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('datapegawai/edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_pegawai"]').val(data.id_pegawai);
            $('[name="nrpnip"]').val(data.nrpnip);
            $('[name="nama"]').val(data.nama);
            $('[name="jabatan"]').val(data.jabatan);
            $('[name="masa_kerja"]').val(data.masa_kerja);
            $('[name="unit_kerja"]').val(data.unit_kerja);

            if (data.image==null) {
              var image = "<?php echo base_url('assets/foto/user/default.png')?>";
              $("#v_image").attr("src",image);
            }else{
             var image = "<?php echo base_url('assets/foto/user/')?>";
             $("#v_image").attr("src",image+data.image);
           }
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data pegawai'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
    if(save_method == 'add') {
      url = "<?php echo site_url('datapegawai/insert')?>";
    } else {
      url = "<?php echo site_url('datapegawai/update')?>";
    }
    var formdata = new FormData($('#form')[0]);
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: formdata,
        dataType: "JSON",
        cache: false,
        contentType: false,
        processData: false,
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
                Toast.fire({
                  icon: 'success',
                  title: 'Success!!.'
                });
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
                    $('[name="'+data.inputerror[i]+'"]').closest('.kosong').append('<span></span>');
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]).addClass('invalid-feedback');
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert(textStatus);
            // alert('Error adding / update data');
            Toast.fire({
              icon: 'error',
              title: 'Error!!.'
            });
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
  }
  var loadFile = function(event) {
    var image = document.getElementById('v_image');
    image.src = URL.createObjectURL(event.target.files[0]);
  };

  function batal() {
    $('#form')[0].reset();
    reload_table();
    var image = document.getElementById('v_image');
    image.src ="";
  }
</script>


<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Data Pegawai</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button> 
            </div>
            <div class="modal-body form">
            <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
            <!-- <?php echo form_open_multipart('', array('class' => 'form-horizontal', 'id' => 'form')) ?> -->
            <input type="hidden" value="" name="id_pegawai"/> 
            <div class="card-body">
              <div class="form-group row ">
              <label for="nrpnip" class="col-sm-3 col-form-label">NIP/NRP</label>
              <div class="col-sm-9 kosong">
                <input type="text" class="form-control" name="nrpnip" id="nrpnip" placeholder="NIP/NRP" >
              </div>
              </div>
              <div class="form-group row ">
                <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9 kosong">
                  <input type="text" class="form-control"  name="nama" id="nama" placeholder="Nama" >
                </div>
              </div>
              <div class="form-group row ">
                <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                <div class="col-sm-9 kosong">
                    <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan" >
                </div>
              </div>
              <div class="form-group row ">
                <label for="masa_kerja" class="col-sm-3 col-form-label">Masa Kerja</label>
                  <div class="col-sm-9 kosong">
                    <input type="text" class="form-control" name="masa_kerja" id="masa_kerja" placeholder="Masa Kerja" >
                  </div>
                </div>
                  <div class="form-group row ">
                    <label for="unit_kerja" class="col-sm-3 col-form-label">Unit Kerja</label>
                    <div class="col-sm-9 kosong">
                      <input type="text" class="form-control" name="unit_kerja" id="unit_kerja" placeholder="Unit Kerja" >
                    </div>
                  </div>
                  <div class="form-group row ">
                    <label for="image" class="col-sm-3 col-form-label">Foto</label>
                    <div class="col-sm-9 kosong">
                      <img  id="v_image" width="100px" height="100px">
                    <input type="file" class="form-control btn-file" onchange="loadFile(event)" name="imagefile" id="imagefile" placeholder="Foto" value="UPLOAD">
                  </div>
                </div>
              </div>
              <!-- <?php echo form_close(); ?> -->
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->