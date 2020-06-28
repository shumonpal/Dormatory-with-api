
@if($view !== 'browse')
    <input type="hidden" name="already_exists" value="">
    <?php $selected_value = (isset($dataTypeContent->{$row->field}) && !is_null(old($row->field, $dataTypeContent->{$row->field}))) ? old($row->field, $dataTypeContent->{$row->field}) : old($row->field); ?>
    @if(isset(auth()->user()->rooms))
    <select class="form-control select2" name="room_id">
        <option value="">None</option>      
        @foreach(auth()->user()->rooms as $room)
        <option value="{{$room->id}}" {{isset($selected_value) && $selected_value == $room->id ? 'selected' : ''}}>{{$room->room_no}}</option>
        @endforeach 
    </select>
    @endif
@else
    @if (isset($row->details->view))
    <div>{{ $data->room->room_no }}</div>
    @endif
@endif

