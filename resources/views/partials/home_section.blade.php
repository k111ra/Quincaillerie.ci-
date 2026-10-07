{{-- Rend une section d'accueil dynamique. Attend $section (App\Models\HomeSection). --}}
@php
    $products = $section->products();
    $sourceCategory = $section->category();
@endphp

@if ($products->isNotEmpty())
    @php
        // Pour les onglets : on regroupe par sous-catégorie, chacune avec sa
        // propre liste (jusqu'à la limite), et on ignore les sous-catégories vides.
        $tabGroups = collect();
        if ($section->display === 'tabs' && $sourceCategory) {
            $tabGroups = $sourceCategory->children
                ->map(function ($child) use ($section) {
                    return ['category' => $child, 'products' => $section->productsForCategory($child->id)];
                })
                ->filter(fn ($group) => $group['products']->isNotEmpty())
                ->values();
        }
    @endphp

    @if ($tabGroups->isNotEmpty())
        {{-- Affichage en onglets par sous-catégorie --}}
        <div class="ttm-tabs">
            <div class="content-sec-head-style">
                <div class="content-area-sec-title">
                    <h5>{{ $section->title }}</h5>
                </div>
                @if ($sourceCategory)
                    <a class="home-section-link" href="{{ route('shop', $sourceCategory->slug) }}">Voir la catégorie <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                @endif
                <ul class="tabs text-right">
                    @foreach ($tabGroups as $group)
                        <li class="tab"><a href="#section-{{ $section->id }}-{{ $group['category']->id }}">{{ $group['category']->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="content-tab">
                @foreach ($tabGroups as $group)
                    <div class="content-inner" id="section-{{ $section->id }}-{{ $group['category']->id }}">
                        <div class="products row">
                            @foreach ($group['products'] as $product)
                                @include('partials.product', ['product' => $product])
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @elseif ($section->display === 'slider')
        {{-- Affichage en carrousel --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="content-sec-head-style">
                    <div class="content-area-sec-title">
                        <h5>{{ $section->title }}</h5>
                    </div>
                    @if ($sourceCategory)
                        <a class="home-section-link" href="{{ route('shop', $sourceCategory->slug) }}">Voir la catégorie <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    @endif
                </div>
            </div>
            <div class="col-lg-12">
                <div class="pro_slick_slider"
                    data-slick='{"slidesToShow": 4, "slidesToScroll": 4, "arrows":true, "autoplay":true}'>
                    @foreach ($products as $product)
                        @include('partials.product_slider', ['product' => $product])
                    @endforeach
                </div>
            </div>
        </div>
    @else
        {{-- Affichage en grille (par défaut) --}}
        <div class="content-sec-head-style">
            <div class="content-area-sec-title">
                <h5>{{ $section->title }}</h5>
            </div>
            @if ($sourceCategory)
                <a class="home-section-link" href="{{ route('shop', $sourceCategory->slug) }}">Voir la catégorie <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
            @endif
        </div>
        <div class="products row">
            @foreach ($products as $product)
                @include('partials.product', ['product' => $product])
            @endforeach
        </div>
    @endif
@endif
