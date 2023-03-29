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
                            <label for="">Tipe <sup class="text-danger">*</sup></label>
                            <select name="type" class="form-control">
                                <option value="" {{ request()->type == '' ? 'selected' : '' }}>Teks Biasa
                                </option>
                                <option value="https://" {{ request()->type == 'https://' ? 'selected' : '' }}>Link
                                </option>
                                <option value="mailto:" {{ request()->type == 'mailto:' ? 'selected' : '' }}>Email
                                </option>
                                <option value="tel:" {{ request()->type == 'tel:' ? 'selected' : '' }}>Nomor Telepon
                                </option>
                                <option value="sms:" {{ request()->type == 'sms:' ? 'selected' : '' }}>SMS</option>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="">Konten <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" name="data" maxlength="256"
                                placeholder="Maksimal 256 Karakter"
                                value="{{ request()->data != null ? request()->data : '' }}" required>
                            @error('data')
                                <span class="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="">Logo</label>
                            <input type="file" class="form-control" name="logo" accept="image/*">
                        </div>
                        <div class="form-group text-center mt-3">
                            <button class="btn btn-primary">Generate !</button>
                            <a href="/" class="btn btn-danger">Reset</a>
                        </div>
                    </form>
                    <div class="mt-4 text-center">
                        @if ($filename)
                            {{-- @if ($image != null) --}}
                            <img src="{{ asset($filename) }}">
                            {{-- <img src="data:image/png;base64, {!! $qr !!} "> --}}
                            {{-- @else
                                <img src="{{ asset($filename) }}">
                            @endif --}}
                            <div class="text-center">
                                <a href="{{ asset($filename) }}" class="btn btn-primary mt-3" download>Download</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
</body>

</html>
