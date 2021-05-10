@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card-box table-responsive">
      <div class="align-items-center">

        <a href="{{route('entri.tambah')}}" class="btn btn-primary m-l-10 waves-light  mb-5">Tambah</a>

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
          </tr>
        </thead>

        <tbody>


          @foreach ($kedatangan as $key=>$value)

          <tr>
            <td>{{$key+1}}</td>
            <td>{{strtoupper($value->agen->kabupaten['nama'])}}</td>
            <td>{{strtoupper($value->agen['kode_outlet'])}}</td>
            <td>{{strtoupper($value->agen['name'])}}</td>
            <td>{{strtoupper($value->agen['ggsp_type'])}}</td>
            <td>{{strtoupper($value->agen['jenis_toko'])}}</td>
            <td>{{strtoupper($value->agen['pic_outlet'])}}</td>
            <td>{{strtoupper($value->agen['nomor_hp'])}}</td>
            <td>{{strtoupper($value->agen['nama_jalan'])}}</td>
            <td>{{strtoupper($value->agen->kabupaten['nama'])}}</td>
            <td>{{strtoupper($value->agen->kecamatan['nama'])}}</td>
            <td>{{strtoupper($value->agen->kelurahan['nama'])}}</td>

          </tr>

          @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- end row -->



@endsection