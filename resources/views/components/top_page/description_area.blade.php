<article id="description_area" class="p-4 w-full overflow-y-scroll">
    <header>
        <h1 class="mb-4 font-bold text-3xl border-b pb-2">
            {{ $title }}
        </h1>
    </header>
    <main>

        <section>
            <h3 class="pl-2 font-bold text-2xl mb-4 border-b pb-2">
                About
            </h3>
            <p class="mb-4 leading-relaxed pl-4">
                This is a tool that can automatically acquire each data for embedding Instagram posts on a website.<br>
                It can get Instagram Graph API <span class="font-bold">access token 3</span> and <span
                    class="font-bold">Instagram Business
            Account ID</span> just by entering <span
                    class="label">App ID</span>, <span
                    class="label">App Secret</span>, <span
                    class="label">access token 1</span>, and <span
                    class="label">Facebook Page name</span>.<br>
                <br>If the tool does not work properly, please post an <a
                    href="https://github.com/shoppie70/Instagram-Graph-API-Automatic-Token-Acquisition-Tool/issues"
                    target="_blank"
                    rel="noopener"
                    class="text-blue-600"><span class="label">issue</span></a> on <a
                    href="https://github.com/shoppie70/Instagram-Graph-API-Automatic-Token-Acquisition-Tool"
                    target="_blank"
                    rel="noopener"
                    class="text-blue-600"><span class="label">GitHub</span></a>.
            </p>
        </section>
        <section class="mb-8">
            <h3 class="pl-2 font-bold text-2xl mb-4 border-b pb-2">
                Usage
            </h3>
            <p class="mb-4 leading-relaxed pl-4">
                Basically, all you need to do is to enter these four things: <span class="label">Access Token1</span>, <span class="label">app secret</span>, <span class="label">App id</span>, and
                <span class="label">Facebook Page Name</span>.
            </p>
            <h4 class="pl-4 font-bold text-xl pb-2">
                Flow
            </h4>
            <ol class="pl-4">
                @foreach($usage_items as $usage_item)
                    <li class="mb-2">
                        {!! $loop->iteration . '. ' . $usage_item  !!}
                    </li>
                @endforeach
            </ol>
            <p class="mb-4 leading-relaxed pl-4 font-bold">
                Mainly the second is often not executed ;-(
            </p>
        </section>
        <section>
            <h3 class="pl-2 font-bold text-2xl mb-4 border-b pb-2">
                Not working?
            </h3>
            <a href="{{ route('manual') }}" class="inline-block ml-4 mb-4 py-3 px-6 text-center text-white bg-indigo-800 rounded-sm duration-300 hover:bg-black">
                >> Access Manual Acquisition Tool
            </a>
            <p class="mb-4 leading-relaxed pl-4">
                No problem! Prepared a manual acquisition tool.<br>
                Paste the data yourself and press the submit button, then you can see the response of Instagram Graph API, so you can handle detailed errors.
            </p>

        </section>
    </main>
</article>
