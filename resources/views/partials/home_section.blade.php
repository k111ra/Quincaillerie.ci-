{{-- Rend une section d'accueil dynamique. Attend $section (App\Models\HomeSection). --}}
@php
    $products = $section->products();
@endphp

@if ($products->isNotEmpty())
    @if ($section->display === 'tabs' && $section->type === 'category' && optional($section->category())->children->isNotEmpty())
        {{-- Affichage en onglets par sous-catégorie --}}
        @php
            $parent = $section->category();
            $children = $parent->children;
        @endphp
        <div class="ttm-tabs">
            <div class="content-sec-head-style">
                <div class="content-area-sec-title">
                    <h5>{{ $section->title }}</h5>
                </div>
                <ul class="tabs text-right">
                    @foreach ($children as $child)
                        <li class="tab"><a href="#section-{{ $section->id }}-{{ $child->id }}">{{ $child->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="content-tab">
                @foreach ($children as $child)
                    <div class="content-inner" id="section-{{ $section->id }}-{{ $child->id }}">
                        <div class="products row">
                            @foreach ($products as $product)
                                @if ($product->categorie_id == $child->id)
                                    @include('partials.product', ['product' => $product])
                                @endif
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
        </div>
        <div class="products row">
            @foreach ($products as $product)
                @include('partials.product', ['product' => $product])
            @endforeach
        </div>
    @endif
@endif
