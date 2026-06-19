@extends("layouts.app")

@section("content")
    <div
        x-data="{
            addingCategory: false,
            newCategory: '',
            activeCategory: {{ $categories->first()?->id ?? "null" }},
            categories: {{ $categories->toJson() }},
            addCategory() {
                if (! this.newCategory.trim()) return
                const fd = new FormData()
                fd.append('_token', '{{ csrf_token() }}')
                fd.append('name', this.newCategory)
                fetch('/categories', { method: 'POST', body: fd })
                    .then((r) => r.json())
                    .then((category) => {
                        this.categories.push(category)
                        this.activeCategory = category.id
                        this.newCategory = ''
                        this.addingCategory = false
                    })
            },
            deleteCategory(id) {
                const fd = new FormData()
                fd.append('_token', '{{ csrf_token() }}')
                fd.append('_method', 'DELETE')
                fetch(`/categories/${id}`, { method: 'POST', body: fd }).then((r) => {
                    if (r.ok) {
                        this.categories = this.categories.filter((c) => c.id !== id)
                        this.activeCategory = this.categories[0]?.id ?? null
                    }
                })
            },
            init() {
                Sortable.create(this.$refs.categoriesContainer, {
                    animation: 150,
                    onEnd: (evt) => {
                        const moved = this.categories.splice(evt.oldIndex, 1)[0]
                        this.categories.splice(evt.newIndex, 0, moved)
                    },
                })
                Sortable.create(this.$refs.activeTasks, { animation: 150 })
            },
        }"
        class="flex flex-col gap-6 rounded-md  px-11 py-6 "
    >
        {{-- Категории --}}
        <div class="flex items-center gap-2" x-ref="categoriesContainer">
            <template x-for="category in categories" :key="category.id">
                <div class="group flex items-center gap-1">
                    <button
                        @click="activeCategory = category.id"
                        :class="activeCategory === category.id ? 'bg-secondary text-white' : 'border'"
                        class="rounded-md px-4 py-1 text-sm"
                        x-text="category.name"
                    ></button>
                    <button
                        @click="deleteCategory(category.id)"
                        class="text-xs text-gray-300 opacity-0 transition group-hover:opacity-100 hover:text-red-400"
                    >
                        ×
                    </button>
                </div>
            </template>

            <input
                x-show="addingCategory"
                x-model="newCategory"
                @keydown.enter="addCategory()"
                @keydown.escape="addingCategory = false; newCategory = ''"
                class="rounded-md border px-3 py-1 text-sm"
                placeholder="Category name..."
                x-ref="categoryInput"
            />
            <button
                x-show="!addingCategory"
                @click="addingCategory = true; $nextTick(() => $refs.categoryInput.focus())"
                class="bg-secondary hover:bg-secondary/90 w-8 rounded-t-md py-1 text-white shadow-md"
            >
                +
            </button>
        </div>

        {{-- Активные задачи --}}
        <div x-ref="activeTasks" class="flex flex-col gap-2">
            @foreach ($tasks->where("completed", false) as $task)
                <div
                    x-show="
                        activeCategory === null ||
                            activeCategory === {{ $task->category_id ?? "null" }}
                    "
                    x-data="{
                        editing: false,
                        title: {{ Js::from($task->title) }},
                        save() {
                            const fd = new FormData()
                            fd.append('_method', 'PUT')
                            fd.append('_token', '{{ csrf_token() }}')
                            fd.append('title', this.title)
                            fetch('/tasks/{{ $task->id }}', { method: 'POST', body: fd }).then(
                                (r) => {
                                    if (r.ok) this.editing = false
                                },
                            )
                        },
                    }"
                    @keydown.enter.window="if(editing) save()"
                    class="group flex items-center justify-between"
                >
                    <div class="flex items-center gap-2">
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
                                data-id="{{ $task->id }}"
                                class="accent-primary h-5 w-5"
                            />
                        </form>

                        <span
                            x-show="!editing"
                            x-text="title"
                            @click="editing = !editing"
                            class="cursor-pointer"
                        ></span>
                        <input
                            x-show="editing"
                            x-model="title"
                            class="rounded border px-4 py-1"
                            @keydown.enter="save()"
    @keydown.escape="editing = false"
                        />
                    </div>

                    <form
                        action="{{ route("tasks.destroy", $task) }}"
                        method="POST"
                    >
                        @csrf
                        @method("DELETE")
                        <button
                            type="submit"
                            class="text-gray-300 opacity-0 transition group-hover:opacity-100 hover:text-red-400"
                        >
                            Delete
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        {{-- Форма добавления задачи --}}
        <form
            x-show="activeCategory !== null"
            action="{{ route("tasks.store") }}"
            method="POST"
        >
            @csrf
            <input type="hidden" name="category_id" :value="activeCategory" />
            <input
                type="text"
                name="title"
                placeholder="New task..."
                class="w-full rounded-md border px-4 py-1"
                @keydown.enter="$el.closest('form').submit()"
            />
        </form>

        {{-- Выполненные задачи --}}
        @if ($tasks->where("completed", true)->count())
            <div class="mt-4 flex flex-col gap-2 border-t pt-4">
                @foreach ($tasks->where("completed", true) as $task)
                    <div
                        x-show="
                            activeCategory === null ||
                                activeCategory === {{ $task->category_id ?? "null" }}
                        "
                        class="group flex items-center justify-between opacity-50"
                    >
                        <div class="flex items-center gap-2">
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
                                    data-id="{{ $task->id }}"
                                    class="accent-primary h-5 w-5"
                                    checked
                                />
                            </form>
                            <span class="text-gray-400 line-through">
                                {{ $task->title }}
                            </span>
                        </div>

                        <form
                            action="{{ route("tasks.destroy", $task) }}"
                            method="POST"
                        >
                            @csrf
                            @method("DELETE")
                            <button
                                type="submit"
                                class="text-gray-300 opacity-0 transition group-hover:opacity-100 hover:text-red-400"
                            >
                                Delete
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

<script>
    document.querySelectorAll('input[type="checkbox"]').forEach((cb) => {
        cb.addEventListener('change', function () {
            const taskEl = this.closest('[class*="group"]')

            // анимация улетания
            taskEl.style.transition = 'all 0.4s ease'
            taskEl.style.opacity = '0'
            taskEl.style.transform = 'translateY(20px)'

            fetch(`/tasks/${this.dataset.id}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ completed: this.checked }),
            }).then(() => {
                setTimeout(() => window.location.reload(), 400)
            })
        })
    })
</script>
