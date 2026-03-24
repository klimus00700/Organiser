<nav class="fixed top-0 right-0 left-0">
    <div
        class="mx-auto flex max-w-7xl items-center justify-end px-4 py-3 sm:px-6 lg:px-8"
    >
        <span class="mr-4 text-sm text-gray-600">
            {{ Auth::user()->name }}
        </span>

        <form method="POST" action="{{ route("logout") }}">
            @csrf
            <button
                type="submit"
                class="text-sm text-red-500 transition hover:text-red-700"
            >
                Logout
            </button>
        </form>
    </div>
</nav>
