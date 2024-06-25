<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form>
                        <div class="mb-2">
                            <x-input-label for="url" :value="__('URL')" />
                            <x-text-input id="url" name="url" type="text" class="mt-1 block w-full" />
                            <x-primary-button class="my-2">
                                {{ __('general.send') }}
                            </x-primary-button>
                        </div>
                        <div>
                            <x-text-area id="update_password_current_password" name="url" type="text" class="mt-1 block w-full" autocomplete="current-password" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
