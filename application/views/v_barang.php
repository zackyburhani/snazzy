  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Barang
        <small></small>
      </h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <button class="btn btn-info" id="tambahBarang" data-toggle="modal" href="#" data-target="#ModalTambahBarang"><i class="fa fa-plus"></i> Tambah Data Barang</button> 
            </div>
            <div class="panel-body">
      
              <table style="table-layout:fixed" class="table table-striped table-bordered table-hover" id="dataBarang">
                <thead>
                  <tr>
                    <th width="5%">No. </th>
                    <th width="150px"><center>Nama Barang</center></th>
                    <th width="150px"><center>Harga</center></th>
                    <th width="150px"><center>Stok</center></th>
                    <th width="100px"> <center>Action</center> </th>
                  </tr>
                </thead>
                <tbody id="show_data">

                </tbody>
              </table>
            </div>
           </div>
          </div>
        </div>
    </section>
  </div>
  
<!-- MODAL ADD -->
<div class="modal fade" id="ModalTambahBarang" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="myModalLabel">Tambah Barang</h3>
      </div>
      <form class="form-horizontal">
        <div class="modal-body">

          <div class="form-group">
            <label class="control-label col-xs-3" >ID Barang</label>
            <div class="col-xs-9">
              <input name="kd_barang" id="kd_barang_id" readonly class="form-control" type="text" placeholder="Kode Barang" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Nama Barang</label>
            <div class="col-xs-9">
              <input name="nm_barang" id="nm_barang_id" class="form-control" type="text" placeholder="Nama Barang" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Artikel</label>
            <div class="col-xs-9">
              <input name="artikel" id="artikel_id" class="form-control" type="text" placeholder="Nama Artikel" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Size</label>
            <div class="col-xs-9">
              <select style="width:335px;" class="form-control" id="size_id" name="size">
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="XL">XL</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Stok</label>
            <div class="col-xs-9">
              <input name="stok" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="stok_id" class="form-control" type="number" min="0" placeholder="Stok" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Harga</label>
            <div class="col-xs-9">
              <input name="harga" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="harga_id" class="form-control" type="number" min="0" placeholder="Harga" style="width:335px;" required>
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i> Tutup</button>
          <button class="btn btn-primary" id="btn_simpan"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--END MODAL ADD-->


<!-- MODAL EDIT -->
<div class="modal fade" id="ModalEditBarang" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="myModalLabel">Ubah Barang</h3>
      </div>
      <form class="form-horizontal">
        <div class="modal-body">

          <div class="form-group">
            <label class="control-label col-xs-3" >ID Barang</label>
            <div class="col-xs-9">
              <input name="kd_barang" id="id_brg_edit" readonly class="form-control" type="text" placeholder="Kode Barang" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Nama Barang</label>
            <div class="col-xs-9">
              <input name="nm_barang" id="nm_brg_edit" class="form-control" type="text" placeholder="Nama Barang" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Artikel</label>
            <div class="col-xs-9">
              <input name="artikel" id="artikel_edit" class="form-control" type="text" placeholder="Nama Artikel" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Size</label>
            <div class="col-xs-9">
              <select style="width:335px;" class="form-control" id="size_id_edit" name="size">
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="XL">XL</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Stok</label>
            <div class="col-xs-9">
              <input name="stok" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="stok_id_edit" class="form-control" type="number" min="0" placeholder="Stok" style="width:335px;" required>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-xs-3" >Harga</label>
            <div class="col-xs-9">
              <input name="harga" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="harga_id_edit" class="form-control" type="number" min="0" placeholder="Harga" style="width:335px;" required>
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i> Tutup</button>
          <button class="btn btn-primary" id="btn_update"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--END MODAL EDIT-->

