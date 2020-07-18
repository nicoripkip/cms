<div class="{{ $value->bootstrap }}">
    <div class="form-group">
        <label class="form-text">{{ $value->Attributes->name }}</label>
        <input type="date" name="page[{{ $value->Attributes->name }}]" value="{{ $page_data->{$value->Attributes->name} ?? '' }}" class="form-control variable-field">
    </div>
</div>