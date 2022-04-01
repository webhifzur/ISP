<?php

namespace App\Http\Controllers;

use App\Models\InvioceModel;
use Illuminate\Http\Request;

class InvioceModelController extends Controller
{
    public function __construct()
    {
        $this->middleware('customerrules', ['except' => ['singleinvioce']]);
    }
   
    public function index()
    {
        return view('pages.admin.invioce', [
            'total_invioce' => InvioceModel::all(),
        ]);
    }

    public function singleinvioce($id)
    {
        return view('pages.singleinvioce', [
            'single_invioces' => InvioceModel::where('id',$id)->first(),
        ]);
    }
}
