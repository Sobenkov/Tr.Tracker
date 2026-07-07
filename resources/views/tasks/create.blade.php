@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-8 py-10">

        <div class="mb-8">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900">
                Создать задачу
            </h1>

            <p class="mt-2 text-gray-500">
                Заполните информацию о новой задаче.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">
                <h3 class="font-semibold text-red-700">
                    Не удалось сохранить задачу
                </h3>

                <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="rounded-2xl bg-white border border-gray-200 shadow-sm p-8">

            <form action="{{ route('tasks.store') }}" method="POST">

                @csrf

                {{-- Название --}}
                <div class="mb-6">

                    <label
                        for="title"
                        class="block mb-2 text-sm font-semibold text-gray-700">

                        Название

                    </label>

                    <input
                        id="title"
                        type="text"
                        name="title"
                        value="{{ old('title') }}"

                        class="w-full rounded-xl border border-gray-300 px-4 py-3
                           focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                           outline-none transition"

                        required>

                </div>

                {{-- Описание --}}
                <div class="mb-6">

                    <label
                        for="description"
                        class="block mb-2 text-sm font-semibold text-gray-700">

                        Описание

                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="6"

                        class="w-full rounded-xl border border-gray-300 px-4 py-3
                           focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                           outline-none transition">{{ old('description') }}</textarea>

                </div>

                {{-- Статус --}}
                <div class="mb-8">

                    <label
                        for="status"
                        class="block mb-2 text-sm font-semibold text-gray-700">

                        Статус

                    </label>

                    <select
                        id="status"
                        name="status"

                        class="w-full rounded-xl border border-gray-300 px-4 py-3
                           focus:border-blue-500 focus:ring-2 focus:ring-blue-200
                           outline-none transition">

                        <option value="in_progress"
                            @selected(old('status') == 'in_progress')>
                            В работе
                        </option>

                        <option value="completed"
                            @selected(old('status') == 'completed')>
                            Завершена
                        </option>

                    </select>

                </div>

                {{-- Кнопки --}}
                <div class="flex items-center gap-4">

                    <button
                        type="submit"

                        class="rounded-xl bg-blue-600 px-6 py-3
                           font-semibold text-white shadow-lg
                           transition-all duration-200
                           hover:bg-blue-700 hover:shadow-xl">

                        💾 Сохранить

                    </button>

                    <a
                        href="{{ route('tasks.index') }}"

                        class="rounded-xl border border-gray-300 px-6 py-3
                           font-medium text-gray-700
                           transition hover:bg-gray-100">

                        Отмена

                    </a>

                </div>

            </form>

        </div>

    </div>
@endsection
