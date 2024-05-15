@extends('layout.app')
@section('content')
    <div class="text-center">
        <b>
            <h2>Welcome To Gallery Website</h2>
        </b>
    </div>
    <div class="my-3">
        <div class="text-center">
            <b>
                <h3>Photo With The Most Likes</h3>
            </b>
        </div>
        <div class="row">
            @forelse ($photos as $num => $item)
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <article class="post-grid mb-5 ">
                        <a class="post-thumb mb-4 d-block" href="/postingan/{{ $item->id }}">
                            <img src="{{ asset('storage/' . $item->location_file) }}" alt=""  class="img-fluid" style="width: 100%;height:200px;object-fit:cover;">
                        </a>

                        <div class="post-content-grid">
                            <div class="label-date">
                                <span>{{ $num += 1 }}</span>
                            </div>
                            <h3 class="post-title mt-1"><a href="/postingan/{{ $item->id }}">{{ $item->name_photo }}</a>
                            </h3>
                        </div>
                    </article>
                </div>
            @empty
            @endforelse
        </div>
        @if ($photos->count() == 0)
            <div class="" style="text-align: center;">
                <img class="mt-3" src="{{ asset('no.avif') }}" style="width: 200px;height: 200px;border-radius:50%;" alt="">
                <p>No photos have been liked yet.</p>
            </div>
        @endif
    </div>

    <div class="my-3">
        <div class="text-center">
            <b>
                <h3>Latest Photo</h3>
            </b>
        </div>
        <div class="row">
            @forelse ($new_photos as $num => $item)
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <article class="post-grid mb-5 ">
                        <a class="post-thumb mb-4 d-block" href="/postingan/{{ $item->id }}">
                            <img src="{{ asset('storage/' . $item->location_file) }}" alt=""
                            class="img-fluid" style="width: 100%;height:200px;object-fit:cover;">
                        </a>

                        <div class="post-content-grid">
                            <div class="label-date">
                                <span>{{ $num += 1 }}</span>
                            </div>
                            <h3 class="post-title mt-1"><a href="/postingan/{{ $item->id }}">{{ $item->name_photo }}</a>
                            </h3>
                        </div>
                    </article>
                </div>
            @empty
            @endforelse
        </div>
        @if ($new_photos->count() == 0)
            <div class="" style="text-align: center;">
                <img class="mt-3" src="{{ asset('no.avif') }}" style="width: 200px;height: 200px;border-radius:50%;" alt="">

                <p>No photos have been liked yet.</p>
            </div>
        @endif
    </div>
@endsection
