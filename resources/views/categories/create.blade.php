<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ trans('categories.store') }}
            </h2>

            <a href="{{ route('categories.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                <em class="fa-solid fa-arrow-left"></em>
            </a>
        </div>
    </x-slot>
    <div class="flex w-full justify-center my-4">
        <div class="container align-middle p-4 sm:p-6 lg:p-8 bg-white">
            <form action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}" method="POST">
                @method(isset($category) ? 'PUT' : 'POST')
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">{{ trans('categories.name') }}</label>
                    <input type="text" name="name" id="name" class="w-full border-gray-300 rounded" value="{{ isset($category) ? $category->name : '' }}" required>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">{{ isset($category) ? trans('general.update') : trans('general.save') }}</button>
            </form>
        </div>
    </div>
</x-app-layout>
