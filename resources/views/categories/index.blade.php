@extends("layouts.app")

@section("content")
    <div class="flex min-h-screen justify-center">
        <div class="w-full max-w-7xl rounded-lg bg-white p-11 shadow-sm">

            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-3xl">Categories</h1>
                <a href="{{ route('tasks.index') }}" class="text-gray-400 hover:text-black">← Back to tasks</a>
            </div>

            {{-- Список категорий --}}
            <div class="mb-6 flex flex-col gap-2">
                @forelse ($categories as $category)
                    <div class="flex items-center justify-between rounded-lg border px-4 py-3">
                        <span>{{ $category->name }}</span>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-400 hover:text-red-600">
                                Delete
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-gray-400">No categories yet</p>
                @endforelse
            </div>

            {{-- Форма добавления --}}
            <form action="{{ route('categories.store') }}" method="POST" class="flex gap-3">
                @csrf
                <input
                    type="text"
                    name="name"
                    placeholder="New category..."
                    class="flex-1 rounded-md border px-4 py-2"
                    required
                />
                <button type="submit" class="bg-primary hover:bg-primary/90 rounded-md px-6 py-2 text-white transition">
                    Add
                </button>
            </form>

        </div>
    </div>
@endsection