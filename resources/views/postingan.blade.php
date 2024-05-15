@extends('layout.app')
@section('content')
    <section class="">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                    <div class="single-post">
                        <div class="post-header mb-5 text-center">
                            <h2 class="post-title mt-2">
                                {{ $photo->name_photo }}
                            </h2>

                            <div class="post-meta">
                                <span class="text-uppercase font-sm letter-spacing-1 mr-3">by
                                    <a href="/other-profile/{{ $photo->user->id }}">{{ $photo->user->username }}</a></span>
                                <span
                                    class="text-uppercase font-sm letter-spacing-1">{{ \Carbon\Carbon::parse($photo->created_at)->diffForHumans() }}</span>
                            </div>
                            <div class="post-featured-image mt-5">
                                <img src="{{ asset('storage/' . $photo->location_file) }}" class="img-fluid "
                                    alt="featured-image">
                            </div>
                        </div>
                        <div class="post-body">
                            <div class="entry-content">
                                <blockquote>
                                    {{ $photo->description_photo }}
                                </blockquote>

                            </div>

                            <div
                                class="tags-share-box center-box d-flex text-center justify-content-between border-top border-bottom py-3">

                                <span class="single-comment-o"><i class="fa fa-comment-o"></i><span
                                        id="count-comment2">{{ $photo->comments->count() }}</span> comment</span>

                                <div class="post-share d-flex">
                                    <span>{{ $photo->likes->count() }}</span>
                                    @auth
                                        @if ($photo->isLike())
                                            <form action="{{ route('like.photo', $photo->id) }}" method="post">
                                                @csrf
                                                <button
                                                    class="penci-post-like single-like-button border border-white bg-white text-danger"
                                                    type="submit"><i class="ti-heart"></i></button>
                                            </form>
                                        @else
                                            <form action="{{ route('like.photo', $photo->id) }}" method="post">
                                                @csrf
                                                <button class="penci-post-like single-like-button border border-white bg-white"
                                                    type="submit"><i class="ti-heart"></i></button>
                                            </form>
                                        @endif
                                    @else
                                        <form>
                                            <button class="penci-post-like single-like-button border border-white bg-white"
                                                type="button"><i class="ti-heart"></i></button>
                                        </form>
                                    @endauth
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="post-author d-flex my-5">
                        <div class="author-img">
                            @if ($photo->user->photo_profile === null)
                                <a href="/other-profile/{{ $photo->user->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="62" height="62"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M12 11q.825 0 1.413-.588Q14 9.825 14 9t-.587-1.413Q12.825 7 12 7q-.825 0-1.412.587Q10 8.175 10 9q0 .825.588 1.412Q11.175 11 12 11Zm0 2q-1.65 0-2.825-1.175Q8 10.65 8 9q0-1.65 1.175-2.825Q10.35 5 12 5q1.65 0 2.825 1.175Q16 7.35 16 9q0 1.65-1.175 2.825Q13.65 13 12 13Zm0 11q-2.475 0-4.662-.938q-2.188-.937-3.825-2.574Q1.875 18.85.938 16.663Q0 14.475 0 12t.938-4.663q.937-2.187 2.575-3.825Q5.15 1.875 7.338.938Q9.525 0 12 0t4.663.938q2.187.937 3.825 2.574q1.637 1.638 2.574 3.825Q24 9.525 24 12t-.938 4.663q-.937 2.187-2.574 3.825q-1.638 1.637-3.825 2.574Q14.475 24 12 24Zm0-2q1.8 0 3.375-.575T18.25 19.8q-.825-.925-2.425-1.612q-1.6-.688-3.825-.688t-3.825.688q-1.6.687-2.425 1.612q1.3 1.05 2.875 1.625T12 22Zm-7.7-3.6q1.2-1.3 3.225-2.1q2.025-.8 4.475-.8q2.45 0 4.463.8q2.012.8 3.212 2.1q1.1-1.325 1.713-2.95Q22 13.825 22 12q0-2.075-.788-3.887q-.787-1.813-2.15-3.175q-1.362-1.363-3.175-2.151Q14.075 2 12 2q-2.05 0-3.875.787q-1.825.788-3.187 2.151Q3.575 6.3 2.788 8.113Q2 9.925 2 12q0 1.825.6 3.463q.6 1.637 1.7 2.937Z" />
                                    </svg>
                                </a>
                            @else
                                <a href="/other-profile/{{ $photo->user->id }}">
                                    <img src="{{ asset('storage/' . $photo->user->photo_profile) }}" class="my-2"
                                        style="width:80px;height:80px;object-fit:cover;border-radius:50%;"
                                        alt="{{ $photo->user->photo_profile }}">
                                </a>
                            @endif
                        </div>

                        <div class="author-content pl-4">
                            <h4 class="mb-3"><a href="/other-profile/{{ $photo->user->id }}" title=""
                                    rel="author" class="text-capitalize">{{ $photo->user->username }} (Author) </a>
                            </h4>
                            <p>{{ $photo->user->bio }}</p>


                        </div>
                    </div>


                    @if ($other_photo->count() > 1)
                        <div class="related-posts-block mt-5">
                            <h3 class="news-title mb-4 text-center">
                                You May Also Like
                            </h3>
                            <div class="row">

                                @foreach ($other_photo as $item)
                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                        <div class="post-block-wrapper mb-4 mb-lg-0">
                                            <a href="/postingan/{{ $item->id }}">
                                                <img class="img-fluid" src="{{ asset('storage/' . $item->location_file) }}" style="width: 100%; height:200px;object-fit:cover;"
                                                    alt="post-thumbnail" />
                                            </a>
                                            <div class="post-content text-center mt-3">
                                                <h5>
                                                    <a href="/postingan/{{ $item->id }}">{{ $item->name_photo }}</a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    @endif


                    <form class="comment-form mb-5 gray-bg p-5 mt-5" id="comment-form"
                        action="{{ route('store.comment', $photo->id) }}" method="POST">
                        @csrf
                        <h3 class="mb-4 text-center">Leave a comment</h3>
                        <div class="row">
                            <div class="col-lg-12">
                                <textarea class="form-control mb-3" name="content_comment" id="comment" cols="30" rows="5"
                                    placeholder="Comment"></textarea>
                            </div>
                        </div>

                        <input class="btn btn-primary" type="submit" name="submit-contact" id="submit_contact"
                            value="Upload Comment">
                    </form>


                    <div class="comment-area my-5">
                        <h3 class="mb-4 text-center"><span id="count-comment22">{{ $photo->comments->count() }}</span>
                            Comments</h3>
                        @forelse ($photo->comments as $comment)
                            <div class="comment-area-box media" id="comment{{ $comment->id }}">
                                <div class="">

                                    @if ($comment->user->photo_profile === null)
                                        <a href="/other-profile/{{ $comment->user->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="62" height="62"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M12 11q.825 0 1.413-.588Q14 9.825 14 9t-.587-1.413Q12.825 7 12 7q-.825 0-1.412.587Q10 8.175 10 9q0 .825.588 1.412Q11.175 11 12 11Zm0 2q-1.65 0-2.825-1.175Q8 10.65 8 9q0-1.65 1.175-2.825Q10.35 5 12 5q1.65 0 2.825 1.175Q16 7.35 16 9q0 1.65-1.175 2.825Q13.65 13 12 13Zm0 11q-2.475 0-4.662-.938q-2.188-.937-3.825-2.574Q1.875 18.85.938 16.663Q0 14.475 0 12t.938-4.663q.937-2.187 2.575-3.825Q5.15 1.875 7.338.938Q9.525 0 12 0t4.663.938q2.187.937 3.825 2.574q1.637 1.638 2.574 3.825Q24 9.525 24 12t-.938 4.663q-.937 2.187-2.574 3.825q-1.638 1.637-3.825 2.574Q14.475 24 12 24Zm0-2q1.8 0 3.375-.575T18.25 19.8q-.825-.925-2.425-1.612q-1.6-.688-3.825-.688t-3.825.688q-1.6.687-2.425 1.612q1.3 1.05 2.875 1.625T12 22Zm-7.7-3.6q1.2-1.3 3.225-2.1q2.025-.8 4.475-.8q2.45 0 4.463.8q2.012.8 3.212 2.1q1.1-1.325 1.713-2.95Q22 13.825 22 12q0-2.075-.788-3.887q-.787-1.813-2.15-3.175q-1.362-1.363-3.175-2.151Q14.075 2 12 2q-2.05 0-3.875.787q-1.825.788-3.187 2.151Q3.575 6.3 2.788 8.113Q2 9.925 2 12q0 1.825.6 3.463q.6 1.637 1.7 2.937Z" />
                                            </svg>
                                        </a>
                                    @else
                                        <a href="/other-profile/{{ $comment->user->id }}">
                                            <img src="{{ asset('storage/' . $comment->user->photo_profile) }}"
                                                class="my-2"
                                                style="width:80px;height:80px;object-fit:cover;border-radius:50%;"
                                                alt="{{ $comment->user->photo_profile }}">
                                        </a>
                                    @endif

                                </div>

                                <div class="media-body ml-4">
                                    <h4 class="mb-0"> <a href="/other-profile/{{ $comment->user->id }}">
                                            {{ $comment->user->username }}</a> </h4>
                                    <span class="date-comm font-sm text-capitalize text-color"><i
                                            class="ti-time mr-2"></i>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}
                                    </span>

                                    <div class="comment-content mt-3">
                                        <p>{{ $comment->content_comment }}</p>
                                    </div>
                                    <div class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                            onclick="confirmation_delete({{ $comment->id }})" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M7 21q-.825 0-1.412-.587T5 19V6q-.425 0-.712-.288T4 5q0-.425.288-.712T5 4h4q0-.425.288-.712T10 3h4q.425 0 .713.288T15 4h4q.425 0 .713.288T20 5q0 .425-.288.713T19 6v13q0 .825-.587 1.413T17 21zm3-4q.425 0 .713-.288T11 16V9q0-.425-.288-.712T10 8q-.425 0-.712.288T9 9v7q0 .425.288.713T10 17m4 0q.425 0 .713-.288T15 16V9q0-.425-.288-.712T14 8q-.425 0-.712.288T13 9v7q0 .425.288.713T14 17" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                            data-bs-toggle="modal" data-bs-target="#editalbum{{ $comment->id }}"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M4 14v-2h7v2zm0-4V8h11v2zm0-4V4h11v2zm9 14v-3.075l6.575-6.55l3.075 3.05L16.075 20zm6.575-5.6l.925-.975l-.925-.925l-.95.95z" />
                                        </svg>

                                        <!-- Modal -->
                                        <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"
                                            id="editalbum{{ $comment->id }}" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fs-5" id="staticBackdropLabel">Modal Edit
                                                            Komentar
                                                        </h5>

                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('update.comment', $comment->id) }}"
                                                            method="POST" class="contact-form">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row">
                                                                <div class="col-md-12">

                                                                    <div class="form-group">
                                                                        <label for="content_comment">Content
                                                                            Comment</label>
                                                                        <textarea class="form-control form-control-name" name="content_comment" id="content_comment" cols="15"
                                                                            rows="5">{{ $comment->content_comment }}</textarea>
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
                                </div>
                            </div>
                        @empty
                            <div class="" style="text-align: center;">
                                <img class="mt-3" src="{{ asset('no.avif') }}"
                                    style="width: 200px;height: 200px;border-radius:50%;" alt="">

                                <p>No comments.</p>
                            </div>
                        @endforelse
                        <div id="no-data"></div>
                    </div>

                </div>
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
                message: 'Are you sure delete your comment?',
                position: 'center',
                buttons: [
                    ['<button><b>YES</b></button>', function(instance, toast) {
                        $.ajax({
                            method: 'DELETE',
                            url: '/delete-comment/' + id,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                if (data.success) {
                                    $('#comment' + id).css('display', 'none');
                                    let count = parseInt($('#count-comment2').text()) - 1;
                                    $("#count-comment2").html(count);
                                    $("#count-comment22").html(count);
                                    if (count == 0) {
                                        $('#no-data').html(`
                                        <div class="" style="text-align: center;">
                                <img class="mt-3" src="{{ asset('no.avif') }}"
                                    style="width: 200px;height: 200px;border-radius:50%;" alt="">

                                <p>No comments.</p>
                            </div>
                                        `);
                                    }

                                    iziToast.success({
                                        title: 'Success!',
                                        message: "berhasil menghapus komentar.",
                                        position: 'topCenter'
                                    });
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
