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
        $style = $request->style;
        $color = $request->color;
        $image = $request->file('logo');

        //pecah kode hex warna menjadi rgb
        list($r, $g, $b) = sscanf($color, "#%02x%02x%02x");
        //bikin nama file qr yang tanpa logo
        $generatedFilename = 'qr/qr' . ltrim(\Carbon\Carbon::today()->toDateString()) . '.png';
        //nilai yang akan dicek diview apakah sudah pernah melakukan generate atau belum
        $state = 0;

        if ($data != NULL) {
            //jika menggunakan logo
            if ($image != NULL) {
                $this->uploadLogo($image);
                $qr = QrCode::size(500)
                    ->format('png')
                    ->encoding('UTF-8')
                    ->style($style)
                    ->margin(1)
                    ->color($r, $g, $b)
                    ->errorCorrection('H')
                    ->merge(public_path() . "/logo/$this->filename", .3, true)
                    ->generate($type . $data, $generatedFilename);
                $qr = base64_encode($qr);
            } else {
                $qr = QrCode::encoding('UTF-8')
                    ->size(500)
                    ->color($r, $g, $b)
                    ->format('png')
                    ->margin(1)
                    ->style($style)
                    ->errorCorrection('H')
                    ->generate($type . $data, $generatedFilename);
            }
            //ubah state menjadi 1 artinya sudah menggenerate
            $state = 1;
        } else {
            $qr = NULL;
        }
        $this->filename = $generatedFilename;
        $filename = $this->filename;
        return view('generator', compact('qr', 'filename', 'state'));
    }

    function uploadLogo($image)
    {
        $this->filename = $image->getClientOriginalName();

        $image->move('logo_temp/', $this->filename);
        $image_compressed = Image::make('logo_temp/' . $this->filename);
        $image_compressed->save('logo/' . $this->filename);
        unlink('logo_temp/' . $this->filename);
    }
}
