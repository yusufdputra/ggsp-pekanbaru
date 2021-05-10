@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card-box table-responsive">
      <div class="align-items-center">

        <a href="{{route('agen.tambah')}}" class="btn btn-primary m-l-10 waves-light  mb-5">Tambah</a>

      </div>



      @if(\Session::has('alert'))
      <div class="alert alert-danger">
        <div>{{Session::get('alert')}}</div>
      </div>
      @endif

      @if(\Session::has('success'))
      <div class="alert alert-success">
        <div>{{Session::get('success')}}</div>
      </div>
      @endif


      <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Username</th>
            <th>Area Office</th>
            <th>Kode Outlet</th>
            <th>Nama Outlet</th>
            <th>GGSP Type</th>
            <th>Jenis Toko</th>
            <th>Pic Outlet</th>
            <th>Nomor Hp</th>
            <th>Alamat</th>
            <th>Kabupaten</th>
            <th>Kecamatan</th>
            <th>Kelurahan</th>
            <!-- <th>Sales</th> -->
            <th>Action</th>
          </tr>
        </thead>

        <tbody>

          @foreach ($users as $key=>$value)

          <tr>
            <td>{{$key+1}}</td>
            <td>{{($value->user['username'])}}</td>
            <td>{{strtoupper($value->kabupaten['nama'])}}</td>
            <td>{{strtoupper($value->kode_outlet)}}</td>
            <td>{{strtoupper($value->name)}}</td>
            <td>{{strtoupper($value->ggsp_type)}}</td>
            <td>{{strtoupper($value->jenis_toko)}}</td>
            <td>{{strtoupper($value->pic_outlet)}}</td>
            <td>{{strtoupper($value->nomor_hp)}}</td>
            <td>{{strtoupper($value->nama_jalan)}}</td>
            <td>{{strtoupper($value->kabupaten['nama'])}}</td>
            <td>{{strtoupper($value->kecamatan['nama'])}}</td>
            <td>{{strtoupper($value->kelurahan['nama'])}}</td>
           

            <td>
              <a href="{{route('agen.edit',$value->id)}}" class="btn btn-success btn-sm modal_edit"><i class="fa fa-edit"></i></a>

              <a href="#hapus-modal" data-animation="sign" data-plugin="custommodal" data-id='{{$value->id}}' data-iduser='{{$value->id_user}}' data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-danger btn-sm hapus"><i class="fa fa-trash"></i></a>

              <a href="#edit-password" data-animation="sign" data-plugin="custommodal" data-id='{{$value->id_user}}' data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-warning btn-sm modal_pw"><i class="fa fa-lock"></i></a>
            </td>
          </tr>

          @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- end row -->
<div id="view-image-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Foto Sales Depan Toko</h4>
    </div>
    <div class="p-20 ">
      <div class="form-group text-left">
        <label class="" for="">Nama Sales</label>
        <div class="col-xs-12">
          <input class="form-control" readonly id="nama_sales_view">
        </div>
      </div>
      <div class="m-b-20" id="">
        <div class="load">
        </div>

        <div class="m-b-20" id="img_view">
        </div>
      </div>
    </div>
  </div>

</div>

<div id="edit-password" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text text-left">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Reset Password {{$jenis}}</h4>
    </div>
    <div class="p-20">

      <form class="form-horizontal m-t-20" action="{{route('agen.resetpw')}}" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="id" id="pw_id">


        <div class="form-group">
          <label for="">Password Baru</label>
          <div class="col-xs-12">
            <input class="form-control" type="text" autocomplete="off" name="password" required="" placeholder="Masukkan Password Baru">
          </div>
        </div>


        <div class="form-group text-center m-t-30">
          <div class="col-xs-12">
            <button class="btn btn-success btn-bordred btn-block waves-effect waves-light" type="submit">Reset</button>
          </div>
        </div>


      </form>

    </div>
  </div>

</div>

<div id="hapus-modal" class="modal-demo">
  <button type="button" class="close" onclick="Custombox.close();">
    <span>&times;</span><span class="sr-only">Close</span>
  </button>

  <div class="custom-modal-text">

    <div class="text-center">
      <h4 class="text-uppercase font-bold mb-0">Hapus {{$jenis}}</h4>
    </div>
    <div class="p-20">

      <form class="form-horizontal m-t-20" enctype="multipart/form-data" action="{{route('agen.hapus')}}" method="POST">
        {{csrf_field()}}
        <div>
          <input type="hidden" id='id_hapus' name='id'>
          <input type="hidden" id='id_user_hapus' name='id_user'>
          <input type="hidden" id='jenis_hapus' name='jenis'>
          <h5 id="exampleModalLabel">Apakah anda yakin ingin mengapus {{$jenis}} ini?</h5>
        </div>

        <div class="form-group text-center m-t-30">
          <div class="col-xs-6">
            <button type="button" onclick="Custombox.close();" class="   btn btn-primary btn-bordred btn-block waves-effect waves-light">Tidak</button>
            <button class="btn btn-danger btn-bordred btn-block waves-effect waves-light" type="submit">Hapus</button>
          </div>
        </div>


      </form>

    </div>
  </div>

</div>

<script type="text/javascript">
  $('.hapus').click(function() {
    var id = $(this).data('id');
    var id_user = $(this).data('iduser');
    $('#id_hapus').val(id);
    $('#id_user_hapus').val(id_user);
  });



  $('.modal_pw').click(function() {
    var id = $(this).data('id');
    $('#pw_id').val(id);
  });

  $('.view_image').click(function() {
    $('#img_view').html('')
    var nama = $(this).data('nama');
    var foto_path = $(this).data('path');
    var nama_v = document.getElementById('nama_sales_view').value = nama
    // var img_view = document.getElementById('img_view')
    $('#load').append('<i class="fa fa-spin fa-circle-o-notch"></i>')
    $('#img_view').append('<img src="storage/' + foto_path + '" id="img_vsiew_porto" class="m-b-20 thumb-img" alt="work-thumbnail">')
    $('#load').html('')
    

  });
</script>

@endsection