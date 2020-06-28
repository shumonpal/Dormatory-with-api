@if($records->count() > 0)
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Person Name</th>
                <th>ID Number</th>
                <th>Morning</th>
                <th>Evenning</th>
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
                        <input class="form-control add_temp_record" type="number" name="morning" max="120">
                    </form>
                </td>
                <td>
                    <form action="{{route('temparatures.store')}}" method="post">
                        <input type="hidden" name="created_at" value="{{$date}}">
                        <input type="hidden" name="room_id" value="{{ $person->room_id }}">
                        <input type="hidden" name="people_id" value="{{ $person->id }}">
                        <input class="form-control add_temp_record" type="number" name="evenning" max="120">                
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@else
<div class="alert alert-warning">No record in this room</div>
@endif
