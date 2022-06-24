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
                    <div>Make a new application</div>
                </div>
            </div>

            <div class="flex flex-col mt-4">
                <form action="{{ route('applications.store') }}" method="POST">
                    @csrf
                    <div>
                        <div class="flex">
                            <div class="mb-3 w-full">
                                <label for="datefrom" class="block mb-2 text-sm font-medium text-gray-900">Start Date</label>
                                <x-input id="datefrom" class="block mt-1 w-full" type="date" name="datefrom" value="{{ old('datefrom') }}" required />
                            </div>
                            <div class="mb-3 ml-3 w-full">
                                <label for="dateto" class="block mb-2 text-sm font-medium text-gray-900">End Date</label>
                                <x-input id="dateto" class="block mt-1 w-full" type="date" name="dateto" value="{{ old('dateto') }}" onchange="checkDate()" required />
                            </div>
                        </div>
                        <div class="mb-3 w-full">
                            <label for="reason" class="block mb-2 text-sm font-medium text-gray-900">Reason</label>
                            <x-textarea id="reason" class="block mt-1 w-full" name="reason" placeholder="Personal reason..." value="{{ old('reason') }}" />
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

                    <p id="error-message" class="text-center text-red-600 hidden">You have to select an End Date that is later than the Start Date</p>
                    <x-button class="mt-3">Save</x-button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function checkDate() {
            var datefrom = document.getElementById("datefrom").value;
            var dateto = document.getElementById("dateto").value;

            document.getElementById("error-message").classList.add("hidden");

            if (new Date(dateto).getTime() <= new Date(datefrom).getTime()) {
                document.getElementById("error-message").classList.remove("hidden");
                document.getElementById("dateto").value = ''
            }
        }
    </script>

</x-app-layout>
