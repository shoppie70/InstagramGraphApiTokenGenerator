@extends('layout.master')

@section('json_ld')
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "HowTo",
        "name": "{{ Lang::get('common.manual_title') }}",
        "description": "{{ strip_tags(Lang::get('manual.description')) }}",
        "step": [
            {
                "@@type": "HowToStep",
                "name": "{{ Lang::get('manual.step1_title') }}",
                "text": "{{ strip_tags(Lang::get('manual.step1_desc')) }}"
            },
            {
                "@@type": "HowToStep",
                "name": "{{ Lang::get('manual.step2_title') }}",
                "text": "{{ strip_tags(Lang::get('manual.step2_desc')) }}"
            },
            {
                "@@type": "HowToStep",
                "name": "{{ Lang::get('manual.step3_title') }}",
                "text": "{{ strip_tags(Lang::get('manual.step3_desc')) }}"
            },
            {
                "@@type": "HowToStep",
                "name": "{{ Lang::get('manual.step4_title') }}",
                "text": "{{ strip_tags(Lang::get('manual.step4_desc')) }}"
            }
        ]
    }
    </script>
@endsection

@section('scripts')
    <script>
        const domain = 'https://graph.facebook.com/';
        const version = 'v13.0';
        const access_token2_form = document.getElementById('access_token2_form');
        const page_id_form = document.getElementById('page_id_form');
        const access_token_3_form = document.getElementById('access_token_3_form');
        const business_id_form = document.getElementById('business_id_form');

        const jump_graph_api_response_page = (uri, params) => {
            const search_params = new URLSearchParams(params).toString();
            window.open(uri + search_params, '_blank', 'noopener')
        };

        access_token2_form.addEventListener('submit', function (e) {
            e.preventDefault();

            const access_token1 = document.getElementById('access_token1').value;
            const app_id = document.getElementById('app_id').value;
            const app_secret = document.getElementById('app_secret').value;
            let uri = domain + version + '/oauth/access_token?';

            const params = {
                grant_type: 'fb_exchange_token',
                client_id: app_id,
                client_secret: app_secret,
                fb_exchange_token: access_token1,
            }

            jump_graph_api_response_page(uri, params);
        });

        page_id_form.addEventListener('submit', function (e) {
            e.preventDefault();

            const access_token2 = document.getElementById('access_token2').value;
            let uri = domain + version + '/me?';

            const params = {
                access_token: access_token2,
            }

            jump_graph_api_response_page(uri, params);
        });

        access_token_3_form.addEventListener('submit', function (e) {
            e.preventDefault();

            const access_token2 = document.getElementById('access_token2').value === '' ? document.getElementById('access_token2_same').value : document.getElementById('access_token2').value;
            const instagram_management_id = document.getElementById('instagram_management_id').value;
            let uri = domain + version + '/' + instagram_management_id + '/accounts?';

            const params = {
                access_token: access_token2,
            }

            jump_graph_api_response_page(uri, params);
        });

        business_id_form.addEventListener('submit', function (e) {
            e.preventDefault();

            const access_token3 = document.getElementById('access_token3').value;
            const instagram_page_id = document.getElementById('instagram_page_id').value;
            let uri = domain + version + '/' + instagram_page_id + '?';

            const params = {
                fields: 'instagram_business_account',
                access_token: access_token3
            }

            jump_graph_api_response_page(uri, params);
        });
    </script>
@endsection


