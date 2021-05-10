@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card-box table-responsive">
      <div class="align-items-center">

        <a href="#" onclick="history.back()" class="btn btn-primary m-l-10 m-b-20 waves-light">Kembali</a>

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

      <table id="datatable" class="table table-striped table-bordered text-center " cellspacing="0" width="100%">
        <thead>
          <tr>

            <th class=" align-middle" rowspan="3">No</th>
            <th class=" align-middle" rowspan="3">Nama Sales</th>
            <th class=" align-middle" rowspan="3">Week</th>
            @foreach ($barang AS $key=>$value)
            <th colspan="10">{{$value->nama}}</th>
            @endforeach
            <th class=" align-middle" rowspan="3">Foto</th>
          </tr>
          <tr>
            @foreach ($barang AS $key=>$value)
            <th colspan="2">STOK</th>
            <th colspan="2">BELANJA</th>
            <th colspan="2">DISPLAY</th>
            <th colspan="2">DISPLAY OTHER</th>
            <th colspan="2">PACK KOSONG</th>
            @endforeach
          </tr>
          <tr>
            @foreach ($barang AS $key=>$value)
            @for($i = 0; $i < 5; $i++) 
              <td>ACT</td>
              <td>POIN</td>
              @endfor
              @endforeach
          </tr>

        </thead>
        <tbody>
          @foreach ($pembelian AS $key=>$v)

          <tr>
            <td>{{$key+1}}</td>
            <td>{{strtoupper($v->kedatangan->sales['name'])}}</td>
            <td>{{$v->week}}</td>
            @php
            $arr_stok = unserialize($v->stok);
            $arr_belanja = unserialize($v->belanja);
            $arr_display = unserialize($v->display);
            $arr_dis_other = unserialize($v->display_other);
            $arr_pack_kosong = unserialize($v->pack_kosong);
            @endphp
            @foreach ($barang AS $key=>$value)
            <!-- stok -->
            <td>{{$arr_stok[$key]['stok']}}</td>
            <td>{{$arr_stok[$key]['stok_poin']}}</td>

            <!-- belanja -->
            <td>{{$arr_belanja[$key]['belanja']}}</td>
            <td>{{$arr_belanja[$key]['belanja_poin']}}</td>

            <!-- display -->
            <td>{{$arr_display[$key]['display']}}</td>
            <td>{{$arr_display[$key]['display_poin']}}</td>

            <!-- display other-->
            <td>{{$arr_dis_other[$key]['dis_other']}}</td>
            <td>{{$arr_dis_other[$key]['dis_other_poin']}}</td>

            <!-- pack kosong-->
            <td>{{$arr_pack_kosong[$key]['pack_kosong']}}</td>
            <td>{{$arr_pack_kosong[$key]['pack_kosong_poin']}}</td>

          
            
            @endforeach
            <td>
              <a href="#view-image-modal" data-animation="sign" data-plugin="custommodal" data-path='{{$v->foto_display}}'  data-overlaySpeed="100" data-overlayColor="#36404a" class="btn btn-primary btn-sm view_image"><i class=" mdi mdi-eye"></i></a>
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
    var foto_path = $(this).data('path');
    // var img_view = document.getElementById('img_view')
    $('#load').append('<i class="fa fa-spin fa-circle-o-notch"></i>')
    $('#img_view').append('<img src="../storage/' + foto_path + '" id="img_vsiew_porto" class="m-b-20 thumb-img" alt="work-thumbnail">')
    $('#load').html('')


  });

  </script>

@endsection