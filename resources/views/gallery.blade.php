@extends('layout.app')
@section('content')
    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                        <h2 class="lg-title">Your Gallery</h2>
                    </div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modalposting">
                        Posting Anything
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalposting" data-bs-backdrop="static" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fs-5" id="exampleModalLabel">Modal Posting</h5>
                                </div>
                                <div class="modal-body">
                                    <form id="contact-form" action="{{ route('store.photo') }}"
                                        enctype="multipart/form-data" method="POST" class="contact-form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="name_photo">Title</label>
                                                    <input class="form-control form-control-name" name="name_photo"
                                                        id="name_photo" value="{{ old('name_photo') }}" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <label for="location_file">Photo</label>
                                                    <input class="form-control form-control-name" name="location_file"
                                                        id="location_file" type="file">
                                                </div>
                                                <div class="form-group">
                                                    <label for="description_photo">Description</label>
                                                    <textarea class="form-control form-control-name" name="description_photo" id="description_photo" cols="15"
                                                        rows="5">{{ old('description_photo') }}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="album_id">Albums</label>
                                                    <select name="album_id" id="album_id" class="form-control">
                                                        <option value="">select your album</option>
                                                        @forelse (Auth::user()->albums as $album)
                                                            <option value="{{ $album->id }}">{{ $album->name_album }}
                                                            </option>
                                                        @empty
                                                            <option value="">tidak ada album</option>
                                                        @endforelse
                                                    </select>
                                                </div>

                                                <button class="btn btn-primary solid blank mt-3"
                                                    type="submit">Upload</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup
                                        Modal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        @forelse (Auth::user()->photos as $photo)
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

                                    <div class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                            onclick="confirmation_delete({{ $photo->id }})" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5q0-.425.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5q0 .425-.288.713T19 6v13q0 .825-.587 1.413T17 21zm3-4q.425 0 .713-.288T11 16V9q0-.425-.288-.712T10 8q-.425 0-.712.288T9 9v7q0 .425.288.713T10 17m4 0q.425 0 .713-.288T15 16V9q0-.425-.288-.712T14 8q-.425 0-.712.288T13 9v7q0 .425.288.713T14 17" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                            data-bs-toggle="modal" data-bs-target="#editphoto{{ $photo->id }}"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M4 14v-2h7v2zm0-4V8h11v2zm0-4V4h11v2zm9 14v-3.075l6.575-6.55l3.075 3.05L16.075 20zm6.575-5.6l.925-.975l-.925-.925l-.95.95z" />
                                        </svg>

                                        <!-- Modal -->
                                        <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"
                                            id="editphoto{{ $photo->id }}" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fs-5" id="staticBackdropLabel">Modal Edit
                                                            Photo
                                                        </h5>

                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('update.photo', $photo->id) }}"
                                                            method="POST" class="contact-form">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="name_photo">Title</label>
                                                                        <input class="form-control form-control-name"
                                                                            name="name_photo" id="name_photo"
                                                                            value="{{ $photo->name_photo }}"
                                                                            type="text">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="description_photo">Description</label>
                                                                        <textarea class="form-control form-control-name" name="description_photo" id="description_photo" cols="15"
                                                                            rows="5">{{ $photo->description_photo }}</textarea>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="album_id">Albums</label>
                                                                        <select name="album_id" id="album_id"
                                                                            class="form-control">
                                                                            <option value="">select your album
                                                                            </option>
                                                                            @forelse (Auth::user()->albums as $album)
                                                                                <option value="{{ $album->id }}"
                                                                                    {{ $photo->album_id === $album->id ? 'selected' : '' }}>
                                                                                    {{ $album->name_album }}
                                                                                </option>
                                                                            @empty
                                                                                <option value="">tidak ada album
                                                                                </option>
                                                                            @endforelse
                                                                        </select>
                                                                    </div>

                                                                    <button class="btn btn-primary solid blank mt-3"
                                                                        type="submit">Update</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup Modal</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
            @if (Auth::user()->photos->count() == 0)
            <div class="text-center">
                <img class="mt-3" src="{{ asset('no.avif') }}" style="width: 200px;height: 200px;border-radius:50%;" alt="">

                <p>No data post.</p>
            </div>
            @endif
            <div id="no-data">

            </div>

        </div>
    </section>
    <script>
        function confirmation_delete(id) {
            iziToast.destroy();
            iziToast.question({
                timeout: 20000,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                title: 'Hey',
                message: 'Are you sure delete your photo?',
                position: 'center',
                buttons: [
                    ['<button><b>YES</b></button>', function(instance, toast) {
                        $.ajax({
                            method: 'DELETE',
                            url: '/delete-photo/' + id,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                if (data.success) {
                                    $('#photo' + id).css('display', 'none');
                                    iziToast.success({
                                        title: 'Success!',
                                        message: "berhasil menghapus postingan.",
                                        position: 'topCenter'
                                    });
                                    if (data.count == 0) {
                                        location.reload();
                                    }
                                }
                            }
                        })
                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');

                    }, true],
                    ['<button>NO</button>', function(instance, toast) {

                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');

                    }],
                ],
                onClosing: function(instance, toast, closedBy) {
                    console.info('Closing | closedBy: ' + closedBy);
                },
                onClosed: function(instance, toast, closedBy) {
                    console.info('Closed | closedBy: ' + closedBy);
                }
            });

        }
    </script>
@endsection
