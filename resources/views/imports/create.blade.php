<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between w-full">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                Import invoices
            </h1>

            <a href="{{ route('admin.imports.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                <em class="fa-solid fa-arrow-left"></em>
            </a>
        </div>
    </x-slot>
    <div class="flex w-full justify-center my-4">
        <div class="container align-middle p-4 sm:p-6 lg:p-8 bg-white">
            <form action="{{ route('admin.imports.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">File</label>
                    <input type="file" name="file" id="file" class="w-full border-gray-300 rounded" required>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- <div class="mb-4">
                    <label for="document" class="block text-gray-700">{{ trans('sites.document') }}</label>
                    <input type="text" name="document" id="document" class="w-full border-gray-300 rounded" required>
                    @error('document')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div> --}}
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">{{ trans('sites.save') }}</button>
            </form>
        </div>
    </div>
</x-app-layout>
