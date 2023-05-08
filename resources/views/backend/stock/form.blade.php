@php
    $products = \App\Models\Product::where('status', 1)->get();
@endphp
<div class="form-group {{ $errors->has('product_id') ? 'has-error' : ''}}">
    <label for="product_id" class="control-label">{{ 'Product Id' }}</label>
    <select name="product_id" id="product_id" class="form-control">
        @foreach($products as $item)
            <option value="{{ $item->id }}" {{ (isset($stock->product_id) && $item->id == $stock->product_id) ? 'selected' : '' }}>{{ $item->name }}</option>
        @endforeach
    </select>
    {!! $errors->first('product_id', '<p class="help-block">:message</p>') !!}
</div>

@php
    $tank = \App\Models\Tank::where('status', 1)->get();
@endphp
<div class="form-group {{ $errors->has('tank_id') ? 'has-error' : ''}}">
    <label for="tank_id" class="control-label">{{ 'Tank Id' }}</label>

    <select name="tank_id" id="tank_id" class="form-control">
        @foreach($tank as $item)
            <option value="{{ $item->id }}" {{ (isset($stock->tank_id) && $item->id == $stock->tank_id) ? 'selected' : '' }}>{{ $item->name }}</option>
        @endforeach
    </select>
    {!! $errors->first('tank_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('oil_amount') ? 'has-error' : ''}}">
    <label for="oil_amount" class="control-label">{{ 'Oil Amount' }}</label>
    <input class="form-control" name="oil_amount" type="number" id="oil_amount" value="{{ isset($stock->oil_amount) ? $stock->oil_amount : 0}}">
    {!! $errors->first('oil_amount', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
    <label for="date" class="control-label">{{ 'Date' }}</label>
    <input class="form-control" name="date" type="date" id="date" value="{{ isset($stock->date) ? $stock->date : date('Y-m-d')}}">
    {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
