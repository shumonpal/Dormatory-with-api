@if($people->count() > 0)
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Person Name</th>
                <th>Company Name</th>
                <th>Room Name</th>
                <th>ID Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($people as $key => $person)
            <tr id="person-{{$person->id}}">
                <td>{{ $key+1 }}</td>
                <td>{{ $person->name }}</td>
                <td>{{ $person->company->name ?? 'No company' }}</td>
                <td>{{ $person->room->room_no ?? 'No people yet'}}</td>
                <td>{{ $person->indentity }}</td>
                <td class="no-sort no-click bread-actions ">
                    <a class="btn btn-primary btn-sm" href="{{ route('voyager.people.edit', $person->id) }}"><i
                            class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Edit</span></a>
                    <a title="Delete" class="btn btn-sm btn-danger custom_delete"
                        data-href="{{route('voyager.people.destroy', $person->id)}}" data-token="{{csrf_token()}}">
                        <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Delete</span>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@else
<div class="alert alert-warning">No people in this room</div>
@endif