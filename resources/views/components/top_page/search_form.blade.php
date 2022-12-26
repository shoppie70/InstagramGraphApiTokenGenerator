<section class="input_zone p-6 lg:p-2 m-auto my-0 w-full lg:h-full bg-white shadow-md md:p-0">
    <div class="px-2 py-8 rounded-xl">
        <h1 class="mt-3 mb-16 text-2xl font-medium text-center">
            {{ $title }}
        </h1>
{{--        <p class="mb-4 mt-8 leading-relaxed">--}}
{{--            This is a tool to automatically get Instagram Graph API access token 3 and Instagram Business--}}
{{--            Account ID just by entering <span--}}
{{--                class="label">App ID</span>, <span--}}
{{--                class="label">App Secret</span>, <span--}}
{{--                class="label">access token 1</span>, and <span--}}
{{--                class="label">Facebook Page name</span>.<br>--}}
{{--            <br>If the tool does not work properly, please post an <a--}}
{{--                href="https://github.com/shoppie70/Instagram-Graph-API-Automatic-Token-Acquisition-Tool/issues"--}}
{{--                target="_blank"--}}
{{--                rel="noopener"--}}
{{--                class="text-blue-600"><span class="label">issue</span></a> on <a--}}
{{--                href="https://github.com/shoppie70/Instagram-Graph-API-Automatic-Token-Acquisition-Tool"--}}
{{--                target="_blank"--}}
{{--                rel="noopener"--}}
{{--                class="text-blue-600"><span class="label">GitHub</span></a>.--}}
{{--        </p>--}}
        <form action="{{ $endpoint }}" id="api_form" method="POST">
            @csrf
            @method($method)
            <div class="my-5 text-sm">
                <label for="access_token1" class="block text-black">
                    Access Token 1 <span class="text-red-600">*</span>
                </label>
                <input name="access_token1" type="text" autofocus id="access_token1"
                       value="{{ config('instagram.access_token') ?? '' }}"
                       class="px-4 py-3 mt-3 w-full bg-gray-100 rounded-sm focus:outline-none"
                       placeholder="token here" required>
            </div>
            <div class="my-5 text-sm">
                <label for="app_id" class="block text-black">
                    App ID <span class="text-red-600">*</span>
                </label>
                <input name="app_id" type="text" id="app_id" value="{{ config('instagram.app_id') ?? '' }}"
                       class="px-4 py-3 mt-3 w-full bg-gray-100 rounded-sm focus:outline-none"
                       placeholder="ID here" required/>
            </div>
            <div class="my-5 text-sm">
                <label for="app_secret" class="block text-black">
                    App Secret <span class="text-red-600">*</span>
                </label>
                <input name="app_secret" type="text" id="app_secret" value="{{ config('instagram.app_secret') ?? '' }}"
                       class="px-4 py-3 mt-3 w-full bg-gray-100 rounded-sm focus:outline-none"
                       placeholder="App Secret here" required/>
            </div>
            <div class="my-5 text-sm">
                <label for="facebook_page_name" class="block text-black">
                    FaceBook Page Name <span class="text-red-600">*</span>
                </label>
                <input name="facebook_page_name" type="text" id="facebook_page_name"
                       value="{{ config("instagram.page_name") ?? '' }}"
                       class="px-4 py-3 mt-3 w-full bg-gray-100 rounded-sm focus:outline-none" placeholder=""
                       required/>
            </div>
            <button type="submit"
                    class="block p-3 w-full text-center text-white bg-indigo-800 rounded-sm duration-300 hover:bg-black">
                Get Tokens!
            </button>
        </form>
        <div class="flex justify-center items-center mt-10 md:justify-between">
            <div style="height: 1px;" class="hidden w-4/12 bg-gray-300 md:block"></div>
            <p class="text-sm font-light text-gray-400 md:mx-2"> Social Link </p>
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
                <a href="https://developers.facebook.com/tools" target="_blank" rel="noopener"
                   class="block p-3 w-full text-center text-white bg-blue-400 rounded-sm duration-300 hover:bg-blue-500">
                    Meta for Developers
                </a>
            </div>
        </div>
    </div>
    <small class="text-center text-xs text-gray-400 md:block">
        Made with <span class="text-base" style="color: #e25555;">&hearts;</span> by Sho Tsukamoto
    </small>
</section>
