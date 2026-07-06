@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            {{-- Заголовок --}}
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900">
                    Создать задачу
                </h1>

                <p class="mt-2 text-gray-500">
                    Заполните информацию о новой задаче.
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

            {{-- Карточка --}}
            <div class="px-8 py-10">

                <form
                    action="{{ route('tasks.store') }}"
                    method="POST"
                    class="p-8 space-y-6"
                >

                    @csrf

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
                            value="{{ old('title') }}"
                            required

                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        >
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

                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        >{{ old('description') }}</textarea>

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
                                @selected(old('status') == 'in_progress')
                            >
                                В работе
                            </option>

                            <option
                                value="completed"
                                @selected(old('status') == 'completed')
                            >
                                Завершена
                            </option>

                        </select>

                    </div>

                    {{-- Кнопки --}}
                    <div class="flex justify-end gap-3 pt-4">

                        <a
                            href="{{ route('tasks.index') }}"
                            class="rounded-lg border border-gray-300 px-5 py-2.5 text-gray-700 hover:bg-gray-100 transition">

                            Отмена

                        </a>

                        <button
                            type="submit"

                            class="rounded-lg bg-blue-600 px-5 py-2.5 font-semibold text-white shadow hover:bg-blue-700 transition">

                            💾 Сохранить

                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
@endsection
