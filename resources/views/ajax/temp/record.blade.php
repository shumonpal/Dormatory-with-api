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
                <td>{{ $person->people->name }}</td>
                <td>{{ $person->people->indentity }}</td>
                <th>{{ $person->morning }}</th>
                <th>{{ $person->evenning }}</th>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="form-group col-md-2">
    <label for=""></label>
    <input type="Submit" class="form-control btn btn-info" value="Download PDF">
</div>
@else
<div class="alert alert-warning">No record in this room</div>
@endif