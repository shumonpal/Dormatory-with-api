@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.$dataType->getTranslatedAttribute('display_name_plural'))

@section('page_header')
<div class="container-fluid">
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ $dataType->getTranslatedAttribute('display_name_plural') }}
    </h1>
    @can('add', app($dataType->model_name))
    <a href="{{ route('voyager.'.$dataType->slug.'.create') }}" class="btn btn-success btn-add-new">
        <i class="voyager-plus"></i> <span>{{ __('voyager::generic.add_new') }}</span>
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
            <div class="panel panel-bordered">
                @if (request()->query('people') == 'high-temp')
                <div class="panel-header" style="margin: 20px 0 0 20px;">
                    <h4>People who have high temmparature</h4>
                </div>
                <div class="panel-body custom-panel-body">
                    @php
                    $temp = \App\Models\Temparature::query();
                    $peopleM = $temp->where('morning', '>', 37.3)->whereDate('created_at', today())->get();
                    $peopleE = $temp->where('evenning', '>', 37.3)->whereDate('created_at', today())->get();
                    $peopleM = $peopleM->pluck('people_id');
                    $peopleE = $peopleE->pluck('people_id');
                    $people = $peopleM->concat($peopleE);
                    $ids = $people->unique();
                    @endphp

                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Id</th>
                                    <th>Room name</th>
                                    <th>Temparature(morning)</th>
                                    <th>Temparature(evenning)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataTypeContent->whereIn('id', $ids) as $people)
                                <tr>
                                    <td>{{$people->people->name ?? 'No People'}}</td>
                                    <td>{{$people->people->indentity ?? 'No Id'}}</td>
                                    <td>{{$people->room->room_no ?? 'No Room'}}</td>
                                    <td>{{$people->morning}}</td>
                                    <td>{{$people->evenning}}</td>
                                    <td><a href="{{route('voyager.people.show',$people->people_id)}}"
                                            class="btn btn-sm btn-primary">Details</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                <div class="panel-header">
                    <form action="{{route('temparatures.record')}}" method="get">
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
                            <input type="date" name="created_at" class="form-control" placeholder="Select Date">
                        </div>
                        <div class="form-group col-md-2">
                            <label for=""></label>
                            <input type="Submit" class="form-control btn btn-info get_data_by_form_submit"
                                value="Show People">
                        </div>
                    </form>
                </div>
                @endif
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