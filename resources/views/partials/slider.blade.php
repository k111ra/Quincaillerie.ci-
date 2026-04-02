<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-ride="carousel" data-interval="5000"
    data-pause="hover">
    <ol class="carousel-indicators">
        @foreach ($carousels as $index => $carousel)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}"
                class="{{ $loop->first ? 'active' : '' }}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach ($carousels as $index => $carousel)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                @if (!empty($carousel->link))
                    <a href="{{ $carousel->link }}" target="_blank" rel="noopener noreferrer">
                        <img class="d-block w-100" src="{{ asset('storage/' . $carousel->image) }}"
                            alt="{{ $carousel->title }}">
                    </a>
                @else
                    <img class="d-block w-100" src="{{ asset('storage/' . $carousel->image) }}"
                        alt="{{ $carousel->title }}">
                @endif
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $carousel->title }}</h5>
                    <p style="color: black;">{{ $carousel->description }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
