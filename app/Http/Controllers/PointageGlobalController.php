<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PointExtModel;
use App\Models\PointPersModel;
use App\Http\Controllers\Controller;

class PointageGlobalController extends Controller
{
    public function index()
    {
        return view('pointage/pointage');
    }

    public function addPointGlobal(Request $request)
    {
        $pointagePers = new PointPersModel();
        $pointageExt = new PointExtModel();

        $pointageExt ->pointCodeExt = $request->input('persCode');
        $pointagePers ->pointCodePers = $request->input('persCode');

        if($pointagePers){
            $pointagePers->save();
            $pointageExt->save();
            session()->flash('success', 'Pointage a été ajoutée avec succès.');
            return redirect('pointage');
        }else{
            session()->flash('warning', 'Une erreur se réproduite.');
            return redirect('pointage');
        }
    }
}