@section('main')
    @include('partials.loading')
    <div class="overflow-scroll h-screen bg-gray-100 dark:bg-gray-900">
        <h1 class="py-4 text-2xl font-medium text-center">
            {{ $title }}
        </h1>
        <p class="text-center mb-4 ">
            {!! Lang::get('manual.description') !!}
        </p>

        <a href="{{ route('index.' . app()->getLocale()) }}" class="text-sm absolute inline-block top-0 right-0 py-2 px-8 bg-blue-300 text-white font-bold">
            {{ Lang::get('manual.back_to_auto') }}
        </a>
        <div class="flex h-full">
            <section class="w-1/4 p-6 border-r lg:p-2 m-auto my-0 w-full bg-white md:p-0">
                <div class="px-2 py-8 rounded-xl">
                    <h2 class="text-2xl font-medium text-center mb-8">
                        {{ Lang::get('manual.step1_title') }}
                    </h2>
                    <p class="mb-2">
                        {!! Lang::get('manual.step1_desc') !!}
                    </p>
                    <form id="access_token2_form" action="">
                        <div class="my-5 text-sm">
                            <label for="access_token1" class="block text-black">
                                {{ Lang::get('manual.step1_label_token1') }}
                            </label>
                            <input name="access_token1" type="text" autofocus="" id="access_token1" value=""
                                   class="px-4 py-3 mt-3 w-full bg-gray-100 rounded-sm focus:outline-none"
                                   placeholder="token here" required="">
                        </div>
                        <div class="my-5 text-sm">
                            <label for="app_id" class="block text-black">
                                {{ Lang::get('manual.step1_label_app_id') }}
                            </label>
                            <input name="app_id" type="text" id="app_id" value=""
                                   class="px-4 py-3 mt-3 w-full bg-gray-100 rounded-sm focus:outline-none"
                                   placeholder="ID here" required="">
                        </div>
                        <div class="my-5 text-sm">
                            <label for="app_secret" class="block text-black">
                                {{ Lang::get('manual.step1_label_app_secret') }}
                            </label>
                            <input name="app_secret" type="text" id="app_secret" value=""
                                   class="px-4 py-3 mt-3 w-full bg-gray-100 rounded-sm focus:outline-none"
                                   placeholder="App Secret here" required="">
                        </div>
                        <p class="mb-4">
                            {!! Lang::get('manual.step1_copy_hint') !!}
                        </p>
                        <div class="overflow-x-scroll text-xs">
<pre class="bg-gray-100 p-2">
<code class="w-full">{
    access_token: "This is Access Token2",
    token_type: "bearer"
}</code></pre>
                        </div>
                        <button type="submit"
                                id="token2_submit"
                                class="mt-6 w-full block p-3 text-center text-white bg-indigo-800 rounded-sm duration-300 hover:bg-black">
                            {{ Lang::get('manual.step1_btn') }}
                        </button>
                    </form>
                </div>
            </section>
            <section class="w-1/4 p-6 border-r lg:p-2 m-auto my-0 w-full bg-white md:p-0">
                <div class="px-2 pt-8 pb-4 rounded-xl">
                    <h2 class="text-2xl font-medium text-center mb-8">
                        {{ Lang::get('manual.step2_title') }}
                    </h2>
                    <p class="leading-8">
                        {!! Lang::get('manual.step2_desc') !!}
                    </p>
                    <form id="page_id_form" action="">
                        <div class="mt-5 mb-8 text-sm">
                            <label for="access_token2" class="block text-black">
                                {{ Lang::get('manual.step2_label_token2') }}
                            </label>
                            <input name="access_token2" type="text" autofocus="" id="access_token2" value=""
                                   class="px-4 py-3 mt-3 w-full bg-gray-100 rounded-sm focus:outline-none"
                                   placeholder="token here" required="">
                        </div>

                        <div class="overflow-x-scroll text-xs">
