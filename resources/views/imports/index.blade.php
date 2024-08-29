<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Imports
            </h2>
            <a href="{{ route('admin.imports.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                <em class="fa-solid fa-plus"></em>
            </a>
        </div>
    </x-slot>
    <div class="flex w-full justify-center my-4">
        <div class="container align-middle p-4 sm:p-6 lg:p-8 bg-white">
            <table class="w-full my-0 align-middle text-dark border-neutral-200">
                <thead class="align-bottom">
                <tr class="font-semibold text-[0.95rem] text-secondary-dark">
                    <th class="pb-3 text-start min-w-[175px]">{{ trans('sites.name') }}</th>
                    <th class="pb-3 text-start min-w-[100px]">{{ trans('sites.status') }}</th>
                    <th class="pb-3 text-start min-w-[100px]"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($imports as $import)
                        <tr class="border-b border-dashed last:border-b-0">
                            <td class="p-3 pl-0">
                                <div class="flex items-center">
                                    <a href="/"
                                        class="transition ease-in-out delay-150 hover:scale-105 mb-1 text-start duration-200 text-lg/normal text-secondary-inverse hover:text-primary">
                                        {{ $import->file_name }}
                                    </a>
                                </div>
                            </td>
                            <td class="p-3 pl-0 text-start">
                                <span class="text-light-inverse text-md/normal">{{ $import->status->text() }}</span>
                            </td>
                            <td class="flex justify-end p-3 pr-0 text-end gap-3">
                                <a href="{{ route('admin.imports.show', $import) }}">
                                    <em class="fa-solid fa-eye"></em>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
