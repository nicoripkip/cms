<div class="{{ $value->bootstrap }}">
    <div class="form-group">
        <label class="form-text">{{ $value->Attributes->name }} @if($value->Attributes->required == 1) * @endif</label>
        <textarea class="form-control variable-field" name="page[{{ $value->Attributes->name }}]" rows="10" @if($value->Attributes->required == 1) required @endif>
            {{ $page_data->{$value->Attributes->name} ?? '' }}
        </textarea>
    </div>
</div>