<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans('sites.store') }}
        </h2>
    </x-slot>
    <div class="flex w-full justify-center my-4">
        <div class="container align-middle p-4 sm:p-6 lg:p-8 bg-white">
            <form action="{{ route('sites.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="category_id" class="block text-gray-700">{{ trans('sites.category') }}</label>
                    <select name="category_id" id="category_id" class="w-full border-gray-300 rounded" required>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="slug" class="block text-gray-700">{{ trans('sites.slug') }}</label>
                    <input type="text" name="slug" id="slug" class="w-full border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">{{ trans('sites.name') }}</label>
                    <input type="text" name="name" id="name" class="w-full border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="documentType" class="block text-gray-700">{{ trans('sites.document_type') }}</label>
                    <select name="documentType" id="documentType" class="w-full border-gray-300 rounded" required>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="document" class="block text-gray-700">{{ trans('sites.document') }}</label>
                    <input type="text" name="document" id="document" class="w-full border-gray-300 rounded" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">{{ trans('sites.save') }}</button>
            </form>
        </div>
    </div>
</x-app-layout>
