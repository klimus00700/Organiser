@extends("layouts.app")

@section("content")
    <!-- Session Status -->
    <div class="flex min-h-screen items-center justify-center">
        <div
            class="w-full max-w-md rounded-lg bg-white px-8 pt-5 pb-8 shadow-sm"
        >
            @if (session("status"))
                <p class="mb-4 text-center text-sm text-green-600">
                    {{ session("status") }}
                </p>
            @endif

            <form method="POST" action="{{ route("login") }}">
                @csrf
                <div class="mb-4 flex justify-start">
                    @component("icons.logo")
                        
                    @endcomponent
                </div>

                <!-- Email Address -->
                <input
                    id="email"
                    class="mb-3 w-full rounded-md border px-3 py-2"
                    type="email"
                    name="email"
                    placeholder="Email"
                    value="{{ old("email") }}"
                    required
                    autofocus
                    autocomplete="username"
                />
                @error("email")
                    <p class="mb-2 text-sm text-red-500">{{ $message }}</p>
                @enderror

                <!-- Password -->
                <div class="relative mb-4">
                    <input
                        id="password"
                        class="w-full rounded-md border px-3 py-2 pr-10"
                        type="password"
                        name="password"
                        placeholder="Password"
                        required
                        autocomplete="current-password"
                    />

                    <button
                        type="button"
                        id="togglePassword"
                        class="hover:text-primary absolute top-1/2 right-3 -translate-y-1/2 text-gray-400"
                        aria-label="Toggle password visibility"
                    >
                        <svg
                            width="16"
                            height="11"
                            viewBox="0 0 16 11"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M7.5625 3.40802C8.52831 3.40812 9.30371 4.18437 9.30371 5.15021C9.30361 6.11596 8.52825 6.89131 7.5625 6.89142C6.59666 6.89142 5.82042 6.11602 5.82031 5.15021C5.82031 4.1843 6.5966 3.40802 7.5625 3.40802ZM7.5625 3.867C6.85341 3.867 6.2793 4.44111 6.2793 5.15021C6.2794 5.85921 6.85347 6.43341 7.5625 6.43341C8.27144 6.4333 8.8456 5.85915 8.8457 5.15021C8.8457 4.44118 8.2715 3.86711 7.5625 3.867Z"
                                fill="#6B7280"
                                stroke="#6B7280"
                                stroke-width="0.666667"
                            />
                            <path
                                d="M7.5625 0.333008C9.44549 0.333008 10.8482 0.850227 11.9512 1.61426C13.0598 2.38223 13.8819 3.41072 14.585 4.45898V4.45996C14.8586 4.87044 14.8632 5.40229 14.5811 5.8457C13.8783 6.88037 13.0571 7.90699 11.9502 8.67676C10.8468 9.44397 9.44445 9.9668 7.5625 9.9668C5.68055 9.9668 4.27815 9.44397 3.1748 8.67676C2.06566 7.90544 1.24274 6.87663 0.539062 5.83984H0.540039C0.264743 5.42682 0.263727 4.87199 0.539062 4.45898C1.24221 3.41057 2.06507 2.38234 3.17383 1.61426C4.27677 0.850227 5.67951 0.333008 7.5625 0.333008ZM7.5625 0.791992C6.15187 0.791992 4.95296 1.07718 3.86719 1.72266C2.78601 2.36543 1.8406 3.35101 0.912109 4.71191L0.910156 4.71484C0.735512 4.97681 0.735512 5.32299 0.910156 5.58496L0.912109 5.58789C1.84062 6.94886 2.78598 7.93436 3.86719 8.57715C4.95298 9.22266 6.15183 9.50879 7.5625 9.50879C8.97317 9.50879 10.172 9.22266 11.2578 8.57715C12.339 7.93436 13.2844 6.94886 14.2129 5.58789L14.2256 5.56934L14.2354 5.54883C14.3572 5.305 14.3573 4.99479 14.2354 4.75098L14.2256 4.73047L14.2129 4.71191L13.8633 4.21973C13.0455 3.11051 12.2039 2.28512 11.2578 1.72266C10.172 1.07718 8.97313 0.791992 7.5625 0.791992Z"
                                fill="#6B7280"
                                stroke="#6B7280"
                                stroke-width="0.666667"
                            />
                        </svg>
                    </button>
                </div>

                <div class="mb-6 flex justify-between">
                    <!-- Remember Me -->
                    <label for="remember_me" class="inline-flex items-center">
                        <input
                            id="remember_me"
                            type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="remember"
                        />
                        <span class="ms-2 text-sm text-gray-600">
                            {{ __("Remember me") }}
                        </span>
                    </label>
                    <!-- Forgot your password -->
                    @if (Route::has("password.request"))
                        <a
                            class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none"
                            href="{{ route("password.request") }}"
                        >
                            {{ __("Forgot your password?") }}
                        </a>
                    @endif
                </div>

                <!-- Login button -->
                <button
                    type="submit"
                    class="bg-primary hover:bg-primary/90 w-full rounded-md py-2 text-2xl text-white transition"
                >
                    {{ __("Log in") }}
                </button>

                <h1 class="my-2 text-center text-xl">Or</h1>

                <!-- Registration button -->

                <a
                    class="border-primary hover:bg-primary/10 block w-full rounded-md border bg-transparent py-2 text-center text-2xl font-normal text-black"
                    href="{{ route("register") }}"
                >
                    {{ __("Sign in") }}
                </a>
            </form>
        </div>
    </div>
@endsection

@push("scripts")
    <script>
        const togglePassword = document.getElementById('togglePassword')
        const password = document.getElementById('password')

        togglePassword.addEventListener('click', function () {
            const type =
                password.getAttribute('type') === 'password'
                    ? 'text'
                    : 'password'
            password.setAttribute('type', type)
        })
    </script>
@endpush
