@php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

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
                <div class="panel panel-bordered">
                    <div class="panel-body custom-panel-body">
                        <div class="panel-header">
                            <form action="{{route('temparatures.add')}}" method="post">
                                <div class="form-group col-md-5">
                                    <label for="room_id">Select Room</label>
                                    <select name="room_id" class="select2">
                                        <option value="">Select Room</option>
                                        @foreach(auth()->user()->rooms as $room)
                                        <option value="{{$room->id}}">{{$room->room_no}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="created_at">Select Date</label>
                                    <input type="date" name="created_at" class="form-control" 
                                        value="{{\Carbon\Carbon::parse(\Carbon\Carbon::now())->format('Y-d-m')}}">
                                </div>
                                <div class="form-group col-md-2">
                                     <label for=""></label>
                                    <input type="Submit" class="form-control btn btn-info get_data_by_form_submit" value="Show People">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 ajax-data">
            </div>
        </div>
    </div>

 
@stop
