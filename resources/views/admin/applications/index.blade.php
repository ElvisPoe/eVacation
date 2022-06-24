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
                        @if($filter)
                            {{ \App\Models\Application::STATUS[$filter] }} Applications
                        @else
                            All Applications
                        @endif
                    </div>
                    <div>
                        <a href="{{ route('applications.index') }}" class="ml-1">
                            <x-button>All</x-button>
                        </a>
                        <a href="?status=approved" class="ml-1">
                            <x-button>Approved</x-button>
                        </a>
                        <a href="?status=pending" class="ml-1">
                            <x-button>Pending</x-button>
                        </a>
                        <a href="?status=rejected" class="ml-1">
                            <x-button>Rejected</x-button>
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
                                <th scope="col" class="py-6 px-6 text-xs font-medium tracking-wider text-gray-700 uppercase">
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
                                    <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap flex justify-end">
                                        @if($app->status == 'approved')
                                            <a href="/applications/{{ $app->id }}/rejected" class="ml-1">
                                                <x-button>Reject</x-button>
                                            </a>
                                        @elseif($app->status == 'rejected')
                                            <a href="/applications/{{ $app->id }}/approved" class="ml-1">
                                                <x-button>Approve</x-button>
                                            </a>
                                        @else
                                            <a href="/applications/{{ $app->id }}/approved" class="ml-1">
                                                <x-button>Approve</x-button>
                                            </a>
                                            <a href="/applications/{{ $app->id }}/rejected" class="ml-1">
                                                <x-button>Reject</x-button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                {{ $applications->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
