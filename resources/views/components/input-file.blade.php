    <label for="{{ $id ?? $name }}" class="form-label">{{ $label ?? '' }}</label>

    @php
        $invalidFeedback = '';
        if ($errors->has($name)) {
            $invalidFeedback = '<div class="invalid-feedback font-weight-bold" role="alert">' . $errors->first($name) . '</div>';
        }

        $path = $value ?? '';
    @endphp

    @if ($path)
        <div class="d-flex">
            <div style="width: 100%">
                <input type="file" name="{{ $name }}" id="{{ $id ?? $name }}" value="{{ old($name, $value ?? '') }}" placeholder="{{ $placeholder ?? '' }}" class="form-control {{ $name }} {{ $attributes->get('class') }} @error($name) is-invalid @enderror" {{ $attributes }}>
                {!! $invalidFeedback !!}
            </div>

            @php
                $extension = pathinfo($path, PATHINFO_EXTENSION);
            @endphp

            {{-- Ini untuk tipe image --}}
            @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'svg']))
                <a id="{{ $name }}Link" href="{{ Storage::url($path) }}" target="_blank" data-fancybox="gallery-1">
                    <img id="{{ $name }}Preview" src="{{ Storage::url($path) }}" alt="Image Preview" class="img-thumbnail img-input ml-1" />
                </a>
            @else
                {{-- Ini untuk tipe file --}}
                <a id="{{ $name }}Link" href="{{ Storage::url($path) }}" target="_blank" class="btn btn-primary ml-1">
                    Download {{ ucfirst($extension) }}
                </a>
            @endif

        </div>
    @else
        <input type="file" name="{{ $name }}" id="{{ $id ?? $name }}" value="{{ old($name, $value ?? '') }}" placeholder="{{ $placeholder ?? '' }}" class="form-control {{ $name }} {{ $attributes->get('class') }} @error($name) is-invalid @enderror" {{ $attributes }}>
        {!! $invalidFeedback !!}
    @endif
