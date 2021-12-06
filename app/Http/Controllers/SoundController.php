<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sound;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SoundController extends Controller
{
    public function soundSearch(Request $request) {
        // $sound = Sound::where('name', 'like', $request->sound . "%");

        // if($request->category) {
        // $sound = Sound::where('name', 'like', "$request->category%");
        // }
        $sound = Sound::find(2);
        return view('search', compact('sound'));
    }

    public function addSound(Request $request) {
//        dump(Hash::make("storage/$request->file('newSound')"));
//        dd($request->file('newSound')->store(''));

//        $request->validate([
//            'name' => 'required|mimes:wav,aif,mp3|max:2048',
//            'path' => 'required8',
//            'category_id' => 'required|integer'
//        ]);
        if($request->hasFile('newSound')) {
////        dd($request->file('newSound'));
//        $soundPath = $request->file('newSound')->store('storage');
//        $sound = new Sound();
//        $sound->name = 'test';
//        $sound->path = $soundPath;
//        $sound->category_id = $request->category_id;
//        $sound->save();
        DB::table('sounds')->insert([
            'name' => $request->name,
            'path' => $request->file('newSound')->store('storage'),
            'category_id' => $request->category_id
        ]);
        dump("Added");
        return redirect('/welcome');
        }
    }
}
