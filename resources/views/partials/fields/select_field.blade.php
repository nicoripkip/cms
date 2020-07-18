<div class="{{ $value->bootstrap }}">
    <div class="form-group">
        <label class="form-text">{{ $value->Attributes->name }} @if($value->Attributes->required == 1) * @endif</label>
        <select class="form-control variable-field" name="page[{{ $value->Attributes->name }}]">
            @foreach(explode(';', $value->Attributes->value) as $key => $val)
                <option value="{{ $val }}" @if($page_data->{$value->Attributes->name} ?? '' == $val) selected @endif>{{ $val }}</option>
            @endforeach
        </select>
    </div>
</div>