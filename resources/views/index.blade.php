@extends('layout.master')

@section('main')
    @include('partials.loading')
    <div class="flex flex-wrap lg:flex-nowrap h-screen bg-gray-100 dark:bg-gray-900">

        @include('components.top_page.search_form')
        @include('components.top_page.description_area')
        @include('components.top_page.result_area')

        <a href="{{ route('locale', ['locale' => App::isLocale('en') ? 'ja' : 'en' ]) }}" class="text-sm absolute inline-block bottom-0 right-0 py-2 px-8 bg-blue-300 text-white font-bold">
            {{ App::isLocale('en') ? '日本語に切り替える' : 'Switch to English' }}
        </a>

    </div>
@endsection
