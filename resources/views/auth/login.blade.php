<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Belikan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('images/icon.png') }}">
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-200">

    <!-- Card Container -->
    <div class="w-[600px] md:w-[700px] bg-white shadow-2xl rounded-xl overflow-hidden flex">
        
        <!-- Left Section (Form) -->
        <div class="w-1/2 bg-black text-white flex flex-col justify-center items-center p-6">
            <a href="{{ route('welcome') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Belikan Logo" class="h-10 mb-4">
            </a>    
            <h2 class="text-xl font-bold">Welcome Back!!</h2>
            @session('status')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ $value }}
                </div>
            @endsession

            <form method="POST" action="{{ route('login') }}" class="w-full flex flex-col space-y-3">
                @csrf
                <div>
                    <label for="email" class="block text-sm">Email</label>
                    <input id="email" class="block mt-1 w-full p-2 bg-gray-400 text-sm rounded-md placeholder-gray-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Masukkan Email" />
                </div>

                <div class="mt-4">
                    <label for="password" class="block text-sm">Password</label>
                    <input id="password" class="block mt-1 w-full p-2 bg-gray-400 text-sm rounded-md placeholder-gray-500" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan Password" />
                </div>
                <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>

                    <!-- @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif -->

                </label>
            </div>

            <button class="ms-1 border-2 border-gray-300 text-sm px-4 py-2 rounded-md bg-transparent hover:bg-blue-800 hover:border-white hover:shadow-lg hover:translate-y-[-2px] active:shadow-none active:translate-y-0 transition-all duration-300">
                {{ __('Login') }}
            <button>
            </form>

            <p class="mt-3 text-sm">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-400">Registrasi</a></p>
        </div>

        <!-- Right Section (Image) -->
        <div class="w-1/2">
            <img src="{{ asset('images/goldfish.png') }}" alt="Goldfish" class="h-full w-full object-cover">
        </div>

    </div>

</body>
</html>
