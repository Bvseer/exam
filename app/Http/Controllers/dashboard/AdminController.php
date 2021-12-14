<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Complaint;
use App\Models\Sound;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function showDashboard() {
        $sounds = Sound::with('category')->get();
        $categories = Category::all();
        return view('Dashboard.dashboard', compact('sounds', 'categories'));
    }

    public function action(Request $request) {
        if($request->action == 'delete') {
        $sound = Sound::find($request->id);
        Storage::disk('storage')->delete($sound->path);
        $sound->delete();
        dd($sound);
        $request->session()->flash('response',  'Успешно удалено');
        return redirect()->back();
        }
        if($request->action == 'approve') {
            $sound = Sound::find($request->id);
            $sound->is_available = 1;
            $sound->save();
            $request->session()->flash('response',  'Успешно одобрено');
            return redirect()->back();
        }
        if($request->action == 'change') {
            $sound = Sound::find($request->sound_id);
            $sound->category_id = $request->category;
            $sound->save();
            $request->session()->flash('response', 'Категория успешно обновлена');
            return redirect()->back();
        }
    }

    public function showComplaints() {
        $complaints = Complaint::where('is_viewed', 0)->get();
        return view('Dashboard.complaints', compact('complaints'));
    }
    public function showAllComplaints() {
        $complaints = Complaint::all();
        return view('Dashboard.allcomplaints', compact('complaints'));
    }
    public function actionComplaints(Request $request) {
        $complaint = Complaint::find($request->id);
        if($request->action == 'edit') {
            $complaint->is_viewed = 1;
            $complaint->save();
            $request->session()->flash('response', 'Помечено как прочитанное!');
            return redirect()->back();
        }
        if($request->action == 'delete') {
            $complaint->delete();
            $request->session()->flash('response', 'Успешно удалено!');
            return redirect()->back();
        }
    }

    public function showCategories() {
        $categories = Category::all();
        return view('Dashboard.categories', compact('categories'));
    }
    public function actionCategories(Request $request) {
        if($request->action == 'add') {
            Category::create([
            'name' => Str::title($request->category)
            ]);
            $request->session()->flash('response', 'Категория добавлена!');
            return redirect()->back();
        }
        if($request->action == 'delete') {
            $sounds = Sound::where('category_id', $request->id)->get();
            foreach ($sounds as $s){
                 Storage::disk('storage')->delete($s->path);
            }
            $category = Category::find($request->id)->delete();
            $request->session()->flash('response', 'Категория удалена!');
            return redirect()->back();
        }
    }

    public function showUsers() {
        $users = User::all();
        return view('Dashboard.users', compact('users'));
    }
    public function actionUsers(Request $request) {
        $user = User::find($request->id);
        if($request->action == 'unblock') {
            $user->is_blocked = 0;
            $user->save();
            $request->session()->flash('response', 'Пользователь разблокирован');
            return redirect()->back();
        }
        if($request->action == 'block') {
            $user->is_blocked = 1;
            $user->save();
            $request->session()->flash('response', 'Пользователь заблокирован');
            return redirect()->back();
        }
        if($request->action == 'delete') {
            $user->delete();
            $request->session()->flash('response', 'Пользователь удален');
            return redirect()->back();
        }
    }
    public function addUsers() {
        return view('Dashboard.addusers');
    }
    public function addUser(Request $request) {
        $validator = Validator::make($request->all(),
        [
            'name' => ['required','min:2'],
            'email' => ['required','min:5', 'unique:users,email'],
            'password' => ['required','min:8'],
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($request->is_admin == 'on') {
            $is_admin = 1;
        } else {
            $is_admin = 0;
        }
//        dd($is_admin);
        User::create([
            'is_admin' => $is_admin,
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $request->session()->flash('response', 'Пользователь добавлен');
        return redirect()->back();
    }
}
