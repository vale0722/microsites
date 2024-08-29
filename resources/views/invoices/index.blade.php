<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Invoices
            </h2>
        </div>
    </x-slot>
    <div class="flex w-full justify-center my-4">
        <div class="container align-middle p-4 sm:p-6 lg:p-8 bg-white">
            <table class="w-full my-0 align-middle text-dark border-neutral-200">
                <thead class="align-bottom">
                <tr class="font-semibold text-[0.95rem] text-secondary-dark">
                    <th class="pb-3 text-start min-w-[100px]">Reference</th>
                    <th class="pb-3 text-start min-w-[100px]">Amount</th>
                    <th class="pb-3 text-start min-w-[100px]">Currency</th>
                    <th class="pb-3 text-start min-w-[100px]">Customer name</th>
                    <th class="pb-3 text-start min-w-[100px]">DNI</th>
                    <th class="pb-3 text-start min-w-[100px]">Description</th>
                    <th class="pb-3 text-start min-w-[100px]">Expiration date</th>
                    <th class="pb-3 text-start min-w-[100px]">Creation date</th>
                    <th class="pb-3 text-start min-w-[100px]">Import</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                        <tr class="border-b border-dashed last:border-b-0">
                            <td class="p-3 pl-0">
                                {{ $invoice->reference }}
                            </td>
                            <td class="p-3 pl-0">
                                {{ $invoice->amount }}
                            </td>
                            <td class="p-3 pl-0">
                                {{ $invoice->currency }}
                            </td>
                            <td class="p-3 pl-0">
                                {{ $invoice->customer_name }}
                            </td>
                            <td class="p-3 pl-0">
                                {{ $invoice->dni }}
                            </td>
                            <td class="p-3 pl-0">
                                {{ $invoice->description }}
                            </td>
                            <td class="p-3 pl-0">
                                {{ $invoice->expired_at }}
                            </td>
                            <td class="p-3 pl-0">
                                {{ $invoice->created_at }}
                            </td>
                            <td class="p-3 pl-0">
                                <a href="{{ route('admin.imports.show', ['import' => $invoice->import_id]) }}">
                                    See import
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
