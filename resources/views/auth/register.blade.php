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
            <form method="POST" action="{{ route("register") }}">
                @csrf

                <input
                    id="name"
                    class="mb-3 w-full rounded-md border px-3 py-2"
                    type="text"
                    name="name"
                    placeholder="Name"
                    value="{{ old("name") }}"
                    required
                    autofocus
                />
                @error("name")
                    <p class="mb-2 text-sm text-red-500">{{ $message }}</p>
                @enderror

                <input
                    id="email"
                    class="mb-3 w-full rounded-md border px-3 py-2"
                    type="email"
                    name="email"
                    placeholder="Email"
                    value="{{ old("email") }}"
                    required
                />
                @error("email")
                    <p class="mb-2 text-sm text-red-500">{{ $message }}</p>
                @enderror

                <input
                    id="password"
                    class="mb-3 w-full rounded-md border px-3 py-2"
                    type="password"
                    name="password"
                    placeholder="Password"
                    required
                />
                @error("password")
                    <p class="mb-2 text-sm text-red-500">{{ $message }}</p>
                @enderror

                <input
                    id="password_confirmation"
                    class="mb-6 w-full rounded-md border px-3 py-2"
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm Password"
                    required
                />

                <button
                    type="submit"
                    class="bg-primary hover:bg-primary/90 w-full rounded-md py-2 text-2xl text-white transition"
                >
                    {{ __("Register") }}
                </button>

                <h1 class="my-2 text-center text-xl">Or</h1>

                <a
                    href="{{ route("login") }}"
                    class="border-primary hover:bg-primary/10 block w-full rounded-md border py-2 text-center text-2xl text-black"
                >
                    {{ __("Log in") }}
                </a>
            </form>
        </div>
    </div>
@endsection
