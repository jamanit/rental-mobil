    <label for="{{ $id ?? $name }}" class="form-label">{{ $label ?? '' }}</label>
    <textarea name="{{ $name }}" id="{{ $id ?? $name }}" placeholder="{{ $placeholder ?? '' }}" class="form-control {{ $name }} {{ $attributes->get('class') }} @error($name) is-invalid @enderror" {{ $attributes }}>{{ old($name, $value ?? '') }}</textarea>

    @error($name)
        <div class="invalid-feedback font-weight-bold" role="alert">{{ $message }}</div>
    @enderror