<!-- MODAL DETAIL -->
<div class="modal fade" id="ModalDetailBarang" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="myModalLabel">Detail Barang</h3>
      </div>
      <form class="form-horizontal">
        <div class="modal-body">
           <table class="table table-responsive table-bordered" border="0">
              <tbody>
                <tr>
                  <td width="120px">ID Barang</td>
                  <td width="20px">:</td>
                  <td><b><span id="id_brg_detail"></span></b></td>
                </tr>
                <tr>
                  <td>Nama Barang</td>
                  <td>:</td>
                  <td><span id="nm_brg_detail"></span></td>
                </tr>
                <tr>
                  <td>Artikel</td>
                  <td>:</td>
                  <td><span id="artikel_detail"></span></td>
                </tr>
                <tr>
                  <td>Size</td>
                  <td>:</td>
                  <td><span id="size_detail"></span></td>
                </tr>
                <tr>
                  <td>Stok</td>
                  <td>:</td>
                  <td><span id="stok_detail"></span></td>
                </tr>
                <tr>
                  <td>Harga</td>
                  <td>:</td>
                  <td><span id="harga_detail"></span></td>
                </tr>
              </tbody>
            </table>
        </div>
        <div class="modal-footer">
          <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i> Tutup</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--END MODAL DETAIL-->

<!--MODAL HAPUS-->
<div class="modal fade" id="ModalHapusBarang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <h4 class="modal-title" id="myModalLabel">Hapus Barang</h4>
      </div>
      <form class="form-horizontal">
      
        <div class="modal-body">              
          <input type="hidden" name="kode" id="textkode" value="">
            <p>Apakah Anda yakin mau menghapus ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button class="btn_hapus btn btn-danger" id="btn_hapus">Hapus</button>
        </div>

      </form>
    </div>
  </div>
</div>
<!--END MODAL HAPUS-->

