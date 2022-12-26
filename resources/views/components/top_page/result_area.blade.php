<article id="result_area" class="p-4 w-full hidden">
    <div class="mb-8">
        <ul class="flex flex-wrap">
            @for($i = 0; $i <= 11; ++$i)
                <li id="{{ 'post' . $i }}" class="instagram__image--{{ $i }} instagram__image"
                    style="background-image: url('{{ asset('/assets/img/instagram.png') }}')">
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
                <textarea id="{{ $btn['btn_id'] }}"
                          class="px-3 py-2 w-full text-gray-700 rounded-lg border text focus:outline-none"
                          placeholder=""
                          rows="2"></textarea>
                <div class="mt-2 mr-2 text-right">
                    <button type="button" onclick="copyToClipboard('{{ $btn['btn_id'] }}')"
                            class="copy-text-btn focus:outline-none text-gray-600 text-sm py-2.5 px-5 rounded-md border border-gray-600 hover:bg-gray-50">
                        <div class="flex justify-center items-center">
                            <svg width="1rem" height="1rem" viewBox="0 0 16 16"
                                 class="mr-2 bi bi-clipboard-check" fill="currentColor"
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
</article>
