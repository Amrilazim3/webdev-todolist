<?php

use App\Models\Todo;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Termwind\Components\Raw;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $todos = Todo::select(['id', 'user_id', 'task', 'is_completed'])
            ->where('user_id', auth()->user()->id)
            ->get();

        return Inertia::render('Dashboard', [
            'todos' => $todos
        ])
            ->with('jetstream.flash.banner', session()->get('jetstream.flash.banner'))
            ->with('jetstream.flash.bannerStyle', session()->get('jetstream.flash.bannerStyle'));;
    })->name('dashboard');

    Route::post('dashboard', function (Request $request) {
        $request->validate([
            'task' => ['required']
        ]);

        $user = $request->user();

        Todo::create([
            'user_id' => $user->id,
            'task' => $request->task,
        ]);

        $request->session()->flash('jetstream.flash.banner', 'New todo added.');
        $request->session()->flash('jetstream.flash.bannerStyle', 'success');

        return redirect()->route('dashboard');
    })->name('dashboard.post');

    Route::delete('dashboard/{todo}', function (Todo $todo, Request $request) {
        $todo->delete();

        $request->session()->flash('jetstream.flash.banner', 'Task deleted.');
        $request->session()->flash('jetstream.flash.bannerStyle', 'success');

        return redirect()->route('dashboard');
    });

    Route::patch('dashboard/{todo}', function (Todo $todo, Request $request) {
        if ($request->isCompleted) {
            $todo->update([
                'is_completed' => false
            ]);
        } else {
            $todo->update([
                'is_completed' => true
            ]);
        }

        return redirect()->route('dashboard');
    });
});