<pre class="bg-gray-100 p-2">
<code class="w-full">{
    name: "XXXXXXXX",
    id: "This is Management ID"
}</code></pre>
                        </div>
                        <button type="submit"
                                class="mt-6 w-full block p-3 text-center text-white bg-indigo-800 rounded-sm duration-300 hover:bg-black">
                            {{ Lang::get('manual.step2_btn') }}
                        </button>
                    </form>
                </div>
            </section>
            <section class="w-1/4 p-6 border-r lg:p-2 m-auto my-0 w-full bg-white md:p-0">
                <div class="px-2 py-8 rounded-xl">
                    <h2 class="text-2xl font-medium text-center mb-8">
                        {{ Lang::get('manual.step3_title') }}
                    </h2>
                    <p class="leading-8">
                        {!! Lang::get('manual.step3_desc') !!}
                    </p>
                    <form id="access_token_3_form" action="">
                        <div class="my-5 text-sm">
                            <label for="access_token2_same" class="block text-black">
                                {{ Lang::get('manual.step3_label_token2') }}
                            </label>
                            <input name="access_token2_same" type="text" autofocus="" id="access_token2_same" value=""
                                   class="px-4 py-3 mt-3 w-full bg-gray-100 rounded-sm focus:outline-none"
                                   placeholder="token here" required="">
                        </div>
                        <div class="my-5 text-sm">
                            <label for="instagram_management_id" class="block text-black">
                                {{ Lang::get('manual.step3_label_mgmt_id') }}
                            </label>
                            <input name="instagram_management_id" type="text" autofocus="" id="instagram_management_id"
                                   value=""
                                   class="px-4 py-3 mt-3 w-full bg-gray-100 rounded-sm focus:outline-none"
                                   placeholder="token here" required="">
                        </div>
                        <p class="mb-4">
                            {!! Lang::get('manual.step3_copy_hint') !!}
                        </p>
                        <div class="overflow-scroll text-xs">
<pre class="bg-gray-100 p-2">
<code class="w-full">{
    access_token: "This is Access Token3",
    category: "XXXXXXX",
    category_list: [
        {
            id: "XXXXXXX",
            name: "XXXXXXX"
        }
    ],
    name: "XXXXXXX",
    id: "This is Instagram Page ID",
},</code></pre>
                        </div>
                        <button type="submit"
                                class="mt-6 w-full block p-3 text-center text-white bg-indigo-800 rounded-sm duration-300 hover:bg-black">
                            {{ Lang::get('manual.step3_btn') }}
                        </button>
                    </form>
                </div>
            </section>
            <section class="w-1/4 p-6 lg:p-2 m-auto my-0 w-full bg-white md:p-0">
                <div class="px-2 py-8 rounded-xl">
                    <h2 class="text-2xl font-medium text-center">
                        {{ Lang::get('manual.step4_title') }}
                    </h2>
                    <form id="business_id_form" action="">
                        <div class="my-5 text-sm">
                            <label for="access_token3" class="block text-black">
                                {{ Lang::get('manual.step4_label_token3') }}
                            </label>
                            <input name="access_token3" type="text" autofocus="" id="access_token3" value=""
                                   class="px-4 py-3 mt-3 w-full bg-gray-100 rounded-sm focus:outline-none"
                                   placeholder="token here" required="">
                        </div>
                        <div class="my-5 text-sm">
                            <label for="instagram_page_id_same" class="block text-black">
                                {{ Lang::get('manual.step4_label_page_id') }}
                            </label>
                            <input name="instagram_page_id" type="text" autofocus="" id="instagram_page_id" value=""
                                   class="px-4 py-3 mt-3 w-full bg-gray-100 rounded-sm focus:outline-none"
                                   placeholder="token here" required="">
                        </div>
                        <p class="leading-8 mb-4">
                            {!! Lang::get('manual.step4_copy_hint') !!}
                        </p>
                        <div class="overflow-x-scroll text-xs mb-4">
<pre class="bg-gray-100 p-2">
<code class="w-full">{
    instagram_business_account: {
        id: "This is Instagram Business Account"
    },
    id: "XXXXXXXXX"
}</code></pre>
                        </div>
                        <p class="leading-8">
                            {!! Lang::get('manual.step4_desc') !!}
                        </p>
                        <button type="submit"
                                class="mt-6 w-full block p-3 text-center text-white bg-indigo-800 rounded-sm duration-300 hover:bg-black">
                            {{ Lang::get('manual.step4_btn') }}
                        </button>
                    </form>
                </div>
            </section>
        </div>
        <div class="fixed bottom-0 text-center text-sm text-gray-400 w-full bg-gray-200">
            <small class="w-full block">
                Made with <span class="text-base" style="color: #e25555;">&hearts;</span> by Sho Tsukamoto
            </small>
        </div>

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
