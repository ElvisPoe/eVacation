<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Applications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center p-6 bg-white border-b border-gray-200">
                    <div>
                        Users
                    </div>
                    <div>
                        <a href="{{ route('users.create') }}" class="ml-1">
                            <x-button>Create</x-button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex flex-col mt-4">
                <div class="inline-block py-2 min-w-full">
                    <div class="overflow-hidden shadow-md sm:rounded-lg">
                        <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="py-6 px-6 text-xs font-medium tracking-wider text-gray-700 uppercase dark:text-gray-400">
                                    First Name
                                </th>
                                <th scope="col" class="py-6 px-6 text-xs font-medium tracking-wider text-gray-700 uppercase dark:text-gray-400">
                                    Last Name
                                </th>
                                <th scope="col" class="py-6 px-6 text-xs font-medium tracking-wider text-gray-700 uppercase dark:text-gray-400">
                                    Email
                                </th>
                                <th scope="col" class="py-6 px-6 text-xs font-medium tracking-wider text-gray-700 uppercase dark:text-gray-400">
                                    Role
                                </th>
                                <th scope="col" class="py-6 px-6 text-xs font-medium tracking-wider text-gray-700 uppercase dark:text-gray-400">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap text-center dark:text-white">
                                        {{ $user->first_name }}
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap text-center dark:text-white">
                                        {{ $user->last_name }}
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap text-center dark:text-white">
                                        {{ $user->email }}
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap text-center dark:text-white">
                                        {{ \App\Models\User::ROLE[$user->role] }}
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap text-center dark:text-white">
                                        <x-button class="bg-white">
                                            <a href="{{ route('users.edit', $user) }}">Edit</a>
                                        </x-button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
