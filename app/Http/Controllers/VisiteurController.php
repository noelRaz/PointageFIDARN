<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisiteurModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class VisiteurController extends Controller
{
    public function visiteur()
    {
        $todayDate = Carbon::now();
        $data = DB ::table('visiteur')
        ->select('visiNom', 'visiPrenom', 'visiCIN', 'visiTel', 'visiPers', 'created_at')
        ->whereDate('created_at', $todayDate)
        ->get();
        return view('visiteur/visiteur', compact('data'));
        //return view('visiteur.visiteur');
    }

    public function listeVisiteur()
    {
        return view('visiteur/ajoutvisiteur');
    }

    public function addVisi(Request $request)
    {
        $visi = new VisiteurModel();
        $visi ->visiNom = $request->input('visiNom');
        $visi ->visiPrenom = $request->input('visiPrenom');
        $visi ->visiCIN = $request->input('visiCIN');
        $visi ->visiTel = $request->input('visiTel');
        $visi ->visiPers = $request->input('visiPers');

        if($visi){
            $visi -> save();
            // Alert::success('Félicitation', 'Visiteur ajouter avec succès');
            return redirect('visiteur');
        }else{
            // Alert::error('Erreur', 'Quelque chose s\'est mal passé');
            return redirect('visiteur');
        }
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
}
