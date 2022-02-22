<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Application') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex p-6 bg-white border-b border-gray-200 justify-between">
                    <div>Edit User</div>
                </div>
            </div>

            <div class="flex flex-col mt-4">
                <form action="{{ route('users.update', [$user->id]) }}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    <div>
                        <div class="flex">
                            <div class="mb-3 w-full">
                                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">First Name</label>
                                <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" value="{{ $user->first_name }}" required />
                            </div>
                            <div class="mb-3 ml-3 w-full">
                                <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Last Name</label>
                                <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" value="{{ $user->last_name }}" required />
                            </div>
                        </div>
                        <div class="flex">
                            <div class="mb-3 w-full">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $user->email }}" required />
                            </div>
                            <div class="mb-3 ml-3 w-full">
                                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Role</label>
                                <x-select id="role" class="block mt-1 w-full" type="text" name="role" required>
                                    <option value="1" @if($user->role == 1) selected @endif>Admin</option>
                                    <option value="2" @if($user->role == 2) selected @endif>Employee</option>
                                </x-select>
                            </div>
                        </div>
                        <div class="flex mt-8">
                            <div class="mb-3 w-full">
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Password</label>
                                <x-input id="password" class="block mt-1 w-full" type="password" name="password" />
                            </div>
                            <div class="mb-3 ml-3 w-full">
                                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Confirm password</label>
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
