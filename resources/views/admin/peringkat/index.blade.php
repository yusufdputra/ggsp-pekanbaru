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


      <table id="datatable-buttons"  class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>

            @hasanyrole('sales|admin')
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
            <th>Poin</th>
            @else
            <th>No</th>
            <th>Area Office</th>
            <th>Kode Outlet</th>
            <th>Nama Outlet</th>
            <th>Kabupaten</th>
            <th>Kecamatan</th>
            <th>Kelurahan</th>
            <th>Poin</th>
            @endhasanyrole
          </tr>
        </thead>
        <tbody>
          @foreach ($users AS $key=>$value)

          <tr>
            @hasanyrole('sales|admin')

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
            
            {{$value['poin']}}
            <a href="{{route('pembelian.history',$value->user['id'])}}" class="btn btn-success btn-sm "><i class="fa fa-eye"></i></a>
            
            </td>
            @else

            <td>{{$key+1}}</td>

            <td>{{strtoupper($value->kabupaten['nama'])}}</td>
            <td>{{strtoupper($value->kode_outlet)}}</td>
            <td>{{strtoupper($value->name)}}</td>
            <td>{{strtoupper($value->kabupaten['nama'])}}</td>
            <td>{{strtoupper($value->kecamatan['nama'])}}</td>
            <td>{{strtoupper($value->kelurahan['nama'])}}</td>
            <td>
            {{$value['poin']}}
            </td>
            @endhasanyrole


          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection