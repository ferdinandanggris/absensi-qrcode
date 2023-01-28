<?php

namespace App\Http\Controllers\Test;
use QrCode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    //

    public function index(){
        return view('test-qrcode.index');
    }

    public function store(Request $request){
        $qrcode = QrCode::size(300)->generate(json_encode($request->all()));
        return response($qrcode,200);
    }

}
