<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex p-6 bg-white border-b border-gray-200 justify-between">
                    <div>Create User</div>
                </div>
            </div>

            <div class="flex flex-col mt-4">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div>
                        <div class="flex">
                            <div class="mb-3 w-full">
                                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">First Name</label>
                                <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" value="{{ old('first_name') }}" required />
                            </div>
                            <div class="mb-3 ml-3 w-full">
                                <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900">Last Name</label>
                                <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" value="{{ old('last_name') }}" required />
                            </div>
                        </div>
                        <div class="flex">
                            <div class="mb-3 w-full">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required />
                            </div>
                            <div class="mb-3 ml-3 w-full">
                                <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                                <x-select id="role" class="block mt-1 w-full" type="text" name="role" required>
                                    @foreach(\App\Models\User::ROLE as $roleId => $role)
                                        <option value="{{ $roleId }}" @if(old('$user->role') == $roleId) selected @endif>
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                </x-select>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="mb-3 w-full">
                                <label for="days" class="block mb-2 text-sm font-medium text-gray-900">Leave Days</label>
                                <x-input id="days" class="block mt-1 w-full" type="number" name="days" value="{{ config('app.defaultDays') }}" min="0" max="100" required />
                            </div>
                            <div class="mb-3 ml-3 w-full">
                                <label for="sick_days" class="block mb-2 text-sm font-medium text-gray-900">Sick Days</label>
                                <x-input id="sick_days" class="block mt-1 w-full" type="number" name="sick_days" value="{{ config('app.defaultSickDays') }}" min="0" max="100" required />
                            </div>
                        </div>
                        <div class="flex mt-8">
                            <div class="mb-3 w-full">
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                                <x-input id="password" class="block mt-1 w-full" type="password" name="password" value="password" />
                            </div>
                            <div class="mb-3 ml-3 w-full">
                                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Confirm password</label>
                                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" value="password" name="password_confirmation" />
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
