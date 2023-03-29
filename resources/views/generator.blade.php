<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edukidos QRCode Generator</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-primary">
    <h2 class="text-center mt-4 text-white">Edukidos QR Code Generator</h2>
    <div class="container d-flex justify-content-center mt-4">
        <div class="card shadow w-75" style="border-radius:30px">
            <div class="card-body shadow">
                <div class="card-title">
                </div>
                <div class="card-body">
                    <form action="{{ route('generate') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Some Text or Link</label>
                            <input type="text" class="form-control" name="data" maxlength="256"
                                value="{{ request()->data != null ? request()->data : '' }}">
                            @error('data')
                                <span class="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Logo</label>
                            <input type="file" class="form-control" name="logo" accept="image/*">
                        </div>
                        <div class="form-group text-center mt-3">
                            <button class="btn btn-primary">Generate !</button>
                            <a href="/" class="btn btn-danger">Reset</a>
                        </div>
                    </form>
                    <div class="mt-4 text-center">
                        {{-- <p>{{ $image }}</p> --}}
                        {{-- <img src="{!! $qr->embedData(QrCode::format('png')->generate('Embed me into an e-mail!'), '/logo/tab.jpeg', 'image/png') !!}"> --}}
                        @if ($image == null)
                            {!! $qr !!}
                        @else
                            <img src="data:image/png;base64, {!! $qr !!} ">
                        @endif
                        {{-- {!! QrCode::size(200)->generate('https://docs.google.com/spreadsheets/d/1Rg0F6zNUFMXRc4E12ZDlpUHI4g3PB-l8ywZNbYVPZqQ/edit#gid=230104751'); !!} --}}
                        {{-- <img src="data:image/png;base64,{!! base64_encode(QrCode::size(200)->format('png')->generate('Hello')); !!}" alt=""> --}}
                    </div>
                </div>
            </div>
        </div>
</body>

</html>
