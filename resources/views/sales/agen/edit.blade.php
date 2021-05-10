@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card-box table-responsive">
      <div class="align-items-center">

        <a href="#" onclick="history.back()" class="btn btn-primary m-l-10 waves-light">Kembali</a>

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

      <div class="">


        <form class="form-horizontal m-t-20" enctype="multipart/form-data" action="{{route('agen.update')}}" method="POST">
          {{csrf_field()}}

          <input type="hidden" name="id_agen" value="{{$user[0]['id']}}" id="">
          <input type="hidden" name="id_user" value="{{$user[0]['id_user']}}" id="">

          <div class="form-group">
            <label for="">Nama Outlet</label>
            <div class="col-xs-12">
              <input class="form-control" value="{{$user[0]['name']}}" type="text" autocomplete="off" name="nama" required="" placeholder="Nama Outlet">
            </div>
          </div>

          <div class="form-group">
            <label for="">Username</label>
            <div class="col-xs-12">
              <input class="form-control" type="text" value="{{$user[0]['user']['username']}}" autocomplete="off" name="username" required="" placeholder="Username">
            </div>
          </div>

          <div class="form-group">
            <label for="">Kode Outlet</label>
            <div class="col-xs-12">
              <input class="form-control" type="text" value="{{$user[0]['kode_outlet']}}" autocomplete="off" name="kode_outlet" required="" placeholder="Kode Outlet">
            </div>
          </div>
          <div class="form-group">
            <label for="">GGSP Type</label>
            <div class="col-xs-12">
              <input class="form-control" type="text" value="{{$user[0]['ggsp_type']}}" autocomplete="off" name="ggsp_type" required="" placeholder="GGSP Type">
            </div>
          </div>
          <div class="form-group">
            <label for="">Jenis Toko</label>
            <div class="col-xs-12">
              <input class="form-control" type="text" value="{{$user[0]['jenis_toko']}}" autocomplete="off" name="jenis_toko" required="" placeholder="Jenis Toko">
            </div>
          </div>
          <div class="form-group">
            <label for="">Pic Outlet</label>
            <div class="col-xs-12">
              <input class="form-control" type="text" value="{{$user[0]['pic_outlet']}}" autocomplete="off" name="pic_outlet" required="" placeholder="Pic Outlet">
            </div>
          </div>
          <div class="form-group">
            <label for="">Nomor Hp</label>
            <div class="col-xs-12">
              <input class="form-control" type="text" value="{{$user[0]['nomor_hp']}}" autocomplete="off" name="no_hp" required="" placeholder="Nomor Hp">
            </div>
          </div>

          <div class="form-group">
            <div class="row">

              <div class="col-6">
                <label for="">Provinsi</label>
                <select required class="form-control " id="provinsi" name="provinsi">
                  <option disabled selected>Pilih..</option>
                  @foreach ($provinsi as $key=>$value)
                  <option {{($user[0]['id_provinsi'] ==  $value->id_prov ? "selected":"" )}} value="{{$value->id_prov}}">{{$value->nama}}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-6">
                <label for="">Kabupaten</label>
                <select required class="form-control " id="kabupaten" name="kabupaten">
                  @foreach ($kabupatens as $key=>$value)
                  <option {{($user[0]['id_kabupaten'] ==  $value->id_kab ? "selected":"" )}} value="{{$value->id_kab}}">{{$value->nama}} </option>
                  @endforeach
                </select>
              </div>
            </div>

          </div>

          <div class="form-group">
            <div class="row">

              <div class="col-6">
                <label for="">Kecamatan</label>
                <select required class="form-control " id="kecamatan" name="kecamatan">
                  @foreach ($kecamatan as $key=>$value)
                  <option {{($user[0]['id_kecamatan'] ==  $value->id_kec ? "selected":"" )}} value="{{$value->id_kec}}">{{$value->nama}}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-6">
                <label for="">Kelurahan</label>
                <select required class="form-control select2" id="kelurahan" name="kelurahan">
                  @foreach ($kelurahan as $key=>$value)
                  <option {{($user[0]['id_kelurahan'] ==  $value->id_kel ? "selected":"" )}} value="{{$value->id_kel}}">{{$value->nama}}</option>
                  @endforeach
                </select>
              </div>
            </div>

          </div>


          <div class="form-group">
            <label for="">Nama jalan</label>
            <div class="col-xs-12">
              <textarea class="form-control" autocomplete="off" type="text" name="nama_jalan" required="" placeholder="Nama Jalan">{{$user[0]['nama_jalan']}}</textarea>
            </div>
          </div>


          <div class="form-group text-center m-t-30">
            <div class="col-xs-12">
              <button class="btn btn-success btn-bordred btn-block waves-effect waves-light" type="submit">Tambah</button>
            </div>
          </div>


        </form>

      </div>


    </div>
  </div>
</div>
<!-- end row -->


<script type="text/javascript">
  document.getElementById('provinsi').addEventListener("change", function() {
    $('#kabupaten').html('')
    $.ajax({
      url: '{{url("GetKabupaten")}}/' + this.value,
      type: 'GET',
      dataType: 'json',
      success: 'success',
      success: function(data) {
        data.forEach(element => {
          var opt_barang = new Option(element['nama'], element['id_kab'])
          $('#kabupaten').append(opt_barang)
        });

      },
      error: function(data) {
        toastr.error('Gagal memanggil data! ')
      }
    })
  })

  document.getElementById('kabupaten').addEventListener("change", function() {
    $('#kecamatan').html('')
    $.ajax({
      url: '{{url("GetKecamatan")}}/' + this.value,
      type: 'GET',
      dataType: 'json',
      success: 'success',
      success: function(data) {
        data.forEach(element => {
          var opt_barang = new Option(element['nama'], element['id_kec'])
          $('#kecamatan').append(opt_barang)
        });

      },
      error: function(data) {
        toastr.error('Gagal memanggil data! ')
      }
    })
  })

  document.getElementById('kecamatan').addEventListener("change", function() {
    $('#kelurahan').html('')
    $.ajax({
      url: '{{url("GetKelurahan")}}/' + this.value,
      type: 'GET',
      dataType: 'json',
      success: 'success',
      success: function(data) {
        data.forEach(element => {
          var opt_barang = new Option(element['nama'], element['id_kel'])
          $('#kelurahan').append(opt_barang)
        });

      },
      error: function(data) {
        toastr.error('Gagal memanggil data! ')
      }
    })
  })
</script>

@endsection