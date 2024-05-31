@if ($paginator->hasPages())
    <div class="pagination-area">
        <ul class="pagination" style="display:flex; justify-content:center;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true">
                    <span class="prev page-numbers"><i class="bx bx-chevron-left"></i></span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="prev page-numbers"><i class="bx bx-chevron-left"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><span class="page-numbers current" aria-current="page">{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}" class="page-numbers">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="next page-numbers"><i class="bx bx-chevron-right"></i></a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="next page-numbers"><i class="bx bx-chevron-right"></i></span>
                </li>
            @endif
        </ul>
    </div>
@endif
