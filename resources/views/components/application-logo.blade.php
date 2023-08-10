@if(config('app.logo'))
    <img src="{{ config('app.logo') }}" alt="App Logo">
@else
    <img src="{{ asset('logo.png') }}" alt="App Logo" width="100">
@endif

