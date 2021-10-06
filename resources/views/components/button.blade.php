<button {{ $attributes->merge([
    'class' => 'w-full select-none font-bold whitespace-no-wrap py-1 px-5 rounded leading-normal no-underline text-sm outline-none focus:outline-none'
]) }}>
    {{ $slot }}
</button>
