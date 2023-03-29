<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Image;

class GeneratorController extends Controller
{
    private $filename;
    function index($data = null)
    {
        //     if($data != NULL){
        //         $qr = $this->generate($data);
        //     }
        return view('generator');
    }

    function generate(Request $request, $data = NULL)
    {
        $data = $request->data;
        $image = $request->file('logo');

        if ($data != NULL) {
            if ($image != NULL) {
                $this->uploadLogo($image);
                $qr = QrCode::size(200)
                    ->format('png')
                    ->errorCorrection('H')
                    ->merge(public_path() . "/logo/$this->filename", .3, true)
                    ->generate($data);
                $qr = base64_encode($qr);
            } else {
                $qr = QrCode::size(200)
                    ->generate($data);
            }
        } else {
            $qr = NULL;
        }
        return view('generator', compact('qr', 'image'));
    }

    function saveGeneratedQRCode()
    {
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
