@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="card-box table-responsive">
      <div class="align-items-center">

        <a href="#" onclick="history.back()" class="btn btn-primary waves-light">Kembali</a>

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

      @php
      $n_barang = count($barangs);
      @endphp
      <form class="form-horizontal m-t-20 " enctype="multipart/form-data" action="{{route('pembelian.store')}}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" id="n_barang" value="{{$n_barang}}">
        <input type="hidden" name="id_kedatangan" value="{{$id_kedatangan}}">
        <div id="progressbarwizard" class="pull-in ">
          <ul class="nav nav-tabs nav-justified">

            @foreach ($barangs AS $key=>$value)
            <li class="nav-item"><a href="#{{$value->id}}" data-toggle="tab" class="nav-link">{{$value->nama}}</a></li>
            @endforeach
            <li class="nav-item"><a href="#{{$n_barang+1}}" data-toggle="tab" class="nav-link">Foto</a></li>
          </ul>

          <div class="tab-content b-0 mb-0">

            <div id="bar" class="progress progress-striped progress-bar-primary-alt">
              <div class="bar progress-bar progress-bar-primary"></div>
            </div>
            @foreach ($barangs AS $key=>$value)
            <input type="hidden" name="id_barang[{{$value->id}}]" value="{{$value->id}}" id="">
            <div class="tab-pane p-t-10 fade" id="{{$value->id}}">
              <div class="row">
                <div class="col-12 ">

                  <div class="form-row ">
                    <div class="col-6">
                      <div class="form-group row clearfix">
                        <label class="col-md-3 control-label ">Stock</label>
                        <div class="col-md-9">
                          <input onchange="PoinStok('{{$value->id}}', this.value)" min="0" class="form-control required" id="stok_{{$value->id}}" name="stok[{{$value->id}}]" type="number">
                        </div>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group row clearfix">
                        <label class="col-md-3 control-label ">Poin</label>
                        <div class="col-md-9">
                          <input class="form-control required" readonly id="poin_stok_{{$value->id}}" name="poin_stok[{{$value->id}}]" type="number">
                        </div>
                      </div>
                    </div>



                  </div>


                  <div class="form-row ">
                    <div class="col-6">
                      <div class="form-group row clearfix">
                        <label class="col-md-3 control-label ">Belanja</label>
                        <div class="col-md-9">
                          <input class="form-control required" min="0" onchange="PoinBelanja('{{$value->id}}', this.value)" name="belanja[{{$value->id}}]" type="number">
                        </div>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group row clearfix">
                        <label class="col-md-3 control-label ">Poin</label>
                        <div class="col-md-9">
                          <input class="form-control required" readonly id="poin_belanja_{{$value->id}}" name="poin_belanja[{{$value->id}}]" type="number">
                        </div>
                      </div>
                    </div>

                  </div>


                  <div class="form-row ">
                    <div class="col-6">
                      <div class="form-group row clearfix">
                        <label class="col-md-3 control-label ">Display</label>
                        <div class="col-md-9">
                          <input class="form-control required" min="0" onchange="PoinDisplay('{{$value->id}}', this.value)" name="display[{{$value->id}}]" type="number">
                        </div>
                      </div>
                    </div>


                    <div class="col-6">
                      <div class="form-group row clearfix">
                        <label class="col-md-3 control-label ">Poin</label>
                        <div class="col-md-9">
                          <input class="form-control required" readonly id="poin_display_{{$value->id}}" name="poin_display[{{$value->id}}]" type="number">
                        </div>
                      </div>
                    </div>

                  </div>


                  <div class="form-row ">
                    <div class="col-6">
                      <div class="form-group row clearfix">
                        <label class="col-md-3 control-label ">Display Other</label>
                        <div class="col-md-9">
                          <input class="form-control required" min="0" onchange="PoinDisplayOther('{{$value->id}}', this.value)" name="dis_other[{{$value->id}}]" type="number">
                        </div>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group row clearfix">
                        <label class="col-md-3 control-label ">Poin</label>
                        <div class="col-md-9">
                          <input class="form-control required" readonly id="poin_dis_other_{{$value->id}}" name="poin_dis_other[{{$value->id}}]" type="number">
                        </div>
                      </div>
                    </div>


                  </div>


                  <div class="form-row ">
                    <div class="col-6">
                      <div class="form-group row clearfix">
                        <label class="col-md-3 control-label ">Pack Kosong</label>
                        <div class="col-md-9">
                          <input class="form-control required " min="0" onchange="PoinKosong('{{$value->id}}', this.value)" name="pack_kosong[{{$value->id}}]" type="number">
                        </div>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group row clearfix">
                        <label class="col-md-3 control-label ">Poin</label>
                        <div class="col-md-9">
                          <input class="form-control required" readonly id="poin_pack_kosong_{{$value->id}}" name="poin_pack_kosong[{{$value->id}}]" type="number">
                        </div>
                      </div>
                    </div>
                  </div>


                </div>
              </div>
            </div>
            @endforeach
            <div class="tab-pane p-t-10 fade" id="{{$n_barang+1}}">
              <div class="row">
                <div class="col-12 ">
                  <div class="form-row ">
                  
                    <div class="col-12">
                      <div class="form-group row clearfix">
                        <label class="col-md-3 control-label ">Foto</label>
                        <div class="col-md-9">
                          <input data-height="250" class="dropify" data-max-file-size="5M" accept=".png, .jpg, .jpeg" name="foto_display" type="file">
                        </div>
                      </div>
                    </div>

                  </div>



                </div>
              </div>
            </div>

            <ul class="list-inline mb-0 wizard">
              <li class="previous list-inline-item first" style="display:none;"><a href="#">First</a>
              </li>
              <li class="previous list-inline-item"><a href="#" class="btn btn-danger waves-effect waves-light">Previous</a></li>
              <li class="next last list-inline-item" style="display:none;"><a href="#">Last</a></li>
              <li id="btn_next" class="next list-inline-item float-right"><a href="#" class="btn btn-primary waves-effect waves-light">Next</a></li>
              <li id="btn_submit" class="list-inline-item float-right"><button class="btn btn-success waves-effect waves-light">Submit</button></li>


            </ul>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end row -->

