<div class="{{ $value->bootstrap }}">
    <div class="form-group">
        <label class="form-text">{{ $value->Attributes->name }} @if($value->Attributes->required == 1) * @endif</label>
        <input type="number" min="0.01" step="0.01" name="page[{{ $value->Attributes->name }}]" class="form-control variable-field" value="{{ $page_data->{$value->Attributes->name} ?? '' }}" placeholder="{{ $value->Attributes->name }}..">
    </div>
</div>