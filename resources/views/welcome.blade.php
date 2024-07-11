<x-guest-layout>
    <div class="container mx-auto">
        <header class="flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-white text-sm py-4">
            <nav class="max-w-[85rem] w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between"
                aria-label="Global">
                <a class="flex-none text-xl font-semibold" href="#">LaraPay</a>
                <div class="flex flex-row items-center gap-5 mt-5 sm:justify-end sm:mt-0 sm:ps-5">
                    <a class="font-medium text-blue-500" href="#" aria-current="page">Zona de pagos</a>
                    <a class="font-medium text-gray-600 hover:text-gray-400"
                        href="#">Iniciar sesión</a>
                </div>
            </nav>
        </header>

        <div class="flex justify-center">
            <div class="flex w-1/2 flex-col bg-white border shadow-sm rounded-xl p-4 md:p-5 max-w-50 mt-10">
                <h3 class="text-lg font-bold text-gray-800">
                    La vaca que más canta
                </h3>
                <p class="mt-1 mb-4 text-xs font-medium uppercase text-gray-500">
                    Realiza todas tus donaciones de forma segura.
                </p>
                <form action="">
                    <div class="space-y-3 mb-4">
                        <textarea class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" rows="2">Mi donación a esta vaca para contribuir a la formación de desarrolladores PHP</textarea>
                    </div>
                    <div class="space-y-3 mb-4">
                        <input required type="number" min="1000" max="999999999999" value="10000"
                            class="py-3 px-4 block min-w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                            placeholder="Digita el valor a pagar">
                    </div>
                    <select required
                        class="mb-4 py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                        <option>Sitios disponibles</option>
                        @foreach ($sites as $site)
                        <option @selected($loop->first) value="{{ $site->id }}">{{ $site->name }}</option>
                        @endforeach
                    </select>
                    <select required
                        class="mb-4 py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                        <option>Moneda</option>
                        @foreach ($currencies as $currency)
                        <option @selected($loop->first) value="{{ $currency }}">{{ $currency }}</option>
                        @endforeach
                    </select>

                    <p class="mt-1 mb-4 text-xs font-medium uppercase text-gray-500">
                        Tus datos
                    </p>

                    <div class="space-y-3 mb-4">
                        <input required type="text" value="John"
                            class="py-3 px-4 block min-w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                            placeholder="Tu nombre">
                    </div>

                    <div class="space-y-3 mb-4">
                        <input required type="text" value="Doe"
                            class="py-3 px-4 block min-w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                            placeholder="Tu apellido">
                    </div>

                    <div class="space-y-3 mb-4">
                        <input required type="text" value="john.doe@ghostmail.com"
                            class="py-3 px-4 block min-w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                            placeholder="Tu correo">
                    </div>

                    <div class="space-y-3 mb-4">
                        <input required type="text" value="10025553366"
                            class="py-3 px-4 block min-w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                            placeholder="Tu número de documento">
                    </div>

                    <select required
                        class="mb-4 py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                        <option>Tipo de documento</option>
                        <option selected value="CC">CC</option>
                        <option value="CE">CE</option>
                    </select>

                    <button type="submit" type="button"
                        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                        Pagar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>