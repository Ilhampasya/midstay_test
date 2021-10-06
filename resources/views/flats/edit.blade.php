@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-6">
            <section
                class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg max-w-screen-md mx-auto">
                <form class="w-full px-6 sm:px-10 flex gap-8 flex-col py-8" method="POST"
                    action="{{ route('flats.update', $flat->id) }}">
                    @csrf
                    @method('PUT')

                    <x-input label="{{ __('Name') }}" name="name" :value="$flat->name" />
                    <x-input label="{{ __('Location') }}" name="location" :value="$flat->location" />
                    <x-select2-ajax url="/neighborhoods" name="neighborhood_id" label="{{ __('Neighborhood') }}" :value="$flat->neighborhood_id" :initials="$flat->neighborhood_id ? [
                        $flat->neighborhood_id => $flat->neighborhood->name
                    ] : []" />
                    <x-button class="text-gray-100 bg-blue-500 hover:bg-blue-700">Save</x-button>
                </form>
            </section>
        </div>
    </main>
@endsection
