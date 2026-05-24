@extends('layout.master')

@section('json_ld')
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "WebApplication",
        "name": "{{ Lang::get('common.title') }}",
        "description": "{{ Lang::get('description.meta_description') }}",
        "url": "{{ request()->url() }}",
        "applicationCategory": "DeveloperApplication",
        "operatingSystem": "All",
        "browserRequirements": "Requires JavaScript. Requires HTML5."
    }
    </script>
@endsection

@section('main')
    @include('partials.loading')
    <div class="flex flex-wrap lg:flex-nowrap h-screen bg-gray-100 dark:bg-gray-900">

        @include('components.top_page.search_form')
        @include('components.top_page.description_area')
        @include('components.top_page.result_area')

        @php
            $currentRoute = Route::currentRouteName();
            $isJa = str_ends_with($currentRoute, '.ja');
            $targetRoute = $isJa ? str_replace('.ja', '.en', $currentRoute) : str_replace('.en', '.ja', $currentRoute);
        @endphp
        <a href="{{ route($targetRoute) }}" class="text-sm absolute inline-block bottom-0 right-0 py-2 px-8 bg-blue-300 text-white font-bold">
            {{ $isJa ? 'Switch to English' : '日本語に切り替える' }}
        </a>

    </div>
@endsection
