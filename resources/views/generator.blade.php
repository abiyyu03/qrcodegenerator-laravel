<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container d-flex justify-content-center mt-4">
        <div class="card shadow w-75">
            <div class="card-body">
                <div class="card-title">
                    <h2 class="text-center">QR Code Generator</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('generate')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Some Text or Link</label>
                            <input type="text" class="form-control" name="data" maxlength="256">
                            @error('data')
                                <span class="alert">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group text-center mt-3">
                            <button class="btn btn-primary">Generate</button>
                        </div>
                    </form>
                    <div class="mt-4 text-center">
                        <p>{{request()->data}}</p>
                        {!! $qr !!}
                        {{-- {!! QrCode::size(200)->generate('https://docs.google.com/spreadsheets/d/1Rg0F6zNUFMXRc4E12ZDlpUHI4g3PB-l8ywZNbYVPZqQ/edit#gid=230104751'); !!} --}}
                        {{-- <img src="data:image/png;base64,{!! base64_encode(QrCode::size(200)->format('png')->generate('Hello')); !!}" alt=""> --}}
                    </div>
            </div>
        </div>
    </div>
</body>
</html>