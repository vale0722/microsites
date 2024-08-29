<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Import No. {{ $import->id }}
            </h2>
            <a href="{{ route('admin.imports.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                Imports
            </a>
        </div>
    </x-slot>
    <div class="flex w-full justify-center my-4">
        <div class="container align-middle p-4 sm:p-6 lg:p-8 bg-white">
            <div class="columns-2 flex justify-start">
                <div class="m-8">
                    <span class="block text-gray-700">File name</span>
                    <p class="text-gray-900">{{ $import->file_name }}</p>
                </div>
                <div class="m-8">
                    <span class="block text-gray-700">{{ trans('sites.status') }}</span>
                    <p class="text-gray-900">{{ $import->status->text() }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="flex w-full justify-center my-4">
        <div class="container align-middle p-4 sm:p-6 lg:p-8 bg-white">
            <h3 class="mb-4">Errors</h3>
            <div class="flex flex-col border border-gray-200 shadow-sm rounded-xl p-4 md:p-5">
                @empty ($import->errors)
                    <p>There are no errors</p>
                @else
                    <pre>{{ $import->errors }}</pre>
                @endempty
            </div>
        </div>
    </div>
</x-app-layout>
