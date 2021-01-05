<?php

namespace Modules\Kantong\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Modules\Project\Entities\ProjectUser;

class KantongController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $title = "Kantong Belanja";
        $data = ProjectUser::where('user_id', Auth::id())->latest()->paginate(10);
        return view('kantong::index', compact('title', 'data'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(ProjectUser $projectuser)
    {
        Http::post(config('app.ezpay').'transaksi/delete', [
            'payment_code' => $projectuser->payment_code
        ]);

        $projectuser->delete();

        return redirect()->back()->with('success', "Projek berhasil masuk ke kantong Anda. ");
    }
}
