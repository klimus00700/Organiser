@extends("layouts.app")

@section("content")
    <div class="mx-auto mt-10 max-w-4xl">
        <h1 class="mb-6 text-2xl font-semibold">Statistics</h1>

        <!-- Categories -->
        <div class="mb-6 flex gap-2">
            @foreach ($categories as $name => $percent)
                <span
                    class="rounded-full bg-green-100 px-3 py-1 text-sm text-green-700"
                >
                    {{ $name }}
                </span>
            @endforeach
        </div>

        <!-- Progress bars -->
        <div class="mb-6 rounded-lg bg-white p-6 shadow-sm">
            @foreach ($categories as $name => $percent)
                <div class="mb-4">
                    <div class="mb-1 flex justify-between text-sm">
                        <span>{{ $name }}</span>
                        <span>{{ $percent }}%</span>
                    </div>

                    <div class="h-3 w-full rounded-full bg-gray-200">
                        <div
                            class="h-3 rounded-full bg-blue-500"
                            style="width: {{ $percent }}%"
                        ></div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Stats blocks -->
        <div class="grid grid-cols-3 gap-4">
            <div class="rounded-lg bg-white p-4 shadow-sm">
                <h3 class="mb-2 font-medium">This week</h3>
                <p>✔ {{ $weekCompleted }} tasks completed</p>
                <p>📌 {{ $weekTotal }} tasks total</p>
            </div>

            <div class="rounded-lg bg-white p-4 shadow-sm">
                <h3 class="mb-2 font-medium">This month</h3>
                <p>✔ {{ $monthCompleted }} tasks completed</p>
                <p>📌 {{ $monthTotal }} tasks total</p>
            </div>

            <div class="rounded-lg bg-white p-4 shadow-sm">
                <h3 class="mb-2 font-medium">Productivity</h3>
                <p>🔥 Keep going!</p>
            </div>
        </div>
    </div>
@endsection
