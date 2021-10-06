<div class="flex flex-wrap">
    <label for="{{ $name }}" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
        {{ $label ?? '' }}:
    </label>

    <input id="{{ $name }}" type="text" class="form-input w-full @error($name) border-red-500 @enderror"
        name="{{ $name }}" value="{{ old($name, $value) }}" />

    @error($name)
        <p class="text-red-500 text-xs italic mt-4">
            {{ $message }}
        </p>
    @enderror
</div>
