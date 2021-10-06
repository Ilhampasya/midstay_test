<div class="flex flex-wrap">
    <label class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4 block">
        {{ $label }}:
    </label>

    <div class="flex w-full">
        <select class="form-input w-full select2 @error('{{ $name }}') border-red-500 @enderror"
            name="{{ $name }}" autofocus>
            <option value="">Choose {{ $label }}</option>
            @foreach ($initials as $key => $val)
                <option value="{{ $key }}" @if($key === $value) selected @endif>{{ $val }}</option>
            @endforeach
        </select>
    </div>

    @error('{{ $name }}')
        <p class="text-red-500 text-xs italic mt-4">
            {{ $message }}
        </p>
    @enderror
</div>
@push('scripts')
<script>
$(() => {
    $('[name={{ $name }}]').select2({
        ajax: {
            url: ({ term }) => `/api/v1/{{ $url }}?search=${term || ''}`,
            processResults: ({ data: { data, current_page, last_page } }) => ({
                results: data.map(({ id, name: text }) => ({
                    id,
                    text
                })),
                pagination: {
                    more: current_page < last_page
                }
            })
        }
    })
});
</script>
@endpush
