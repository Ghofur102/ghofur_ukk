@extends('layout.app')
@section('content')
    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                        <h2 class="lg-title">Profile</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="pt-5 padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


                    <div class="d-flex justify-content-center">
                        <div class="">
                            @if ($other->photo_profile === null)
                                <svg xmlns="http://www.w3.org/2000/svg" width="62" height="62" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M12 11q.825 0 1.413-.588Q14 9.825 14 9t-.587-1.413Q12.825 7 12 7q-.825 0-1.412.587Q10 8.175 10 9q0 .825.588 1.412Q11.175 11 12 11Zm0 2q-1.65 0-2.825-1.175Q8 10.65 8 9q0-1.65 1.175-2.825Q10.35 5 12 5q1.65 0 2.825 1.175Q16 7.35 16 9q0 1.65-1.175 2.825Q13.65 13 12 13Zm0 11q-2.475 0-4.662-.938q-2.188-.937-3.825-2.574Q1.875 18.85.938 16.663Q0 14.475 0 12t.938-4.663q.937-2.187 2.575-3.825Q5.15 1.875 7.338.938Q9.525 0 12 0t4.663.938q2.187.937 3.825 2.574q1.637 1.638 2.574 3.825Q24 9.525 24 12t-.938 4.663q-.937 2.187-2.574 3.825q-1.638 1.637-3.825 2.574Q14.475 24 12 24Zm0-2q1.8 0 3.375-.575T18.25 19.8q-.825-.925-2.425-1.612q-1.6-.688-3.825-.688t-3.825.688q-1.6.687-2.425 1.612q1.3 1.05 2.875 1.625T12 22Zm-7.7-3.6q1.2-1.3 3.225-2.1q2.025-.8 4.475-.8q2.45 0 4.463.8q2.012.8 3.212 2.1q1.1-1.325 1.713-2.95Q22 13.825 22 12q0-2.075-.788-3.887q-.787-1.813-2.15-3.175q-1.362-1.363-3.175-2.151Q14.075 2 12 2q-2.05 0-3.875.787q-1.825.788-3.187 2.151Q3.575 6.3 2.788 8.113Q2 9.925 2 12q0 1.825.6 3.463q.6 1.637 1.7 2.937Z" />
                                </svg>
                            @else
                                <img src="{{ asset('storage/' . $other->photo_profile) }}" class="my-2"
                                    style="width:150px;height:150px;object-fit:cover;border-radius:50%;" alt="">
                            @endif
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-8">


                            <h2 class="mb-4 mt-4">Information Account</h2>

                            <form id="contact-form" class="contact-form">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input class="form-control form-control-name" name="username" id="username"
                                                value="{{ $other->username }}" type="text" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="fullname">Fullname</label>
                                            <input class="form-control form-control-name" name="fullname" id="fullname"
                                                value="{{ $other->fullname }}" type="text" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input class="form-control form-control-name" name="address" id="address"
                                                value="{{ $other->address }}" type="text" disabled>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <section class="">
                        <div class="container">

                            <h2 class="mb-4 mt-4">All Album</h2>


                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        @forelse ($other->albums as $album)
                                            <div class="col-lg-4 col-xl-3 col-sm-12 col-md-6 border border-black p-2 mx-2"
                                                id="album{{ $album->id }}">
                                                <article class="post-grid mb-2">

                                                    <h3 class="post-title mt-1 text-center"><a
                                                            href="/show-album/{{ $album->id }}">{{ $album->name_album }}</a>
                                                    </h3>
                                                    <p>
                                                        {{ Str::limit($album->description, 30, '...') }}
                                                    </p>
                                                    <span
                                                        class="text-muted ">{{ \Carbon\Carbon::parse($album->created_at)->diffForHumans() }}</span>

                                                </article>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            @if ($other->albums->count() == 0)
                                <div class="text-center">
                                    <img class="mt-3" src="{{ asset('no.avif') }}"
                                        style="width: 200px;height: 200px;border-radius:50%;" alt="">

                                    <p>No data album.</p>
                                </div>
                            @endif
                        </div>
                    </section>
                    <section class="">
                        <div class="container">

                            <h2 class="mb-4 mt-4">All Photo</h2>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        @forelse ($other->photos as $photo)
                                            <div class="col-lg-4 col-xl-3 col-sm-12 col-md-6"
                                                id="photo{{ $photo->id }}">
                                                <article class="post-grid mb-5">
                                                    <div class="post-thumb mb-4">
                                                        <a href="/postingan/{{ $photo->id }}">
                                                            <img src="{{ asset('storage/' . $photo->location_file) }}"
                                                                alt="" class="img-fluid"
                                                                style="width: 100%;height:200px;object-fit:cover;">
                                                        </a>

                                                    </div>
                                                    <h3 class="post-title mt-1"><a
                                                            href="/postingan/{{ $photo->id }}">{{ $photo->name_photo }}</a>
                                                    </h3>

                                                    <span
                                                        class=" text-muted  text-capitalize">{{ \Carbon\Carbon::parse($photo->created_at)->diffForHumans() }}</span>

                                                </article>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            @if ($other->photos->count() == 0)
                                <div class="text-center">
                                    <img class="mt-3" src="{{ asset('no.avif') }}"
                                        style="width: 200px;height: 200px;border-radius:50%;" alt="">

                                    <p>No data post.</p>
                                </div>
                            @endif
                        </div>
                    </section>


                </div>
            </div>
        </div>
    </section>
@endsection
