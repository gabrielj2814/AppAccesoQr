<x-filament::page>
    <div class="space-y-6">
        <!-- Primera Sección -->
        <section class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800">Título de la Primera Sección</h2>
            <p class="mt-4 text-gray-600">
                Este es el contenido de la primera sección. Puedes añadir cualquier tipo de contenido aquí, incluyendo
                texto, imágenes, tablas, formularios, etc.
            </p>
        </section>

        <!-- Segunda Sección -->
        <section class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800">Título de la Segunda Sección</h2>
            <p class="mt-4 text-gray-600">
                Este es el contenido de la segunda sección. Al igual que en la primera, puedes personalizarlo según tus necesidades.
            </p>
            <!-- Ejemplo de un formulario simple -->
            <form>
                <div class="mt-4">
                    <label for="exampleInput" class="block text-sm font-medium text-gray-700">Campo de Ejemplo</label>
                    <input type="text" id="exampleInput" name="exampleInput" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mt-4">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Enviar</button>
                </div>
            </form>
        </section>
    </div>
</x-filament::page>
