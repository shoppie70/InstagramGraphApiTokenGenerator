@extends('layout.master')

@section('main')
    <div class="flex flex-wrap lg:flex-nowrap h-screen bg-gray-100 dark:bg-gray-900">
        <section class="input_zone p-6 lg:p-2 m-auto my-0 w-full lg:h-full bg-white shadow-md md:p-0">
            <div class="px-2 py-8 rounded-xl">
                <h1 class="mt-3 text-2xl font-medium text-center">
                    {{ $title }}
                </h1>
                <p class="mb-4 mt-8 leading-relaxed">
                    This is a tool to automatically get Instagram Graph API access token 3 and Instagram Business Account ID just by entering <span
                            class="p-1 bg-gray-200 rounded">App ID</span>, <span class="p-1 bg-gray-200 rounded">App Secret</span>, <span
                            class="p-1 bg-gray-200 rounded">access token 1</span>, and <span class="p-1 bg-gray-200 rounded">Facebook Page name</span>.<br>
                    <br>If the tool does not work properly, please post an <a
                            href="https://github.com/shoppie70/Instagram-Graph-API-Automatic-Token-Acquisition-Tool/issues" target="_blank"
                            rel="noopener"
                            class="text-blue-600"><span class="p-1 bg-gray-200 rounded">issue</span></a> on <a
                            href="https://github.com/shoppie70/Instagram-Graph-API-Automatic-Token-Acquisition-Tool" target="_blank"
                            rel="noopener"
                            class="text-blue-600"><span class="p-1 bg-gray-200 rounded">GitHub</span></a>.
                </p>
                <form action="{{ $endpoint }}" class="api_form" method="POST">
                    @csrf
                    @method($method)
                    <div class="my-5 text-sm">
                        <label for="access_token1" class="block text-black">
                            Access Token 1 <span class="text-red-600">*</span>
                        </label>
                        <input name="access_token1" type="text" autofocus id="access_token1" value="{{ config('ACCESS_TOKEN') ?? '' }}"
                               class="px-4 py-3 mt-3 w-full bg-gray-100 rounded-sm focus:outline-none" placeholder="token here" required>
                    </div>
                    <div class="my-5 text-sm">
                        <label for="app_id" class="block text-black">
                            App ID <span class="text-red-600">*</span>
                        </label>
                        <input name="app_id" type="text" id="app_id" value="{{ config('APP_ID') ?? '' }}"
                               class="px-4 py-3 mt-3 w-full bg-gray-100 rounded-sm focus:outline-none" placeholder="ID here" required/>
                    </div>
                    <div class="my-5 text-sm">
                        <label for="app_secret" class="block text-black">
                            App Secret <span class="text-red-600">*</span>
                        </label>
                        <input name="app_secret" type="text" id="app_secret" value="{{ config('APP_SECRET') ?? '' }}"
                               class="px-4 py-3 mt-3 w-full bg-gray-100 rounded-sm focus:outline-none" placeholder="App Secret here" required/>
                    </div>
                    <div class="my-5 text-sm">
                        <label for="facebook_page_name" class="block text-black">
                            FaceBook Page Name <span class="text-red-600">*</span>
                        </label>
                        <input name="facebook_page_name" type="text" id="facebook_page_name" value="{{ config("PAGE_NAME") ?? '' }}"
                               class="px-4 py-3 mt-3 w-full bg-gray-100 rounded-sm focus:outline-none" placeholder="" required/>
                    </div>
                    <button type="submit" class="block p-3 w-full text-center text-white bg-indigo-800 rounded-sm duration-300 hover:bg-black">
                        Get Tokens!
                    </button>
                </form>
                <div class="flex justify-center items-center mt-10 md:justify-between">
                    <div style="height: 1px;" class="hidden w-4/12 bg-gray-300 md:block"></div>
                    <p class="text-sm font-light text-gray-400 md:mx-2"> Login With Social </p>
                    <div style="height: 1px;" class="hidden w-4/12 bg-gray-300 md:block"></div>
                </div>
                <div class="grid gap-2 mt-7 md:grid-cols-2">
                    <div>
                        <a href="https://www.facebook.com/" target="_blank" rel="noopener"
                           class="block p-3 w-full text-center text-white bg-blue-900 rounded-sm duration-300 hover:bg-blue-700">
                            Facebook
                        </a>
                    </div>
                    <div>
                        <a href="https://trello.com/" target="_blank" rel="noopener"
                           class="block p-3 w-full text-center text-white bg-blue-400 rounded-sm duration-300 hover:bg-blue-500">
                            Trello
                        </a>
                    </div>
                </div>
            </div>
            <small class="text-center text-xs text-gray-400 md:block">
                Made with <span class="text-base" style="color: #e25555;">&hearts;</span> by Sho Tsukamoto
            </small>
        </section>
        <section class="p-4 w-full">
            <div class="mb-8">
                <ul class="flex flex-wrap">
                    @for($i = 0; $i <= 11; ++$i)
                        <li id="{{ 'post' . $i }}" class="instagram__image--{{ $i }} instagram__image" style="background-image: url('{{ asset('/assets/img/instagram.png') }}')">
                        </li>
                    @endfor
                </ul>
            </div>
            <div class="">
                @foreach( $btns as $btn )
                    <section>
                        <h2 class="font-bold mb-3 text-md">
                            {{ $btn['display_name'] }}
                        </h2>
                        <textarea id="{{ $btn['btn_id'] }}" class="px-3 py-2 w-full text-gray-700 rounded-lg border text focus:outline-none"
                                  placeholder="{{ $btn['display_name'] . ' will be displayed. / ' . $btn['display_name_ja'] .'が表示されます。' }}" rows="2"></textarea>
                        <div class="mt-2 mr-2 text-right">
                            <button type="button" onclick="copyToClipboard('{{ $btn['btn_id'] }}')"
                                    class="copy-text-btn focus:outline-none text-gray-600 text-sm py-2.5 px-5 rounded-md border border-gray-600 hover:bg-gray-50">
                                <div class="flex justify-center items-center">
                                    <svg width="1rem" height="1rem" viewBox="0 0 16 16" class="mr-2 bi bi-clipboard-check" fill="currentColor"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                        <path fill-rule="evenodd"
                                              d="M9.5 1h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3zm4.354 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                    </svg>
                                    {{ 'Copy the ' . $btn['display_name'] }}
                                </div>
                            </button>
                        </div>
                    </section>
                @endforeach
            </div>
        </section>
    </div>
@endsection
