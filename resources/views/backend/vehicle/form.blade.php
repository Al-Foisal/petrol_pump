<div class="form-group {{ $errors->has('model') ? 'has-error' : ''}}">
    <label for="model" class="control-label">{{ 'Model' }}</label>
    <input class="form-control" name="model" type="text" id="model" value="{{ isset($vehicle->model) ? $vehicle->model : ''}}" >
    {!! $errors->first('model', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('vehicle_number') ? 'has-error' : ''}}">
    <label for="vehicle_number" class="control-label">{{ 'Vehicle Number' }}</label>
    <input class="form-control" name="vehicle_number" type="text" id="vehicle_number" value="{{ isset($vehicle->vehicle_number) ? $vehicle->vehicle_number : ''}}" >
    {!! $errors->first('vehicle_number', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('supervisor_name') ? 'has-error' : ''}}">
    <label for="supervisor_name" class="control-label">{{ 'Supervisor Name' }}</label>
    <input class="form-control" name="supervisor_name" type="text" id="supervisor_name" value="{{ isset($vehicle->supervisor_name) ? $vehicle->supervisor_name : ''}}" >
    {!! $errors->first('supervisor_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('supervisor_mobile') ? 'has-error' : ''}}">
    <label for="supervisor_mobile" class="control-label">{{ 'Supervisor Mobile' }}</label>
    <input class="form-control" name="supervisor_mobile" type="number" id="supervisor_mobile" value="{{ isset($vehicle->supervisor_mobile) ? $vehicle->supervisor_mobile : ''}}" >
    {!! $errors->first('supervisor_mobile', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('vehicle_type') ? 'has-error' : ''}}">
    <label for="vehicle_type" class="control-label">{{ 'Vehicle Type' }}</label>
    <select name="vehicle_type" id="vehicle_type" class="form-control">
        <option value="1" {{ (isset($vehicle->vehicle_type) && $vehicle->vehicle_type == 1) ? 'selected' : '' }}>Nabil Paribahan</option>
        <option value="2" {{ (isset($vehicle->vehicle_type) && $vehicle->vehicle_type == 2) ? 'selected' : '' }}>Others</option>
    </select>
    {!! $errors->first('vehicle_type', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
