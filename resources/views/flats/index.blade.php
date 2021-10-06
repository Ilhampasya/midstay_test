@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-6">

            @if (session('status'))
                <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4"
                    role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">
                <x-table>
                    <x-slot name="title">Flats</x-slot>
                    <x-slot name="right">
                        <a href="{{ route('flats.create') }}"><x-button class="text-gray-100 bg-blue-500 hover:bg-blue-700">Add Flat</x-button></a>
                    </x-slot>
                    <x-slot name="thead">
                        <tr>
                            <x-thead-th>No</x-thead-th>
                            <x-thead-th>Name</x-thead-th>
                            <x-thead-th>Location</x-thead-th>
                            <x-thead-th>Neighborhood</x-thead-th>
                            <x-thead-th>Actions</x-thead-th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($flats as $flat)
                            <tr>
                                <x-tbody-td class="text-center">{{ $loop->iteration }}</x-tbody-td>
                                <x-tbody-td class="text-center">{{ $flat->name }}</x-tbody-td>
                                <x-tbody-td class="text-center">{{ $flat->location }}</x-tbody-td>
                                <x-tbody-td class="text-center">{{ $flat->neighborhood->name ?? '-' }}</x-tbody-td>
                                <x-tbody-td class="text-center">
                                    <div class="flex gap-3">
                                        <a href="{{ route('flats.edit', $flat->id) }}">
                                            <x-button class="text-gray-100 bg-blue-500 hover:bg-blue-700">
                                                Edit
                                            </x-button>
                                        </a>
                                        <form method="POST" action="{{ route('flats.destroy', $flat->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <x-button onclick="handleDelete(event)" class="bg-red-500 text-gray-100 hover:bg-red-600">
                                                Delete
                                            </x-button>
                                        </form
                                    </div>
                                </x-tbody-td>
                            </tr>
                        @empty
                            <tr>
                                <x-tbody-td :colspan="5" class="text-center">{{ __('No Data Available') }}</x-tbody-td>
                            </tr>
                        @endforelse
                    </x-slot>
                    <x-slot name="links">{{ $flats->links() }}</x-slot>
                </x-table>
            </section>
        </div>
    </main>
@endsection
