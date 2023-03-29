<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Image;

class GeneratorController extends Controller
{
    private $filename;
    function index()
    {
        return view('generator');
    }

    function generate(Request $request, $data = NULL)
    {
        $data = $request->data;
        $type = $request->type;
        $image = $request->file('logo');

        $filenameNoLogo = 'qr/qr' . ltrim(\Carbon\Carbon::today()->toDateString()) . '.png';
        if ($data != NULL) {
            if ($image != NULL) {
                $this->uploadLogo($image);
                $qr = QrCode::size(200)
                    ->format('png')
                    ->errorCorrection('H')
                    ->merge(public_path() . "/logo/$this->filename", .3, true)
                    ->generate("$type:$data", "$filenameNoLogo");
                $qr = base64_encode($qr);
            } else {
                $qr = QrCode::encoding('UTF-8')->size(200)->format('png')
                    ->generate("$type:$data", $filenameNoLogo);
            }
        } else {
            $qr = NULL;
        }
        $this->filename = $filenameNoLogo;
        $filename = $this->filename;
        return view('generator', compact('qr', 'image', 'filename'));
    }

    function uploadLogo($image)
    {
        $this->filename = $image->getClientOriginalName();

        $image->move(public_path() . 'logo_temp/', $this->filename);
        $image_compressed = Image::make(public_path() . 'logo_temp/' . $this->filename);
        $image_compressed->save('logo/' . $this->filename);
        // unlink('public/logo_temp/' . $this->filename);
    }
}