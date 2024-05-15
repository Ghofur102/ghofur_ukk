@extends('layout.app')
@section('content')
    <div class="">
        <div class="container">
            <div class="">
                <div class="d-flex justify-content-center gap-2 my-3" style="overflow-x: auto;">
                    <form class="border border-white" action="/gallery/all" method="get">
                        <button type="submit" class="btn btn-secondary" for="option1">All</button>
                    </form>
                    <form class="border border-white" action="/gallery/likes" method="get">
                        <button type="submit" class="btn btn-secondary" for="option1">Likes</button>
                    </form>
                    <form class="border border-white" action="/gallery/latest" method="get">
                        <button type="submit" class="btn btn-secondary" for="option1">Latest</button>
                    </form>
                    <form class="border border-white" action="/gallery/longest" method="get">
                        <button type="submit" class="btn btn-secondary" for="option1">Longest</button>
                    </form>
                </div>
                <div class="text-center">
                    <h2 class="lg-title">{{ request()->type }} photo</h2>
                </div>

            </div>
        </div>
    </div>

    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        @forelse ($photos as $photo)
                            <div class="col-lg-4 col-xl-3 col-sm-12 col-md-6" id="photo{{ $photo->id }}">
                                <article class="post-grid mb-5">
                                    <div class="post-thumb mb-4">
                                        <a href="/postingan/{{ $photo->id }}">
                                            <img src="{{ asset('storage/' . $photo->location_file) }}" alt=""
                                                class="img-fluid" style="width: 100%;height:200px;object-fit:cover;">
                                        </a>

                                    </div>
                                    <h3 class="post-title mt-1"><a
                                            href="/postingan/{{ $photo->id }}">{{ $photo->name_photo }}</a></h3>

                                    <span
                                        class=" text-muted  text-capitalize">{{ \Carbon\Carbon::parse($photo->created_at)->diffForHumans() }}</span>

                                </article>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
            @if ($photos->count() == 0)
                <div class="text-center">
                    <img class="mt-3" src="{{ asset('no.avif') }}" style="width: 200px;height: 200px;border-radius:50%;"
                        alt="">

                    <p>No data post.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
