<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center p-6 bg-white border-b border-gray-200 sm:rounded-lg">
                    <div>{{ $user->first_name . ' ' . $user->last_name }}</div>
                    <div>
                        <b>{{ $daysTakenThisYear }}</b>
                        days taken from
                        <b>{{ $user->days }}</b>
                    </div>
                </div>
            </div>

            <form action="{{ route('users.update', [$user->id]) }}" method="POST">
                @csrf
                {{ method_field('PUT') }}
                <div class="flex mb-4 mt-3 ml-1">
                    <div class="w-3/4 mr-3">
                        <div class="flex flex-col">
                            <div class="flex">
                                <div class="mb-3 w-full">
                                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">First Name</label>
                                    <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" value="{{ $user->first_name }}" required />
                                </div>
                                <div class="mb-3 ml-3 w-full">
                                    <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900">Last Name</label>
                                    <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" value="{{ $user->last_name }}" required />
                                </div>
                            </div>
                            <div class="flex">
                                <div class="mb-3 w-full">
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $user->email }}" required />
                                </div>
                                <div class="mb-3 ml-3 w-full">
                                    <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                                    <x-select id="role" class="block mt-1 w-full" type="text" name="role" required>
                                        @foreach(\App\Models\User::ROLE as $roleId => $role)
                                            <option value="{{ $roleId }}" @if($user->role == $roleId) selected @endif>
                                                {{ $role }}
                                            </option>
                                        @endforeach
                                    </x-select>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="mb-3 w-full">
                                    <label for="days" class="block mb-2 text-sm font-medium text-gray-900">Default Days</label>
                                    <x-input id="days" class="block mt-1 w-full" type="number" name="days" value="{{ $user->days }}" min="0" max="100" required />
                                </div>
                            </div>
                            <div class="flex">
                                <div class="mb-3 w-full">
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" />
                                </div>
                                <div class="mb-3 ml-3 w-full">
                                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Confirm password</label>
                                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" />
                                </div>
                            </div>
                        </div>

                        <x-button class="mt-3">Save</x-button>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <div>
                                    @foreach ($errors->all() as $error)
                                        <p id="error-message" class="text-center text-red-600">{{ $error }}</p>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="w-1/4">
                        @forelse($user->periods as $period)
                            <div class="mb-3 w-full">
                                <label for="year-{{ $period->id }}" class="block mb-2 text-sm font-medium text-gray-900">{{ $period->year }}</label>
                                <x-input id="year-{{ $period->id }}" class="block mt-1 w-full" type="number" min="0" max="100" name="year-{{ $period->id }}"
                                         value="{{ $period->days }}" required />
                            </div>
                        @empty
                            <div class="text-center mt-8"><b>No periods yet!</b></div>
                        @endforelse
                        <div class="flex justify-center mt-8">
                            <a href="{{ route('users.create.period') }}" class="ml-1">
                                <x-button type="button" title="Adding next year will empty the current year days">Add Year</x-button>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
