@extends('voyager::master')
@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-file-text"></i> Resumen de Regalos
        </h1>
        @include('voyager::multilingual.language-selector')
    </div>
@stop
@section('content')
@if (isset($giftSelected) && count($giftSelected) > 0)
<div class="page-content browse container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-boarded">
                <div class="panel-body">
                    <h4>Gifts already selected</h4>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @php
                                    dd($confirmedGuests)
                                @endphp --}}
                                @foreach($giftSelected as $gift)
                                <tr>
                                    <td>{{ $gift->name}}</td>
                                    <td><img class="img-responsive-table" src="{{ url('storage/'.$gift->image) }}" alt="broken link"></td>
                                    <td>{{ $gift->price }}</td>
                                    <td><a target="_blank" href="{{ $gift->link }}">Open Link</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if (isset($giftAvailable) && count($giftAvailable) > 0)
<div class="page-content browse container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-boarded">
                <div class="panel-body">
                    <h4>Gifts availables</h4>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($giftAvailable as $gift)
                                <tr>
                                    <td>{{ $gift->name}}</td>
                                    <td><img class="img-responsive-table" src="{{ url('storage/'.$gift->image) }}" alt="broken link"></td>
                                    <td>{{ $gift->price }}</td>
                                    <td><a target="_blank" href="{{ $gift->link }}">Open Link</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('css')
    <style>
        .img-responsive-table {
            max-width: 200px;
            height: auto;
        }
    </style>
    <link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@stop
@section('javascript')
{{--     <script src="{{ voyager_asset('lib/js/dataTables.responsive.min.js') }}"></script>
 --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
     alpha/css/bootstrap.css" rel="stylesheet">
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@stop
