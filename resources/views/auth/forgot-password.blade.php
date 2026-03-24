@extends("layouts.app")

@section("content")
    <div class="flex min-h-screen items-center justify-center">
        <div
            class="mx-auto w-full max-w-md rounded-lg bg-white px-8 pt-5 pb-8 shadow-sm"
        >
            <p class="mb-4 text-sm text-gray-600">
                {{ __("Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.") }}
            </p>

            @if (session("status"))
                <p class="mb-4 text-center text-sm text-green-600">
                    {{ session("status") }}
                </p>
            @endif

            <form method="POST" action="{{ route("password.email") }}">
                @csrf

                <input
                    id="email"
                    class="mb-4 w-full rounded-md border px-3 py-2"
                    type="email"
                    name="email"
                    placeholder="Email"
                    value="{{ old("email") }}"
                    required
                    autofocus
                />

                @error("email")
                    <p class="mb-2 text-sm text-red-500">{{ $message }}</p>
                @enderror

                <button
                    type="submit"
                    class="bg-primary hover:bg-primary/90 w-full rounded-md py-2 text-2xl text-white transition"
                >
                    {{ __("Email Password Reset Link") }}
                </button>
            </form>
        </div>
    </div>
@endsection
