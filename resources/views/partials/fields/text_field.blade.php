<div class="{{ $value->bootstrap }}">
    <div class="form-group">
        <label class="form-text">{{ $value->Attributes->name }} @if($value->Attributes->required == 1) * @endif</label>
        <input type="text" name="page[{{ $value->Attributes->name }}]" class="form-control text_form variable-field" value="{{ $page_data->{$value->Attributes->name} ?? '' }}" @if($value->Attributes->required == 1) required @endif placeholder="{{ $value->Attributes->name }}..">
    </div>
</div>
