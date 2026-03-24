@extends("layouts.app")

@section("content")
    <div class="flex min-h-screen items-center justify-center">
        <div
            class="w-full max-w-md rounded-lg bg-white px-8 pt-5 pb-8 shadow-sm"
        >
            <div class="mb-4 flex justify-start">
                @component("icons.logo")
                    
                @endcomponent
            </div>
            <h1 class="mb-2 text-center text-2xl text-gray-400">
                Forgot password
            </h1>
            <p class="mb-6 text-center text-gray-400">
                Enter your email to receive a password reset link
            </p>

            @if (session("status"))
                <p class="mb-4 text-center text-sm text-green-600">
                    {{ session("status") }}
                </p>
            @endif

            <form method="POST" action="{{ route("password.email") }}">
                @csrf

                <input
                    name="email"
                    type="email"
                    required
                    autofocus
                    placeholder="email@example.com"
                    class="mb-4 w-full rounded-md border px-3 py-2"
                />

                @error("email")
                    <p class="mb-2 text-sm text-red-500">{{ $message }}</p>
                @enderror

                <button
                    type="submit"
                    class="bg-primary hover:bg-primary/90 w-full rounded-md py-2 text-white transition"
                >
                    Email password reset link
                </button>
            </form>

            <div class="mt-4 text-center text-sm text-gray-400">
                Or, return to
                <a
                    href="{{ route("login") }}"
                    class="text-primary hover:underline"
                >
                    log in
                </a>
            </div>
        </div>
    </div>
@endsection
