@extends('layouts.app')

@section('content')

    <div class="max-w-6xl mx-auto px-6 py-16">

        {{-- Hero --}}
        <section class="text-center">

        <span class="inline-flex rounded-full bg-blue-100 px-4 py-1 text-sm font-medium text-blue-700">
            TimeTracker
        </span>

            <h1 class="mt-6 text-5xl font-bold tracking-tight text-gray-900">
                Управляйте задачами
                <br>
                и учитывайте рабочее время
            </h1>

            <p class="mx-auto mt-6 max-w-3xl text-lg text-gray-600 leading-8">
                Простой сервис для хранения задач, учета рабочего времени
                и анализа собственной продуктивности.
            </p>

            <div class="mt-10 flex justify-center gap-4">

                @auth

                    <a href="{{ route('tasks.index') }}"
                       class="rounded-lg bg-blue-600 px-6 py-3 text-white font-semibold shadow hover:bg-blue-700 transition">
                        Перейти к задачам
                    </a>

                @else

                    <a href="{{ route('login') }}"
                       class="rounded-lg bg-blue-600 px-6 py-3 text-white font-semibold shadow hover:bg-blue-700 transition">
                        Войти
                    </a>

                    <a href="{{ route('register') }}"
                       class="rounded-lg border border-gray-300 px-6 py-3 font-semibold text-gray-700 hover:bg-gray-100 transition">
                        Регистрация
                    </a>

                @endauth

            </div>

        </section>


        {{-- Возможности --}}
        <section class="mt-24">

            <h2 class="text-3xl font-bold text-center text-gray-900">
                Возможности
            </h2>

            <p class="mt-4 text-center text-gray-600 max-w-2xl mx-auto">
                Всё необходимое для учета задач и рабочего времени в одном месте.
            </p>

            <div class="grid md:grid-cols-2 gap-8 lg:gap-12 mt-16">

                <div class="rounded-2xl bg-white shadow-md hover:shadow-xl transition p-10">
                    <h3 class="text-2xl font-semibold text-gray-900">
                        Управление задачами
                    </h3>

                    <p class="mt-6 text-gray-600 leading-8">
                        Создавайте задачи, изменяйте их статус, редактируйте описание
                        и храните всю рабочую информацию в одном месте.
                    </p>
                </div>

                <div class="rounded-2xl bg-white shadow-md hover:shadow-xl transition p-10">
                    <h3 class="text-2xl font-semibold text-gray-900">
                        Учет рабочего времени
                    </h3>

                    <p class="mt-6 text-gray-600 leading-8">
                        Добавляйте время вручную или запускайте встроенный таймер.
                        Всё затраченное время автоматически суммируется.
                    </p>
                </div>

                <div class="rounded-2xl bg-white shadow-md hover:shadow-xl transition p-10">
                    <h3 class="text-2xl font-semibold text-gray-900">
                        История работы
                    </h3>

                    <p class="mt-6 text-gray-600 leading-8">
                        Для каждой задачи хранится вся история работы,
                        что позволяет легко отслеживать прогресс и нагрузку.
                    </p>
                </div>

                <div class="rounded-2xl bg-white shadow-md hover:shadow-xl transition p-10">
                    <h3 class="text-2xl font-semibold text-gray-900">
                        В разработке
                    </h3>

                    <p class="mt-6 text-gray-600 leading-8">
                        В ближайших версиях появятся аналитика,
                        диаграммы, отчеты и расширенная статистика.
                    </p>
                </div>

            </div>

        </section>
    </div>

@endsection
