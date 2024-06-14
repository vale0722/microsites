<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$category->name}}
        </h2>
    </x-slot>
    <div class="flex w-full justify-center my-4">
        <div class="container align-middle p-4 sm:p-6 lg:p-8 bg-white">
            <div class="mb-4">
                <label class="block text-gray-700">{{ trans('general.created_at') }}</label>
                <p class="text-gray-900">{{ $category->created_at }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">{{ trans('general.updated_at') }}</label>
                <p class="text-gray-900">{{ $category->updated_at }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
