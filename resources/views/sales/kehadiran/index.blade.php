@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card-box table-responsive">

      @role('agen')
      <div class="alert alert-success">
        Kamu Berada Diperingkat : <strong> {{$peringkat}}</strong>
      </div>

      @endrole

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
            <th>Waktu Kehadiran</th>
            <th>Nama Sales</th>
            <th>Nama Toko</th>
            <th>Alamat Toko</th>
            <th>Provinsi</th>
            <th>Kabupaten</th>
            <th>Kelurahan</th>
            <th>Foto</th>

          </tr>
        </thead>
        <tbody>
          @foreach ($kehadiran AS $key=>$value)

          <tr>
          

            <td>{{$key+1}}</td>
            <td>{{date("d-M-Y H:m ", strtotime(($value->created_at)))}} WIB</td>
            <td>{{strtoupper($value->sales['name'])}}</td>
            <td>{{strtoupper($value->agen['name'])}}</td>
            <td>{{strtoupper($value->agen['nama_jalan'])}}</td>
            <td>{{strtoupper($value->agen->provinsi['nama'])}}</td>
            <td>{{strtoupper($value->agen->kabupaten['nama'])}}</td>
            <td>{{strtoupper($value->agen->kelurahan['nama'])}}</td>
           <td>
           <a href="#view-image-modal" data-animation="sign" data-plugin="custommodal" data-nama='{{$value->sales["name"]}}' data-path='{{$value->foto_path_sales}}' data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-primary btn-sm view_image"><i class=" mdi mdi-eye"></i></a>
           </td>

          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

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

<script type="text/javascript">

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