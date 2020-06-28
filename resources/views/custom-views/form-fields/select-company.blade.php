

@if($view !== 'browse')
    <?php $selected_value = (isset($dataTypeContent->{$row->field}) && !is_null(old($row->field, $dataTypeContent->{$row->field}))) ? old($row->field, $dataTypeContent->{$row->field}) : old($row->field); ?>
    @if(isset(auth()->user()->companies))
    <select class="form-control select2" name="company_id">
        <option value="">None</option>      
        @foreach(auth()->user()->companies as $company)
        <option value="{{$company->id}}" {{isset($selected_value) && $selected_value == $company->id ? 'selected' : ''}}>{{$company->name}}</option>
        @endforeach 
    </select>
    @endif
@else
    @if (isset($row->details->view))
    <div>{{ $data->company->name }}</div>
    @endif
@endif
