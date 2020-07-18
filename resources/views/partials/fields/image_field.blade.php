<div class="{{ $value->bootstrap }}">
    <div class="form-group form-image">
        <input type="file" name="page[{{ $value->Attributes->name }}]" class="form-control file_id variable-field" style="display: none;"/>
        <button onclick="return false" class="button_id page-input-image">
            <label id="imgText" class="form-text imgText">{{ $value->Attributes->name }}</label>
            <img id="imgPrev" class="imgPrev" src={{ asset($page_data->{$value->Attributes->name} ?? '') }}" width="100%" height="100%" style="display: none;" />
        </button>
    </div>
</div>