<script type="text/javascript">
  $(document).ready(function() {
    $('#basicwizard').bootstrapWizard({
      'tabClass': 'nav nav-tabs navtab-wizard nav-justified bg-muted'
    });

    $('#progressbarwizard').bootstrapWizard({
      onTabShow: function(tab, navigation, index) {
        var $total = navigation.find('li').length;
        var $current = index + 1;

        var $percent = ($current / $total) * 100;
        $('#progressbarwizard').find('.bar').css({
          width: $percent + '%'
        });

        if ($current == ($total)) {
          $('#btn_next').attr("hidden", true);
          $('#btn_submit').attr("hidden", false);
        } else {
          $('#btn_next').attr("hidden", false);
          $('#btn_submit').attr("hidden", true);
        }
      },
      'tabClass': 'nav nav-tabs navtab-wizard nav-justified bg-muted'
    });

    $('#btnwizard').bootstrapWizard({
      'tabClass': 'nav nav-tabs navtab-wizard nav-justified bg-muted',
      'nextSelector': '.button-next',
      'previousSelector': '.button-previous',
      'firstSelector': '.button-first',
      'lastSelector': '.button-last'
    });






  });

  $(document).ready(function() {
    $(window).keydown(function(event) {
      if (event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    });
  });

  function PoinStok(id, nilai) {
    $('#poin_stok_' + id).val(nilai * 2)
  }

  function PoinBelanja(id, nilai) {
    $('#poin_belanja_' + id).val(nilai * 10)
  }

  function PoinDisplay(id, nilai) {
    $('#poin_display_' + id).val(nilai * 2)
  }

  function PoinDisplayOther(id, nilai) {
  
    $('#poin_dis_other_' + id).val(nilai * (-25))
  }

  function PoinKosong(id, nilai) {
    $('#poin_pack_kosong_' + id).val(nilai * 5)
  }
</script>

@endsection