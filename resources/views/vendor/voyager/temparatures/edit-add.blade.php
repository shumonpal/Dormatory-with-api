@php
$edit = !is_null($dataTypeContent->getKey());
$add = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).'
'.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
<h1 class="page-title">
    <i class="{{ $dataType->icon }}"></i>
    {{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
</h1>
@include('voyager::multilingual.language-selector')
@stop

@section('content')
<div class="page-content browse container-fluid">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-12">
            @if (session('errors'))
            <ul class="alert alert-warning">
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
            @endif
            <form action="{{route('temparatures.add')}}" method="post">
                @csrf
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="form-group col-md-4">
                            <label for="room_id">Select Room</label>
                            <select name="room_id" class="select2">
                                <option value="">Select Room</option>
                                @foreach(auth()->user()->rooms as $room)
                                <option value="{{$room->id}}">{{$room->room_no}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="created_at">Select Date</label>
                            <input type="date" name="created_at" class="form-control"
                                value="{{\Carbon\Carbon::parse(\Carbon\Carbon::now())->format('Y-d-m')}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="period">Select Period of Day</label>
                            <select name="period" class="select2">
                                <option value="">Select Period</option>
                                <option value="morning">Morning</option>
                                <option value="evenning">Evenning</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <div class="btn-group" role="group" aria-label="..." style="margin-top:20px">
                                <button type="Submit" class="btn btn-info get_data_by_form_submit">Show People</button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body ajax-data"></div>
                </div>
            </form>
        </div>
    </div>
</div>


@stop