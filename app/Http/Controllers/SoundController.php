<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Complaint;
use App\Models\Sound;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SoundController extends Controller
{
    public function searchByCategory(Request $request, $id = 0) {
        $sound = Sound::where('category_id', $request->id)
            ->where('is_available', 1)
            ->get();
        if($sound->isEmpty()) {
            $request->session()->flash('response', 'В этой категории файлы не найдены!');
            return redirect()->back();
        }
        return view('search', compact('sound'));
    }

    public function searchByName(Request $request) {
        $sound = Sound::where('name', 'like', $request->sound . '%')
            ->where('is_available', 1)
            ->get();
        if($sound->isEmpty()) {
            $request->session()->flash('response', 'Файл не найден!');
            return redirect()->back();
        }
        return view('search', compact('sound'));
    }

    public function allCategories() {
        $categories = Category::all();
        return view('main', compact('categories'));
    }

    public function addSound(Request $request) {
        $validator = Validator::make($request->all(), [
            'newSound' => 'required|mimes:mp3,WAV|max:10000',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($request->hasFile('newSound')) {
        DB::table('sounds')->insert([
            'name' => $request->name,
            'path' => $request->file('newSound')->store('storage'),
            'category_id' => $request->category_id
        ]);
        $request->session()->flash('response', 'Успешно отправлено на проверку!');
        return redirect('/main');
        } else {
            $request->session()->flash('response', 'Добавьте файл пожалуйста!');
            return redirect()->back();
        }
    }

    public function complaint(Request $request) {
        $complaint = new Complaint();
        $complaint->reason = $request->reason;
        $complaint->complaint = $request->complaint;
        $complaint->save();
        $request->session()->flash('response', 'Жалоба отправлена!');
        return redirect()->back();
    }
}
