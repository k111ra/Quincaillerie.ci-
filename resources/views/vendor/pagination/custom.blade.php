@if ($paginator->hasPages())
    <div class="demo-inline-spacing">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                {{-- Lien "Première Page" --}}
                <li class="page-item first {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $paginator->url(1) }}" aria-label="Première Page">
                        <i class="tf-icon bx bx-chevrons-left"></i>
                    </a>
                </li>

                {{-- Lien "Précédent" --}}
                <li class="page-item prev {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Précédent">
                        <i class="tf-icon bx bx-chevron-left"></i>
                    </a>
                </li>

                {{-- Lien des pages --}}
                @foreach ($elements as $element)
                    {{-- "..." separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach
                    @endif
                @endforeach

                {{-- Lien "Suivant" --}}
                <li class="page-item next {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Suivant">
                        <i class="tf-icon bx bx-chevron-right"></i>
                    </a>
                </li>

                {{-- Lien "Dernière Page" --}}
                <li class="page-item last {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}"
                        aria-label="Dernière Page">
                        <i class="tf-icon bx bx-chevrons-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endif
