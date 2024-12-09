@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

<style>
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 1.5rem;
    }

    .pagination .page-item {
        margin: 0 0.25rem;
    }

    .pagination .page-link {
        color: var(--color-primary);
        background-color: var(--color-background);
        border: 1px solid var(--color-background);
        padding: 0.5rem 0.75rem;
        border-radius: 4px;
        transition: all var(--transition-speed);
    }

    .pagination .page-link:hover {
        background-color: var(--color-accent);
        color: var(--color-text-light);
    }

    .pagination .page-item.active .page-link {
        background-color: var(--color-accent);
        color: var(--color-text-light);
        border-color: var(--color-accent);
    }

    .pagination .page-item.disabled .page-link {
        color: var(--color-secondary);
        opacity: 0.6;
        pointer-events: none;
    }
</style>