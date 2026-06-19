<nav class="mx-10 mb-6 flex items-end justify-between">
    <div class="">
        @component("icons.logo")
            
        @endcomponent
    </div>

    <div class="mb-4 flex flex-wrap items-end gap-2">
        <a href="{{ route("pages.home") }}">
            <div
                class="hover:bg-primary/90 {{ request()->routeIs("pages.home") ? "bg-primary text-white" : "bg-white" }} rounded-md  px-4 py-1 text-base whitespace-nowrap hover:text-white"
            >
                Home
            </div>
        </a>
        <a href="{{ route("tasks.index") }}">
            <div
                class="hover:bg-primary/90 {{ request()->routeIs("tasks.index") ? "bg-primary text-white" : "bg-white" }} rounded-md  px-4 py-1 text-base whitespace-nowrap hover:text-white"
            >
                Tasklist
            </div>
        </a>

        <a href="{{ route("stats") }}">
            <div
                class="hover:bg-primary/90 {{ request()->routeIs("stats") ? "bg-primary" : "" }} rounded-md bg-white px-4 py-1 text-base whitespace-nowrap hover:text-white"
            >
                Statistics
            </div>
        </a>
       

        <form
            method="POST"
            action="{{ route("logout") }}"
            class="text-gray-500 hover:text-white"
        >
            @csrf
            <button
                type="submit"
                class="rounded-md border bg-white px-4 py-1 hover:bg-red-300"
            >
                Logout
            </button>
        </form>
    </div>
</nav>
