@if($records->count() > 0)
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Person Name</th>
                <th>ID Number</th>
                <th>{{Str::title($period)}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $key => $person)
            <tr id="person-{{$person->id}}">
                <td>{{ $key+1 }}</td>
                <td>{{ $person->name }}</td>
                <td>{{ $person->indentity }}</td>
                <td>
                    <form action="{{route('temparatures.store')}}" method="post">
                        <input type="hidden" name="created_at" value="{{$date}}">
                        <input type="hidden" name="room_id" value="{{ $person->room_id }}">
                        <input type="hidden" name="people_id" value="{{ $person->id }}">
                        <input class="form-control add_temp_record" type="number" step="any" name="{{$period}}">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="form-group col-md-3">
    <div class="btn-group" role="group" aria-label="..." style="margin-top:20px">
        <button type="Submit" class="btn btn-warning">Download PDF <span class="glyphicon glyphicon-download"
                aria-hidden="true"></span></button>
    </div>
</div>
</div>
@else
<div class="alert alert-warning">No record in this room</div>
@endif