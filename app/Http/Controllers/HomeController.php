<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Modules\CaraKerja\Entities\Way;
use Modules\Project\Entities\Project;
use Modules\Project\Entities\ProjectUser;
use Modules\Slider\Entities\Slider;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        return view('home', compact('widget'));
    }

    public function homepage()
    {
        $sliders = Slider::all();
        $projects = Project::where('status_id', 1)->inRandomOrder()->take(3)->get();
        $ways = Way::all();
        return view('layouts.home', compact('sliders', 'projects', 'ways'));
    }

    public function project()
    {
        $projects = Project::where('status_id', 1)->inRandomOrder()->get();
        return view('layouts.project', compact('projects'));
    }

    public function project_detail(Project $project)
    {
        return view('layouts.project_detail', compact('project'));
    }

    public function project_beli(Project $project)
    {
        $p = new ProjectUser();
        $p->project_id = $project->id;
        $p->user_id = Auth::id();
        $p->price = $project->price;
        $p->save();
        $p->payment_code = "TBR-". Auth::id() ."-". Str::slug(Auth::user()->name) ."-". $p->id;
        $p->save();

        Http::post(config('app.ezpay').'transaksi', [
            'payment_code' => $p->payment_code,
            'price' => $p->price,
            'email' => Auth::user()->email,
            'catatan' => "Pembayaran untuk " . $p->project->name
        ]);

        return redirect()->back()->with('success', "Projek berhasil masuk ke kantong Anda. ");
        // return redirect()->back()->with('success', env('SITE_EZPAY', "http://localhost:8001").'/transaksi');
    }
}
