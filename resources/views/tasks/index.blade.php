@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-8 lg:px-12 py-10">

        {{-- Заголовок --}}
        <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between mb-10">

            <div>

                <h1 class="text-4xl font-bold tracking-tight text-gray-900">
                    Мои задачи
                </h1>

                <p class="mt-3 text-gray-500">
                    Всего задач: <span class="font-semibold text-gray-900">{{ $tasks->count() }}</span>
                </p>

            </div>

            <a href="{{ route('tasks.create') }}"
               class="inline-flex items-center rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                Новая задача
            </a>

        </div>

        {{-- Flash --}}
        @if(session('success'))
            <div class="mb-8 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Нет задач --}}
        @if($tasks->isEmpty())

            <div class="rounded-2xl border border-dashed border-gray-300 bg-white py-20 text-center">

                <h2 class="text-2xl font-semibold text-gray-900">
                    Пока нет задач
                </h2>

                <p class="mt-3 text-gray-500">
                    Создайте первую задачу и начните учитывать рабочее время.
                </p>

                <a href="{{ route('tasks.create') }}"
                   class="mt-8 inline-flex rounded-xl bg-blue-600 px-6 py-3 font-medium text-white hover:bg-blue-700">
                    Создать задачу
                </a>

            </div>

        @else

            <div class="space-y-5">

                @foreach($tasks as $task)

                    @php
                        $hours = intdiv($task->time_spent_minutes, 60);
                        $minutes = $task->time_spent_minutes % 60;
                    @endphp

                    <div class="rounded-2xl border border-gray-200 bg-white p-6 transition hover:shadow-md">

                        <div class="flex flex-col gap-8 lg:flex-row lg:justify-between">

                            {{-- Информация --}}
                            <a href="{{ route('tasks.edit', $task) }}" class="flex-1">

                                <div class="flex items-center gap-3">

                                    <h2 class="text-xl font-semibold text-gray-900">
                                        {{ $task->title }}
                                    </h2>

                                    @if($task->status === 'completed')

                                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
                                            Завершена
                                        </span>

                                    @else

                                        <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-medium text-blue-700">
                                            В работе
                                        </span>

                                    @endif

                                </div>

                                <p class="mt-4 text-gray-600 leading-7">
                                    {{ $task->description ?: 'Без описания' }}
                                </p>

                                <div class="mt-8 border-t border-gray-100 pt-5 space-y-3">

                                    <div class="flex justify-between text-sm">

                                        <span class="text-gray-500">
                                            Всего времени
                                        </span>

                                        <span class="font-medium text-gray-900">
                                            {{ $hours }} ч {{ $minutes }} мин
                                        </span>

                                    </div>

                                    @if($task->isTimerRunning())

                                        <div class="flex justify-between text-sm">

                                            <span class="text-gray-500">
                                                Текущая сессия
                                            </span>

                                            <span
                                                class="timer font-mono font-semibold text-gray-900"
                                                data-start="{{ $task->started_at->timestamp }}">
                                                00:00:00
                                            </span>

                                        </div>

                                    @endif

                                </div>

                            </a>

                            {{-- Панель действий --}}
                            <div class="w-full lg:w-60">

                                <div class="flex flex-col gap-3">

                                    @if($task->isTimerRunning())

                                        <form method="POST" action="{{ route('tasks.stop', $task) }}">
                                            @csrf

                                            <button
                                                class="w-full rounded-xl border border-red-300 px-4 py-3 text-sm font-medium text-red-600 transition hover:bg-red-50">
                                                Остановить таймер
                                            </button>

                                        </form>

                                    @else

                                        <form method="POST" action="{{ route('tasks.start', $task) }}">
                                            @csrf

                                            <button
                                                class="w-full rounded-xl bg-blue-600 px-4 py-3 text-sm font-medium text-white transition hover:bg-blue-700">
                                                Запустить таймер
                                            </button>

                                        </form>

                                    @endif

                                    {{--<a href="{{ route('tasks.edit', $task) }}"
                                       class="w-full rounded-xl border border-gray-300 px-4 py-3 text-center text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                                        Редактировать
                                    </a>--}}

                                    <a href="#"
                                        class="w-full rounded-xl border border-gray-300 px-4 py-3 text-center text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                                        Удалить
                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @endif

    </div>
@endsection
