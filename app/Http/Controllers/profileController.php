<?php

namespace App\Http\Controllers;
use App\Models\metadata;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

class profileController extends Controller
{
    function index()
    {
        return view('dashboard.profile.index');
    }

    function update(Request $request)
    {
        $request->validate([
            '_foto' => 'mimes:jpeg,jpg,png,gif',
            '_email' => 'required|email',
        ],[
            '_foto.mimes' => 'Foto yang dimasukkan hanya diperbolehkan berkestensi JPEG, JPG, PNG, dan GIF',
            '_email.required' => 'Email wajib diisi',
            '_email.email' => 'Format email yang dimasukkan tidak valid'
        ]);

        if ($request->hasfile('_foto')) {
            $foto_file = $request->file('_foto');
            $foto_ekstensi = $foto_file->extension();
            $foto_baru = date('ymdhis') . ".$foto_ekstensi";
            $foto_file->move(public_path('foto'), $foto_baru);

            //kalau ada update foto
            $foto_lama = get_meta_value('_foto');
            File::delete(public_path('foto') . "/" .$foto_lama);


            metadata::updateOrCreate(['meta_key'=> '_foto'],['meta_value'=>$foto_baru]);
        }

        metadata::updateOrCreate(['meta_key'=> '_email'],['meta_value'=>
        $request->_email]);
        metadata::updateOrCreate(['meta_key'=> '_kota'],['meta_value'=>
        $request->_kota]);
        metadata::updateOrCreate(['meta_key'=> '_provinsi'],['meta_value'=>
        $request->_provinsi]);
        metadata::updateOrCreate(['meta_key'=> '_NoHp'],['meta_value'=>
        $request->_NoHp]);

        metadata::updateOrCreate(['meta_key'=> '_instagram'],['meta_value'=>
        $request->_instagram]);
        metadata::updateOrCreate(['meta_key'=> '_twitter'],['meta_value'=>
        $request->_twitter]);
        metadata::updateOrCreate(['meta_key'=> '_Linkedin'],['meta_value'=>
        $request->_Linkedin]);

        return redirect()->route('profile.index')->with('Success', 'Berhasil update data profile');
    }
}
