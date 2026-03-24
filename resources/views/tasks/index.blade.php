@extends("layouts.app")

@section("content")
    <div class="flex min-h-screen justify-center">
        <div
            class="flex w-full max-w-7xl flex-col justify-between rounded-lg bg-white p-11 shadow-sm"
        >
            @component("icons.logo")
                
            @endcomponent

            <div class="flex flex-col">
                <h1 class="font-regular px-11 pb-10 text-3xl">Tasklist</h1>

                <div
                    class="flex flex-col gap-6 rounded-lg bg-white px-11 py-6 shadow-sm"
                >
                    {{-- Task list --}}
                    @foreach ($tasks as $task)
                        <div class="flex items-center justify-between">
                            <div class="flex gap-4">
                                <form
                                    class="flex items-center"
                                    action="{{ route("tasks.update", $task) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method("PUT")
                                    <input
                                        type="checkbox"
                                        name="completed"
                                        class="accent-primary h-5 w-5"
                                        {{ $task->completed ? "checked" : "" }}
                                    />
                                </form>

                                <span
                                    class="{{ $task->completed ? "text-gray-400 line-through" : "" }}"
                                >
                                    {{ $task->title }}
                                </span>
                            </div>

                            <div class="flex items-center gap-4">
                                {{ $task->category->name ?? "No category" }}

                                <form
                                    action="{{ route("tasks.destroy", $task) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method("DELETE")
                                    <button
                                        class="border-primary hover:bg-primary/10 rounded-md border-2 px-4 py-1 text-black"
                                    >
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    {{-- New task form --}}
                    <form
                        class="flex flex-col gap-6"
                        action="{{ route("tasks.store") }}"
                        method="POST"
                    >
                        @csrf
                        <div class="flex justify-between gap-3">
                            <input
                                type="text"
                                name="title"
                                placeholder="New task..."
                                class="flex-1 rounded-md border px-4 py-1"
                            />
                            <select
                                name="category_id"
                                class="rounded-md border px-3 py-2"
                            >
                                <option value="">Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex gap-6">
                            <button
                                class="bg-primary hover:bg-primary/90 rounded-md px-8 py-1 text-2xl text-white transition"
                            >
                                Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.querySelectorAll('input[type="checkbox"]').forEach((cb) => {
        cb.addEventListener('change', function () {
            fetch(`/tasks/${this.dataset.id}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ completed: this.checked }),
            })
        })
    })
</script>