<script type="text/javascript">
    $(document).ready(function(){
    tampil_data_barang(); //pemanggilan fungsi tampil barang.
    
    $('#dataBarang').dataTable();
     
    //fungsi tampil barang
    function tampil_data_barang(){
        $.ajax({
            type  : 'ajax',
            url   : "<?php echo base_url('barang/data_barang')?>",
            async : false,
            dataType : 'json',
            success : function(data){
                var html = '';
                var i;
                no = 1;
                for(i=0; i<data.length; i++){

                  var har = data[i].harga;
                  var reverse = har.toString().split('').reverse().join(''),
                      ribuan  = reverse.match(/\d{1,3}/g);
                      ribuan  = ribuan.join('.').split('').reverse().join('');
                      console.log(ribuan);

                    html += 
                    '<tr>'+
                        '<td align="center">'+ no++ +'.'+'</td>'+
                        '<td>'+data[i].nm_brg+'</td>'+
                        '<td align="center">'+ribuan+'</td>'+
                        '<td align="center">'+data[i].stok+'</td>'+
                        '<td style="text-align:center;">'+
                          '<button data-target="javascript:;" class="btn btn-info barang_detail" data="'+data[i].id_brg+'"><span class="glyphicon glyphicon-eye-open"></span></button>'+' '+
                          '<button data-target="javascript:;" class="btn btn-warning barang_edit" data="'+data[i].id_brg+'"><span class="glyphicon glyphicon-edit"></span></button>'+' '+
                          '<button data-target="javascript:;" class="btn btn-danger barang_hapus" data="'+data[i].id_brg+'"><span class="glyphicon glyphicon-trash"></span></button>'+
                        '</td>'+
                    '</tr>';
                }
                $('#show_data').html(html);
            }
        });
    }

    //get Kode
    $("#tambahBarang").click(function(){
        $.ajax({
          type : "GET",
          url  : "<?php echo base_url('barang/getKode')?>",
          dataType : "JSON",
          success: function(data){
            $.each(data,function(kd_pelanggan){
              $('#ModalTambahBarang').modal('show');
              $('[name="kd_barang"]').val(data.kd_barang);
            });
          }
        });
        return false;
    });

    //GET UPDATE
    $('#show_data').on('click','.barang_edit',function(){
      var kd_barang = $(this).attr('data');
        $.ajax({
          type : "GET",
          url  : "<?php echo base_url('barang/get_barang')?>",
          dataType : "JSON",
          data : {kd_barang:kd_barang},
          success: function(data){
            $.each(data,function(id_brg,nm_brg,artikel,size,harga,stok){
              $('#ModalEditBarang').modal('show');
              $('#id_brg_edit').val(data.id_brg);
              $('#nm_brg_edit').val(data.nm_brg);
              $('#artikel_edit').val(data.artikel);
              $('#size_id_edit').val(data.sizes);
              $('#stok_id_edit').val(data.stok);
              $('#harga_id_edit').val(data.harga);
            });
          }
        });
        return false;
    });

    //GETL DETAIL
    $('#show_data').on('click','.barang_detail',function(){
      var kd_barang = $(this).attr('data');
        $.ajax({
          type : "GET",
          url  : "<?php echo base_url('barang/get_barang')?>",
          dataType : "JSON",
          data : {kd_barang:kd_barang},
          success: function(data){
            $.each(data,function(id_brg,nm_brg,artikel,size,harga,stok){
              var har = data.harga;
              var reverse = har.toString().split('').reverse().join(''),
                  ribuan  = reverse.match(/\d{1,3}/g);
                  ribuan  = ribuan.join('.').split('').reverse().join('');
                  console.log(ribuan);

              $('#ModalDetailBarang').modal('show');
              $('#id_brg_detail').text(data.id_brg);
              $('#nm_brg_detail').text(data.nm_brg);
              $('#artikel_detail').text(data.artikel);
              $('#size_detail').text(data.sizes);
              $('#stok_detail').text(data.stok);
              $('#harga_detail').text(ribuan);
            });
          }
        });
        return false;
    });

    //GET HAPUS
    $('#show_data').on('click','.barang_hapus',function(){
      var id = $(this).attr('data');
      $('#ModalHapusBarang').modal('show');
      $('[name="kode"]').val(id);
    });

    //Simpan Barang
    $('#btn_simpan').on('click',function(){
      var kd_barang = $('#kd_barang_id').val();
      var nm_barang = $('#nm_barang_id').val();
      var harga = $('#harga_id').val();
      var stok = $('#stok_id').val();
      var artikel = $('#artikel_id').val();
      var size = $('#size_id').val();
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('barang/simpan')?>",
        dataType : "JSON",
        data : {kd_barang:kd_barang, nm_barang:nm_barang,harga:harga,stok:stok,artikel:artikel,size:size},
        success: function(data){
          $('[name="kd_barang"]').val("");
          $('[name="nm_barang"]').val("");
          $('[name="harga"]').val("");
          $('[name="stok"]').val("");
          $('[name="artikel"]').val("");
          $('#ModalTambahBarang').modal('hide');
          setTimeout(function() {
              swal("Berhasil Disimpan", "", "success");
                  }, 600);
          tampil_data_barang();
        }
      });
      return false;
    });

    //Update Barang
    $('#btn_update').on('click',function(){

      var id_brg = $('#id_brg_edit').val();
      var nm_brg = $('#nm_brg_edit').val();
      var artikel = $('#artikel_edit').val();
      var size = $('#size_id_edit').val();
      var stok = $('#stok_id_edit').val();
      var harga = $('#harga_id_edit').val();
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('barang/ubah')?>",
        dataType : "JSON",
        data : {id_brg:id_brg , nm_brg:nm_brg,artikel:artikel,harga:harga,stok:stok,size:size},
        success: function(data){
          $('[name="kd_barang"]').val("");
          $('[name="nm_barang"]').val("");
          $('[name="harga"]').val("");
          $('[name="stok"]').val("");
          $('[name="artikel"]').val("");
          $('[name="size"]').val("");
          $('#ModalEditBarang').modal('hide');
          setTimeout(function() {
              swal("Berhasil Disimpan", "", "success");
                  }, 600);
          tampil_data_barang();
        }
      });
      return false;
    });

    //Hapus Barang
    $('#btn_hapus').on('click',function(){
      var kd_barang = $('#textkode').val();
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('barang/hapus')?>",
        dataType : "JSON",
        data : {kd_barang: kd_barang},
        success: function(data){
          $('#ModalHapusBarang').modal('hide');
          tampil_data_barang();
        }
      });
      return false;
    });

  });
</script>

 