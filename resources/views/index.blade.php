@extends('layout.master')

@section('main')
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <section class="bg-white w-full m-auto my-0 p-2 md:p-0 md:my-10 shadow-md" style="max-width: 640px">
            <div class="py-8 px-2 md:px-8 rounded-xl">
                <h1 class="font-medium text-2xl mt-3 text-center">
                    {{ $title }}
                </h1>
                <p class="mt-8">
                    To check how to use this tool, click <a href="https://webty.jp/staffblog/production/post-3736/" target="_blank" rel="noopener"
                                                            class="text-blue-600">this blog</a> or <a
                            href="https://github.com/shoppie70/Instagram-Graph-API-Automatic-Token-Acquisition-Tool" target="_blank" rel="noopener"
                            class="text-blue-600">Github</a>.<br><br>
                </p>
                <p class="leading-7 m-0">
                    Basically, all you need to do is to enter these four things: <br>
                    <span class="bg-gray-200 rounded p-1">Access Token1</span> ,
                    <span class="bg-gray-200 rounded p-1">app secret</span> ,
                    <span class="bg-gray-200 rounded p-1">App id</span> ,
                    and <span class="bg-gray-200 rounded p-1">Facebook Page Name</span>.
                </p>
                <form action="{{ $endpoint }}" class="mt-6 api_form" method="POST">
                    @csrf
                    @method($method)
                    <div class="my-5 text-sm">
                        <label for="access_token1" class="block text-black">
                            Access Token 1 <span class="text-red-600">*</span>
                        </label>
                        <input name="access_token1" type="text" autofocus id="access_token1" value="{{ config('ACCESS_TOKEN') ?? '' }}"
                               class="rounded-sm px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" placeholder="token here" required>
                    </div>
                    <div class="my-5 text-sm">
                        <label for="app_id" class="block text-black">
                            App ID <span class="text-red-600">*</span>
                        </label>
                        <input name="app_id" type="text" id="app_id" value="{{ config('APP_ID') ?? '' }}"
                               class="rounded-sm px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" placeholder="ID here" required/>
                    </div>
                    <div class="my-5 text-sm">
                        <label for="app_secret" class="block text-black">
                            App Secret <span class="text-red-600">*</span>
                        </label>
                        <input name="app_secret" type="text" id="app_secret" value="{{ config('APP_SECRET') ?? '' }}"
                               class="rounded-sm px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" placeholder="App Secret here" required/>
                    </div>
                    <div class="my-5 text-sm">
                        <label for="facebook_page_name" class="block text-black">
                            FaceBook Page Name <span class="text-red-600">*</span>
                        </label>
                        <input name="facebook_page_name" type="text" id="facebook_page_name" value="{{ config("PAGE_NAME") ?? '' }}"
                               class="rounded-sm px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" placeholder="" required/>
                    </div>
                    <button type="submit" class="block text-center text-white bg-gray-800 p-3 duration-300 rounded-sm hover:bg-black w-full">
                        Go!
                    </button>
                </form>

                <div class="flex md:justify-between justify-center items-center mt-10">
                    <div style="height: 1px;" class="bg-gray-300 md:block hidden w-4/12"></div>
                    <p class="md:mx-2 text-sm font-light text-gray-400"> Login With Social </p>
                    <div style="height: 1px;" class="bg-gray-300 md:block hidden w-4/12"></div>
                </div>

                <div class="grid md:grid-cols-2 gap-2 mt-7">
                    <div>
                        <a href="https://www.facebook.com/" target="_blank" rel="noopener"
                           class="block text-center w-full text-white bg-blue-900 p-3 duration-300 rounded-sm hover:bg-blue-700">
                            Facebook
                        </a>
                    </div>
                    <div>
                        <a href="https://trello.com/" target="_blank" rel="noopener"
                           class="block text-center w-full text-white bg-blue-400 p-3 duration-300 rounded-sm hover:bg-blue-500">
                            Trello
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <div class="hidden"><a class="js-modal-open" href="" data-target="tokenModal">Open Modal</a></div>
    <div id="tokenModal" class="c-modal js-modal">
        <div class="c-modal_bg js-modal-close"></div>
        <div class="c-modal_content _md bg-gray-100">
            <div class="c-modal_content_inner">
                <section>
                    <h2 class="text-md mb-3">
                        1. アクセストークン3を取得
                    </h2>
                    <textarea id="accessTokenContent" class="text w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none"
                              rows="4"></textarea>
                    <div class="text-right mr-2 mt-2">
                        <button type="button" onclick="copyToClipboard('accessTokenContent')"
                                class="copy-text-btn focus:outline-none text-gray-600 text-sm py-2.5 px-5 rounded-md border border-gray-600 hover:bg-gray-50">
                            <div class="flex justify-center items-center">
                                <svg width="1rem" height="1rem" viewBox="0 0 16 16" class="bi bi-clipboard-check mr-2" fill="currentColor"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                    <path fill-rule="evenodd"
                                          d="M9.5 1h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3zm4.354 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                </svg>
                                アクセストークン3をコピーする
                            </div>
                        </button>
                    </div>
                </section>
                <section>
                    <h2 class="text-md mb-3">
                        2. Instagram Business AccountのIDを取得
                    </h2>
                    <textarea id="businessAccountId" class="text w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none"
                              rows="4"></textarea>
                    <div class="text-right mr-2 mt-2">
                        <button type="button" onclick="copyToClipboard('businessAccountId')"
                                class="copy-text-btn focus:outline-none text-gray-600 text-sm py-2.5 px-5 rounded-md border border-gray-600 hover:bg-gray-50">
                            <div class="flex justify-center items-center">
                                <svg width="1rem" height="1rem" viewBox="0 0 16 16" class="bi bi-clipboard-check mr-2" fill="currentColor"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                    <path fill-rule="evenodd"
                                          d="M9.5 1h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3zm4.354 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                </svg>
                                Instagram Business AccountのIDをコピーする
                            </div>
                        </button>
                    </div>
                </section>
                <a class="js-modal-close c-modal_close" href="">
                    <span>×</span>
                </a>
            </div>
        </div>
    </div>

    <small class="text-gray-400 text-xs absolute hidden md:block" style="bottom: 0.25rem; right: 0.25rem;">
        Made with <span style="font-size: 1rem; color: #e25555;">&hearts;</span> by Sho Tsukamoto
    </small>

@endsection
