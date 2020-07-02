@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.$dataType->getTranslatedAttribute('display_name_plural'))

@section('page_header')
<div class="container-fluid">
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ $dataType->getTranslatedAttribute('display_name_plural') }}
    </h1>
    @can('add', app($dataType->model_name))
    <a href="{{ route('voyager.'.$dataType->slug.'.index') }}" class="btn btn-success btn-add-new">
        <i class="voyager-list"></i> <span>Go to List</span>
    </a>
    @endcan
    @can('delete', app($dataType->model_name))
    @include('voyager::partials.bulk-delete')
    @endcan
    @can('edit', app($dataType->model_name))
    @if(isset($dataType->order_column) && isset($dataType->order_display_column))
    <a href="{{ route('voyager.'.$dataType->slug.'.order') }}" class="btn btn-primary btn-add-new">
        <i class="voyager-list"></i> <span>{{ __('voyager::bread.order') }}</span>
    </a>
    @endif
    @endcan
    @can('delete', app($dataType->model_name))
    @if($usesSoftDeletes)
    <input type="checkbox" @if ($showSoftDeleted) checked @endif id="show_soft_deletes" data-toggle="toggle"
        data-on="{{ __('voyager::bread.soft_deletes_off') }}" data-off="{{ __('voyager::bread.soft_deletes_on') }}">
    @endif
    @endcan
    @foreach($actions as $action)
    @if (method_exists($action, 'massAction'))
    @include('voyager::bread.partials.actions', ['action' => $action, 'data' => null])
    @endif
    @endforeach
    @include('voyager::multilingual.language-selector')
</div>
@stop

@section('content')
<div class="page-content browse container-fluid">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered" style="margin-bottom: 0;">

                <div class="panel-body custom-panel-body">


                    <div class="panel-header">
                        <div class="form-group col-md-5">
                            <label for="room_id">Search by Room</label>
                            <select data-name="room_id" class="select2 get_data_by_change"
                                data-href="{{route('people.by-room')}}">
                                <option value="">Select Room</option>
                                @foreach(auth()->user()->rooms as $room)
                                <option value="{{$room->id}}">{{$room->room_no}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="company_id">Search by Company</label>
                            <select data-name="company_id" class="select2 get_data_by_change"
                                data-href="{{route('people.by-room')}}">
                                <option value="">Select Room</option>
                                @foreach(auth()->user()->companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- </form> --}}
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

{{-- Single delete modal --}}
<div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }}
                    {{ strtolower($dataType->getTranslatedAttribute('display_name_singular')) }}?</h4>
            </div>
            <div class="modal-footer">
                <form action="#" id="delete_form" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-danger pull-right delete-confirm custom_delete"
                        value="{{ __('voyager::generic.delete_confirm') }}">
                </form>
                <button type="button" class="btn btn-default pull-right"
                    data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop