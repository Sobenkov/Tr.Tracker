@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-8 py-10">

        {{-- Заголовок --}}
        <div class="mb-8">

            <div class="flex items-center gap-3">

                <h1 class="text-4xl font-bold tracking-tight text-gray-900">
                    {{ $task->title }}
                </h1>

                @if($task->status === 'completed')

                    <span class="rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-700">
                    Завершена
                </span>

                @else

                    <span class="rounded-full bg-blue-100 px-3 py-1 text-sm font-medium text-blue-700">
                    В работе
                </span>

                @endif

            </div>

            <p class="mt-2 text-gray-500">
                Просмотр задачи и учёт рабочего времени.
            </p>

        </div>

        {{-- Flash --}}
        @if(session('success'))

            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-green-700">
                {{ session('success') }}
            </div>

        @endif

        @if($errors->any())

            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">

                <ul class="list-disc list-inside text-red-600">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <div class="rounded-2xl border border-gray-200 bg-white shadow-sm p-8">

            {{-- Описание --}}
            <div>

                <h2 class="text-sm font-semibold text-gray-700 mb-2">
                    Описание
                </h2>

                <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 leading-7 text-gray-700 min-h-[120px] whitespace-pre-line">
                    {{ $task->description ?: 'Описание отсутствует.' }}
                </div>

            </div>

            @php
                $hours = intdiv($task->time_spent_minutes, 60);
                $minutes = $task->time_spent_minutes % 60;
            @endphp

            {{-- Время --}}
            <div class="mt-8 rounded-2xl border border-gray-200 bg-gray-50 p-6">

                <h2 class="text-lg font-semibold text-gray-900 mb-6">
                    Учёт времени
                </h2>

                <div class="flex items-center justify-between border-b border-gray-200 pb-4">

                <span class="text-gray-500">
                    Всего учтено
                </span>

                    <span class="text-xl font-bold text-gray-900">
                    {{ $hours }} ч {{ $minutes }} мин
                </span>

                </div>

                @if($task->isTimerRunning())

                    <div class="flex items-center justify-between py-5 border-b border-gray-200">

                    <span class="text-gray-500">
                        Текущая сессия
                    </span>

                        <span
                            class="timer text-3xl font-mono font-bold text-gray-900"
                            data-start="{{ $task->started_at->timestamp }}">

                        00:00:00

                    </span>

                    </div>

                    <form
                        method="POST"
                        action="{{ route('tasks.stop', $task) }}"
                        class="mt-6">

                        @csrf

                        <button
                            class="w-full rounded-xl border border-red-300 py-3 text-red-600 font-medium transition hover:bg-red-50">

                            Остановить таймер

                        </button>

                    </form>

                @else

                    <form
                        method="POST"
                        action="{{ route('tasks.start', $task) }}"
                        class="mt-6">

                        @csrf

                        <button
                            class="w-full rounded-xl bg-blue-600 py-3 text-white font-medium transition hover:bg-blue-700">

                            Запустить таймер

                        </button>

                    </form>

                @endif

            </div>

            {{-- Добавить время --}}
            <form
                action="{{ route('tasks.update', $task) }}"
                method="POST"
                class="mt-8">

                @csrf
                @method('PUT')

                <label
                    for="add_minutes"
                    class="block mb-2 text-sm font-semibold text-gray-700">

                    Добавить время вручную

                </label>

                <div class="flex gap-3">

                    <input
                        id="add_minutes"
                        type="number"
                        name="add_minutes"
                        min="0"
                        placeholder="Минуты"

                        class="flex-1 rounded-xl border border-gray-300 px-4 py-3
                           focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                    <button
                        type="submit"
                        class="rounded-xl bg-blue-600 px-6 text-white font-medium hover:bg-blue-700 transition">

                        Добавить

                    </button>

                </div>

            </form>

            {{-- Кнопки --}}
            <div class="mt-10 flex gap-3">

                <a
                    href="{{ route('tasks.edit', $task) }}"
                    class="rounded-xl border border-gray-300 px-6 py-3 font-medium text-gray-700 hover:bg-gray-100 transition">

                    Редактировать

                </a>

                <a
                    href="{{ route('tasks.index') }}"
                    class="rounded-xl border border-gray-300 px-6 py-3 font-medium text-gray-700 hover:bg-gray-100 transition">

                    Назад

                </a>

            </div>

        </div>

    </div>
@endsection
