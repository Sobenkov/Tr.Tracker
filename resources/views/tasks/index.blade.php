@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-8 lg:px-12 py-10">

        {{-- Заголовок --}}
        <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between mb-10">

            <div>
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 mt-4">
                    Мои задачи
                </h1>

                <div class="mt-4 inline-flex items-center rounded-full bg-gray-100 text-sm text-gray-600">
                    Всего задач:
                    <span class="font-semibold text-gray-900">
                    {{ $tasks->count() }}
                </span>
                </div>
            </div>

            <a href="{{ route('tasks.create') }}"
               class="my-4 inline-flex items-center justify-center rounded-xl bg-blue-600 px-6 py-4 text-sm font-semibold text-white shadow-lg transition-all duration-200 hover:bg-blue-700 hover:shadow-xl">
                ➕ Новая задача
            </a>

        </div>

        {{-- Flash --}}
        @if(session('success'))
            <div class="mb-8 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Если задач нет --}}
        @if($tasks->isEmpty())

            <div class="mx-auto max-w-2xl rounded-2xl border border-dashed border-gray-300 bg-white px-8 py-16 text-center shadow-sm">

                <div class="text-6xl mb-6">
                    📭
                </div>

                <h2 class="text-2xl font-semibold text-gray-900">
                    Пока нет задач
                </h2>

                <p class="mt-3 text-gray-500">
                    Создайте первую задачу и начните вести учёт времени.
                </p>

                <a href="{{ route('tasks.create') }}"
                   class="my-8 inline-flex items-center rounded-xl bg-blue-600 px-6 py-4 font-medium text-white shadow-lg transition-all duration-200 hover:bg-blue-700 hover:shadow-xl">
                    Создать первую задачу
                </a>

            </div>

        @else

            <div class="space-y-4">

                @foreach($tasks as $task)

                    <div class="rounded-2xl border border-gray-200 bg-white p-6 transition hover:border-blue-300 hover:shadow-md">

                        <div class="flex flex-col gap-5 md:flex-row md:items-start md:justify-between">

                            <div class="flex-1">

                                <div class="flex items-center gap-3">

                                    <h2 class="text-xl font-semibold text-gray-900">
                                        {{ $task->title }}
                                    </h2>

                                    @if($task->status === 'completed')

                                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Завершена
                                    </span>

                                    @else

                                        <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                        В работе
                                    </span>

                                    @endif

                                </div>

                                <p class="mt-3 text-gray-600">
                                    {{ $task->description ?: 'Без описания' }}
                                </p>

                                <div class="mt-5 flex items-center gap-2 text-sm text-gray-500">

                                    <span>⏱</span>

                                    <span>
                                    {{ $task->time_spent_minutes }} минут
                                </span>

                                </div>

                            </div>

                            <div class="flex gap-3">

                                <a href="{{ route('tasks.edit', $task) }}"
                                   class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-100">
                                    Редактировать
                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @endif

    </div>
@endsection
