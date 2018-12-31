<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Tambah Data Pesan
      <small></small>
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <a href="<?php echo site_url('pesan') ?>" class="btn btn-success"><i class="fa fa-arrow-left"></i> Kembali</a>
          </div>
          <div class="panel-body">
            <div class="col-md-12">
              <form class="form-horizontal">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-1">
                    <label class="control-label">Barang</label>
                  </div>
                  <div class="col-md-4">
                    <select class="form-control select2" name="id_brg">
                      <?php foreach($barang as $brg){ ?>
                        <option value="<?php echo $brg->id_brg ?>"><?php echo $brg->nm_brg ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-1">
                    <label class="control-label">Jumlah</label>
                  </div>
                  <div class="col-md-3">
                    <input type="number" name="qty" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" min="1" placeholder="QTY" required class="form-control">
                  </div>
                  <div class="col-md-3">
                    <div class="row">
                      <div class="col-md-6">
                        <button class="btn btn-primary btn-md add_cart" type="button"><span class="fa fa-plus"></span> Tambah Data</button>
                      </div>
                      <div class="col-md-6"> 
                        <button type="button" id="btn_proses" data-target="#ModalTambahPesan" data-toggle="modal" class="btn btn-success btn-md btn-block" ><span class="fa fa-sign-out"></span> Proses</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
              
          <table style="table-layout:fixed" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th align="center" width="50px">No. </th>
                <th align="center"><center>ID Barang</center></th>
                <th align="center"><center>Nama Barang</center></th>
                <th align="center"><center>Harga</center></th>
                <th align="center"><center>QTY</center></th>
                <th align="center"><center>Jumlah Harga</center></th>
                <th align="center"><center>Hapus</center></th>
              </tr>
            </thead>
            <tbody id="detail_cart">
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</section>
</div>

<!-- MODAL ADD -->
<div class="modal fade" id="ModalTambahPesan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-tags"></i> Tambah Data Pesan</h4>
      </div>
      <form id="form">
        <div class="modal-body">
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group"><label>ID Pesan</label>
                <input required class="form-control required text-capitalize" data-placement="top" data-trigger="manual" type="text" name="id_pesan" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group"><label>Diskon</label>
                <div style="margin-left: 20px">
                  <input type="checkbox" name="diskon"> Pilih Diskon
                </div>
              </div>
            </div>
          </div>

          <hr>

          <div class="form-group"><label>Nama Pelanggan</label>
            <input required class="form-control required text-capitalize" placeholder="Input Nama Pelanggan" data-placement="top" data-trigger="manual" type="text" name="nm_plg">
          </div>

          <div class="form-group">
            <label class="control-label">Nomor Telepon</label>
            <input name="no_telp" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" type="text" placeholder="Input Nomor Telepon" required>
          </div>

          <div class="form-group">
            <label class="control-label">Alamat</label>
            <textarea placeholder="Input Alamat..." rows="4" cols="5" class="form-control" name="alamat"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          <button class="btn btn-primary" id="btn_simpan"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--END MODAL ADD-->  

<!-- MODAL DETAIL -->
<div class="modal fade" id="ModalPesanDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-tag"></i> Detail Pesan</h4>
      </div>
        <div class="modal-body">
        <div class="row" id="detail_order1">
          
        </div>
        <table style="table-layout:fixed" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th align="center" width="50px">No. </th>
              <th align="center"><center>ID Barang</center></th>
              <th align="center"><center>Nama Barang</center></th>
              <th align="center"><center>Harga</center></th>
              <th align="center"><center>QTY</center></th>
              <th align="center"><center>Jumlah Harga</center></th>
            </tr>
          </thead>
          <tbody id="detail_order2">
            
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
<!-- END MODAL DETAIL -->

  <script type="text/javascript">
    $(document).ready(function(){

        $('[name="qty"]').keypress(function (event) {
            if (event.keyCode === 10 || event.keyCode === 13) {
                event.preventDefault();
            }
        });

        $('.add_cart').click(function(e){
            var id_brg = $('[name="id_brg"]').val();
            var qty = $('[name="qty"]').val();

            if (qty == "") {
                swal({
                  title: "QTY Tidak Boleh Kosong",
                  text: "",
                  icon: "error",
                  button: "Ok !",
                });
                e.preventDefault();
                return false;
            }

            if(qty == 0){
              qty = $('[name="qty"]').val("");              
              return false;
            }

            //cek stok
            $.ajax({
              url : "<?php echo base_url('ControllerPesan/cekStok');?>",
              method : "POST",
              dataType: 'JSON',
              data : {id_brg: id_brg},
              success: function(data){
                var stok = data;
                if(data < qty){
                  swal({
                    title: "Stok Tidak Cukup",
                    text: "",
                    icon: "error",
                    button: "Ok !",
                  });
                  e.preventDefault();
                  return false;
                }

                $.ajax({
                  url : "<?php echo base_url('ControllerPesan/add_to_cart');?>",
                  method : "POST",
                  data : {id_brg: id_brg, qty:qty},
                  success: function(data){

                    //cek stok 2
                    $.ajax({
                      url : "<?php echo base_url('ControllerPesan/cekStok_2');?>",
                      method : "POST",
                      dataType: 'JSON',
                      data : {id_brg: id_brg},
                      success: function(quantity){
            
                        if(quantity > stok){
                          swal({
                            title: "Stok Tidak Cukups",
                            text: "",
                            icon: "error",
                            button: "Ok !",
                          });

                          total = quantity-parseInt(qty);
                          $.ajax({
                            url : "<?php echo base_url('ControllerPesan/add_to_cart');?>",
                            method : "POST",
                            data : {id_brg: id_brg, qty:total},
                            success: function(data){
                              $('[name="qty"]').val("");
                              $('#detail_cart').html(data);
                            }
                          });
                          return false;
                        }
                      }
                    });
                    $('[name="qty"]').val("");
                    $('#detail_cart').html(data);
                  }
                });
              }
            });
        }); 

        // Load shopping cart
        $('#detail_cart').load("<?php echo base_url('ControllerPesan/load_cart');?>");
 
        //Hapus Item Cart
        $(document).on('click','.hapus_cart',function(){
            var row_id=$(this).attr("id"); //mengambil row_id dari artibut id
            $.ajax({
                url : "<?php echo base_url('ControllerPesan/hapus_cart');?>",
                method : "POST",
                data : {row_id : row_id},
                success :function(data){
                    $('#detail_cart').html(data);
                }
            });
        });

        //get Kode
        $("#btn_proses").click(function(){ 

          //untuk validasi tombol simpan
          $.ajax({
            url  : "<?php echo base_url('ControllerPesan/cekCart')?>",
            dataType : "JSON",
            success: function(data){
              if(data == false){
                swal({
                  title: "Tidak Ada Data Yang Diproses",
                  text: "",
                  icon: "error",
                  button: "Ok !",
                });
                return false;
              } else {

                $.ajax({
                  type : "GET",
                  url  : "<?php echo base_url('pesan/getKode')?>",
                  dataType : "JSON",
                  success: function(data){
                    $.each(data,function(id_pesan){
                      $('#ModalTambahPesan').modal('show');
                      $('[name="id_pesan"]').val(data.id_pesan);
                    });
                  }
                });
              }
            }
          });

            return false;
        });

        //Simpan pesan
        $('#btn_simpan').on('click',function(){
          var id_pesan = $('[name="id_pesan"]').val();
          
          if($('[name="diskon"]').is(':checked')){
            var diskon = "1";
          } else {
            var diskon = "";
          }

          var nm_plg = $('[name="nm_plg"]').val();
          var no_telp = $('[name="no_telp"]').val();
          var alamat = $('[name="alamat"]').val();

          $.ajax({
            type : "POST",
            url  : "<?php echo base_url('pesan/simpan')?>",
            dataType : "JSON",
            data : {id_pesan:id_pesan, diskon:diskon, nm_plg:nm_plg, no_telp:no_telp ,alamat:alamat},
            success: function(data){
              $('[name="id_pesan"]').val();
              $('[name="diskon"]').val();
              $('[name="nm_plg"]').val();
              $('[name="no_telp"]').val();
              $('[name="alamat"]').val();
              $('#ModalTambahPesan').modal('hide');

              $.ajax({
                type : "GET",
                url  : "<?php echo base_url('ControllerPesan/load_detail')?>",
                dataType : "JSON",
                success: function(data){

                  $.each(data,function(index,objek){
                    var id = objek.id;
                    var qty = objek.qty;
                    var price = objek.price;
              
                    $.ajax({
                      type : "POST",
                      url  : "<?php echo base_url('pesan/simpan_detail')?>",
                      dataType : "JSON",
                      data : {id_brg:id, id_pesan:id_pesan, qty:qty, jml_bayar:price},

                    }); 

                  });
                }
              });  

              swal({
                  title: "Berhasil Disimpan",
                  text: "",
                  icon: "success",
                  button: "Ok !",
                }).then(function() {
                  $('#detail_cart').load('<?php echo base_url('pesan/destroy') ?>');
                  window.location.href = "<?php echo site_url('pesan') ?>";
              });
            }
          });
          return false;
        });
    });
</script> 