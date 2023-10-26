<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisiteurModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class VisiteurController extends Controller
{
    public function visiteur()
    {
        $todayDate = Carbon::now();
        $data = DB ::table('visiteur')
        ->select('visiID','visiNom','nomCIN1','nomCIN2', 'sortie', 'created_at', 'updated_at')
        ->whereDate('created_at', $todayDate)
        ->get();
        return view('visiteur/visiteur', compact('data'));
    }

    public function listeVisiteur()
    {
        return view('visiteur/ajoutvisiteur');
    }

    public function addVisi(Request $request)
    {
        $nomCIN1 = $request->file('photoCIN1')->getClientOriginalName();
        $nomCIN2 = $request->file('photoCIN2')->getClientOriginalName();

        $request->file('photoCIN1')->storeAs('public/images/', $nomCIN1);
        $request->file('photoCIN2')->storeAs('public/images/', $nomCIN2);

        $visi = new VisiteurModel();
        $visi->visiNom = ucwords(strtolower($request->input('visiNom')));
        $visi->nomCIN1 = $nomCIN1;
        $visi->nomCIN2 = $nomCIN2;
        $visi->save();
        return redirect('visiteur');
    }

    public function visiteurFiltre(Request $request)
    {
        $query = DB ::table('visiteur')
        ->select('visiNom', 'visiPrenom', 'visiCIN', 'visiTel', 'visiPers', 'created_at');
        $date = $request->date_filter;

        switch ($date) {
            case 'today':
                $query->whereDate('created_at', Carbon::today());
                break;
            case 'yesterday':
                $query->whereDate('created_at', Carbon::yesterday());
                break;
            case 'this_week':
                $query->whereBetween('created_at',[Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()]);
                break;
            case 'last_week':
                $query->whereBetween('created_at',[Carbon::now()->subWeek(),Carbon::now()]);
                //$query->whereBetween('pointage_os_as.created_at',Carbon::now()->subWeek()->week);
                break;
            case 'this_month':
                $query->whereMonth('created_at',Carbon::now()->month);
                break;
            case 'last_month':
                $query->whereMonth('created_at',Carbon::now()->subMonth()->month);
                break;
            case 'this_year':
                $query->whereMonth('created_at',Carbon::now()->year);
                break;
            case 'last_year':
                $query->whereMonth('created_at',Carbon::now()->subYear()->year);
                break;

        }
        $data = $query->get();
        return view('visiteur/visiteur', compact('data'));
    }

    public function edit($id)
    {
        $visiteur = VisiteurModel::find($id);
        return response()->json([
            'status'=>200,
            'visiteur'=>$visiteur,
        ]);
    }

    public function updateVisi(Request $request)
    {
        $id = $request->input('id');
        $visi = VisiteurModel::find($id);

        $visi->sortie = $request->input('sortie');

        $visi->update();
        //Alert::success('Modification', 'Personnel modifier avec succès');
        return redirect('visiteur');
    }
}
