@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            {{-- Заголовок --}}
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900">
                    Редактировать задачу
                </h1>

                <p class="mt-2 text-gray-500">
                    Измените информацию о задаче или добавьте потраченное время.
                </p>
            </div>

            {{-- Ошибки --}}
            @if ($errors->any())
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">
                    <div class="font-semibold text-red-700">
                        Исправьте ошибки:
                    </div>

                    <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="p-8">

                <form
                    action="{{ route('tasks.update', $task) }}"
                    method="POST"
                    class="space-y-6">

                    @csrf
                    @method('PUT')

                    {{-- Название --}}
                    <div>

                        <label
                            for="title"
                            class="block text-sm font-medium text-gray-700 mb-2">

                            Название

                        </label>

                        <input
                            id="title"
                            type="text"
                            name="title"
                            value="{{ old('title', $task->title) }}"
                            required

                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                    </div>

                    {{-- Описание --}}
                    <div>

                        <label
                            for="description"
                            class="block text-sm font-medium text-gray-700 mb-2">

                            Описание

                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"

                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('description', $task->description) }}</textarea>

                    </div>

                    {{-- Статус --}}
                    <div>

                        <label
                            for="status"
                            class="block text-sm font-medium text-gray-700 mb-2">

                            Статус

                        </label>

                        <select
                            id="status"
                            name="status"

                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            <option
                                value="in_progress"
                                @selected(old('status', $task->status) == 'in_progress')>
                                В работе
                            </option>

                            <option
                                value="completed"
                                @selected(old('status', $task->status) == 'completed')>
                                Завершена
                            </option>

                        </select>

                    </div>

                    {{-- Учёт времени --}}
                    <div>

                        <label
                            for="add_minutes"
                            class="block text-sm font-medium text-gray-700 mb-2">

                            Добавить времени (минут)

                        </label>

                        <input
                            id="add_minutes"
                            type="number"
                            name="add_minutes"
                            min="0"
                            placeholder="Например, 30"

                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                        <p class="mt-2 text-sm text-gray-500">
                            Сейчас учтено:
                            <span class="font-semibold">{{ $task->time_spent_minutes }} мин.</span>
                        </p>

                    </div>

                    {{-- Кнопки --}}
                    <div class="flex justify-end gap-3 pt-4">

                        <a
                            href="{{ route('tasks.index') }}"
                            class="rounded-lg border border-gray-300 px-5 py-2.5 text-gray-700 transition hover:bg-gray-100">

                            Отмена

                        </a>

                        <button
                            type="submit"
                            class="rounded-lg bg-blue-600 px-5 py-2.5 font-semibold text-white shadow hover:bg-blue-700 transition">

                            💾 Обновить

                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
@endsection
