<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hello, {{ auth()->user()->name }}!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center p-6 bg-white border-b border-gray-200">
                    <div>
                        My Applications
                    </div>
                    <div>
                        <a href="{{ route('applications.create') }}" class="ml-1">
                            <x-button>Create Application</x-button>
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
                                        From
                                    </th>
                                    <th scope="col" class="py-6 px-6 text-xs font-medium tracking-wider text-gray-700 uppercase">
                                        To
                                    </th>
                                    <th scope="col" class="py-6 px-6 text-xs font-medium tracking-wider text-gray-700 uppercase">
                                        Days
                                    </th>
                                    <th scope="col" class="py-6 px-6 text-xs font-medium tracking-wider text-gray-700 uppercase">
                                        Requested
                                    </th>
                                    <th scope="col" class="py-6 px-6 text-xs font-medium tracking-wider text-gray-700 uppercase">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applications as $app)
                                    <tr class="bg-white border-b">
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap text-center">
                                            {{ $app->user->name }}
                                        </td>
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap text-center">
                                            {{ $app->datefrom->format('d-M-Y') }}
                                        </td>
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap text-center">
                                            {{ $app->dateto->format('d-M-Y') }}
                                        </td>
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap text-center">
                                            {{ $app->days }}
                                        </td>
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap text-center">
                                            {{ $app->created_at->format('d-M-Y') }}
                                        </td>
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap text-center">
                                            <x-button class="bg-white">{{ $app->status }}</x-button>
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
