@extends('layouts.master')

@section('css')

@endsection

@section('content')

@if(count($errors) > 0)
  <div class="alert alert-danger">
      <ul>
          @foreach($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
      </ul>
  </div>
@endif

@if(Session::has('success'))
  <div class="alert alert-success">
    <p id="success">{{ \Session::get('success') }}</p>
  </div>
@endif

<h4 class="font-size-18">Tambah Produk Type</h4>

<div class="card">
  <div class="card-body">
      @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif

      <form action="{{route('koperasi.storeType')}}" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <label>* Nama Produk</label></br>
        <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan Nama Produk"  value="" required></br>

        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">Simpan</button>
    </form>
  
  </div>
</div>
<br>
<div class="card">
  <div class="card-body">
  <div class="table-responsive">
          <table id="donationTable" class="table table-bordered table-striped dt-responsive"
            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
              <tr style="text-align:center">
                <th> No. </th>
                <th> Nama jenis produk </th>
                <th> Action </th>
              </tr>
            </thead>
            @foreach($group as $group)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $group->name }}</td>
                                        <td> 
                                        <a href="{{ route('koperasi.editType',$group->id) }}" style="display:inline"><button class="btn btn-primary mr-1">Edit</button>
                                          <a href="{{ route('koperasi.deleteType',$group->id) }}" style="display:inline"> <button type="submit" class="btn btn-danger m-1">Padam</button>
                                      
                                      </td>
                                    </tr>
            @endforeach
</table>
  </div>
</div>
</div>
@endsection