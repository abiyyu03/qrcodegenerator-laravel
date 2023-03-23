<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GeneratorController extends Controller
{
    // function index($data = null)
    // {
    //     if($data != NULL){
    //         $qr = $this->generate($data);
    //     }
    //     return view('generator',compact('qr'));
    // }

    function generate(Request $request, $data = NULL)
    {
        // $request->validate([
        //     'data' => 'size:256'
        // ]);
        $data = $request->data;
        if($data != NULL){
            $qr = QrCode::size(200)->generate(
                $data
            );
        } else {
            $qr = NULL;
        }
        return view('generator',compact('qr'));
        // return redirect('/');
    }

    function saveGeneratedQRCode()
    {
        
    }
}