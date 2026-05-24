<article id="description_area" class="p-4 w-full overflow-y-scroll">
    <header>
        <h1 class="mb-4 font-bold text-3xl border-b pb-2">
            {{ $title }}
        </h1>
    </header>
    <main>

        <section>
            <h2 class="pl-2 font-bold text-2xl mb-4 border-b pb-2">
                {{ Lang::get('description.about_title') }}
            </h2>
            <p class="mb-4 leading-relaxed pl-4">
                {!! Lang::get('description.about') !!}
            </p>
        </section>
        <section class="mb-8">
            <h2 class="pl-2 font-bold text-2xl mb-4 border-b pb-2">
                {{ Lang::get('description.usage_title') }}
            </h2>
            <p class="mb-4 leading-relaxed pl-4">
                {!! Lang::get('description.usage') !!}
            </p>
            <h3 class="pl-4 font-bold text-xl pb-2">
                {{ Lang::get('description.flow_title') }}
            </h3>
            <ol class="pl-4">
                @foreach($usage_items as $usage_item)
                    <li class="mb-2">
                        {!! $loop->iteration . '. ' . $usage_item  !!}
                    </li>
                @endforeach
            </ol>
            <p class="mb-4 leading-relaxed pl-4 font-bold">
                {{ Lang::get('description.flow_message') }}
            </p>
        </section>
        <section>
            <h2 class="pl-2 font-bold text-2xl mb-4 border-b pb-2">
                {{ Lang::get('description.not_working_title') }}
            </h2>
            <a href="{{ route('manual.' . app()->getLocale()) }}" class="inline-block ml-4 mb-4 py-3 px-6 text-center text-white bg-indigo-800 rounded-sm duration-300 hover:bg-black">
                {{ Lang::get('description.access_manual_tool') }}
            </a>
            <p class="mb-4 leading-relaxed pl-4">
                {!! Lang::get('description.not_working') !!}
            </p>

        </section>
    </main>
</article>
