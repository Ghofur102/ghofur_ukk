<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- izitoastr css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css">
</head>

<body>
    <div class="d-flex justify-content-center mt-5">
        <div class="card" style="width: 24rem;">
            <div class="card-title">
                <h3 class="p-2">Forgot Password</h3>
            </div>
            <div class="card-body">
                <form action="/forgot-password" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" name="email"
                            class="@error('email') is-invalid @enderror" placeholder="name@gmail.com">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary border border-white" style="background-color: #ce8460;"
                            type="submit">Send Email</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <a href="/login">
                    <button type="button" class="btn btn-secondary">Back</button>
                </a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!-- izitoast js -->
    <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>
    <script>
        @if (session('error'))
            iziToast.error({
                title: 'Error!',
                message: "{{ session('error') }}",
                position: 'topCenter'
            });
        @endif
        @if (session('email'))
            iziToast.error({
                title: 'Error!',
                message: "{{ session('email') }}",
                position: 'topCenter'
            });
        @endif
        @if (session('status'))
            iziToast.success({
                message: "{{ session('status') }}",
                position: 'topCenter'
            });
        @endif
    </script>
</body>

</html>
