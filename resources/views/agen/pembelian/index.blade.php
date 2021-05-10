@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="card-box table-responsive">


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
            <th>Nama Sales</th>
            <th>Hp Sales</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>


          @foreach ($kedatangan as $key=>$value)

          <tr>
            <td>{{$key+1}}</td>
            <td>{{$value->sales['name']}}</td>
            <td>{{$value->sales['nomor_hp']}}</td>
            <td>
              <a href="{{route('pembelian.tambah',$value->id)}}" class="btn btn-success btn-sm modal_edit"><i class="fa fa-edit"></i></a>
            </td>

          </tr>

          @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>


@endsection