<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center p-6 bg-white border-b border-gray-200 sm:rounded-lg">
                    <x-dropdown align="left">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>{{ $filters['role'] }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link href="{{ route('users.index') }}">
                                All Users
                            </x-dropdown-link>
                            @foreach(\App\Models\User::ROLE as $roleId => $role)
                                <x-dropdown-link href="{{ route('users.index', ['role' => $roleId]) }}">
                                    {{ $role }}
                                </x-dropdown-link>
                            @endforeach
                        </x-slot>
                    </x-dropdown>
                    <div class="flex">
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
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-6 px-6 text-xs font-medium tracking-wider text-gray-700 uppercase">
                                    Employee
                                </th>
                                <th scope="col" class="py-6 px-6 text-xs font-medium tracking-wider text-gray-700 uppercase">
                                    Email
                                </th>
                                <th scope="col" class="py-6 px-6 text-xs font-medium tracking-wider text-gray-700 uppercase">
                                    Role
                                </th>
                                <th scope="col" class="py-6 px-6 text-xs font-medium tracking-wider text-gray-700 uppercase">
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr class="bg-white border-b">
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap text-center">
                                        {{ $user->name }}
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap text-center">
                                        {{ $user->email }}
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap text-center">
                                        {{ \App\Models\User::ROLE[$user->role] }}
                                    </td>
                                    <td class="flex justify-center py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap text-center">
                                        <a href="{{ route('users.show', $user) }}">
                                            <x-button class="mr-1">Show</x-button>
                                        </a>
                                        <a href="{{ route('users.edit', $user) }}">
                                            <x-button>
                                                Edit
                                            </x-button>
                                        </a>
{{--                                        <div>--}}
{{--                                            <form action="{{route('users.destroy', $user)}}" method="POST">--}}
{{--                                                @method('DELETE')--}}
{{--                                                @csrf--}}
{{--                                                <x-button class="bg-white">--}}
{{--                                                    Delete--}}
{{--                                                </x-button>--}}
{{--                                            </form>--}}
{{--                                        </div>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
