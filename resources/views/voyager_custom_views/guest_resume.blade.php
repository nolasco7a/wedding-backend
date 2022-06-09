@extends('voyager::master')
@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-file-text"></i> Resumen de invitados 
            <a href="{{ route('sendPendingInvitations') }}" class="btn btn-success add_item">
                <i class="voyager-megaphone"></i> <span class="hidden-xs hidden-sm">Enviar invitaciones </span>
            </a>
        </h1>
        @include('voyager::multilingual.language-selector')
    </div>
@stop
@section('content')
@if (isset($confirmedGuests) && count($confirmedGuests) > 0)
<div class="page-content browse container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-boarded">
                <div class="panel-body">
                    <h4>Confirmed guests</h4>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone number</th>
                                    <th>Childs</th>
                                    <th>Confirmation date</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @php
                                    dd($confirmedGuests)
                                @endphp --}}
                                @foreach($confirmedGuests as $guest)
                                <tr>
                                        <td>{{ $guest['name'] }} {{ $guest['last_name'] }}</td>
                                        <td>{{ $guest['email'] }} </td>
                                        <td>{{ $guest['phone'] }}</td>
                                        <td>{{ $guest['childrens'] }}</td>
                                        <td>{{ $guest['updated_at'] }} <i style="color: green; font-weight: 700; margin-left: 1rem" class="voyager-check"></i></td>
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

@if (isset($pendingInvitations) && count($pendingInvitations) > 0)
<div class="page-content browse container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-boarded">
                <div class="panel-body">
                    <h4>Invitations pending to send</h4>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone number</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingInvitations as $guest)
                                <tr>
                                        <td>{{ $guest->first_name }} {{ $guest->lastname }} </td>
                                        <td>{{ $guest->email }} </td>
                                        <td>{{ $guest->phone_number }} </td>
                                        <td>
                                            <a href="{{ route('sendInvitation', ['id'=>$guest->id]) }}" title="View" class="btn btn-sm btn-primary view">
                                                <i class="voyager-mail"></i> <span class="hidden-xs hidden-sm">Send invitation</span>
                                            </a>
                                        </td>
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

@if (isset($pendingGuests) && count($pendingGuests) > 0)
<div class="page-content browse container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-boarded">
                <div class="panel-body">
                    <h4>Invitations pending to confirmed</h4>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone number</th>
                                    <th>Invitation sent</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingGuests as $guest)
                                <tr>
                                        <td>{{ $guest->first_name }} {{ $guest->lastname }} </td>
                                        <td>{{ $guest->email }} </td>
                                        <td>{{ $guest->phone_number }} </td>
                                        <td>{{ date_format($guest['updated_at'],"d-m-Y") }} <i style="color: grey; font-weight: 700; margin-left: 1rem" class="voyager-logbook"></i></td>
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
{{--     <link rel="stylesheet" href="{{ voyager_asset('lib/css/responsive.dataTables.min.css') }}">
 --}}    
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
