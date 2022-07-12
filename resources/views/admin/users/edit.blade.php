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
                        <x-dropdown align="left">
                            <x-slot name="trigger">
                                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div>Days</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                @foreach($user->days as $days)
                                    <p>{{ $days->days }} - {{ $days->year }}</p>
                                @endforeach
                            </x-slot>
                        </x-dropdown>

                    </div>
                </div>
            </div>

            <div class="flex flex-col mt-4">
                <form action="{{ route('users.update', [$user->id]) }}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    <div>
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
                        <div class="flex mt-8">
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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <div>
                                @foreach ($errors->all() as $error)
                                    <p id="error-message" class="text-center text-red-600">{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <x-button class="mt-3">Save</x-button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
