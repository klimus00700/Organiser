@extends("layouts.app")

@section("content")
    <div class="flex min-h-screen items-center justify-center">
        <div
            class="w-full max-w-screen-sm rounded-lg bg-white px-8 pt-5 pb-8 shadow-sm"
        >
            <!-- Icon -->
            @component("icons.logo")
                
            @endcomponent

            <!-- Title -->
            <h1 class="font-regular mb-2 text-center text-2xl text-gray-400">
                No tasks yet
            </h1>

            <!-- Description -->
            <p class="mb-6 text-center text-gray-400">
                Create your first task to start planning and tracking your
                progress.
            </p>

            <!-- CTA -->
            <a
                href="{{ route("tasks.index") }}"
                class="bg-primary hover:bg-primary/90 block w-full rounded-md px-6 py-2 text-center text-2xl text-white transition"
            >
                Create first task
            </a>
        </div>
    </div>
@endsection
