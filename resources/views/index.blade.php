@extends('layout.master')

@section('main')
    @include('partials.loading')
    <div class="flex flex-wrap lg:flex-nowrap h-screen bg-gray-100 dark:bg-gray-900">

        @include('components.top_page.search_form')
        @include('components.top_page.description_area')
        @include('components.top_page.result_area')
    </div>
@endsection
