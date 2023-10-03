<?php

namespace App\Http\Controllers;

use App\Models\PersModel;
use Illuminate\Http\Request;
use App\Models\PointPersModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\View\Components\Alert;
use App\Http\Controllers\Controller;

class PersController extends Controller
{

    public function index()
    {
        $data = PersModel::all();
        return view('personnel/listePers', compact('data'));
    }

    public function pointagePers()
    {
        $todayDate = Carbon::now();
        $data = DB ::table('pointage_pers')
        ->Join('pers', 'pointage_pers.pointCodePers', '=', 'pers.pers_code')
        ->select('pers.persNom', 'pers.persPrenom', 'pers.persFonc', 'pointage_pers.pointCodePers', 'pointage_pers.created_at')
        ->whereDate('pointage_pers.created_at', $todayDate)
        ->get();
        return view('personnel/pointagePers', compact('data'));
    }

    public function pointageFiltrePers(Request $request)
    {
        $query = DB ::table('pointage_pers')
        ->Join('pers', 'pointage_pers.pointCodePers', '=', 'pers.pers_code')
        ->select('pers.persNom', 'pers.persPrenom', 'pers.persFonc', 'pointage_pers.pointCodePers', 'pointage_pers.created_at');
        $date = $request->date_filter;

        switch ($date) {
            case 'today':
                $query->whereDate('pointage_pers.created_at', Carbon::today());
                break;
            case 'yesterday':
                $query->whereDate('pointage_pers.created_at', Carbon::yesterday());
                break;
            case 'this_week':
                $query->whereBetween('pointage_pers.created_at',[Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()]);
                break;
            case 'last_week':
                $query->whereBetween('pointage_pers.created_at',[Carbon::now()->subWeek(),Carbon::now()]);
                //$query->whereBetween('pointage_pers.created_at',Carbon::now()->subWeek()->week);
                break;
            case 'this_month':
                $query->whereMonth('pointage_pers.created_at',Carbon::now()->month);
                break;
            case 'last_month':
                $query->whereMonth('pointage_pers.created_at',Carbon::now()->subMonth()->month);
                break;
            case 'this_year':
                $query->whereMonth('pointage_pers.created_at',Carbon::now()->year);
                break;
            case 'last_year':
                $query->whereMonth('pointage_pers.created_at',Carbon::now()->subYear()->year);
                break;

        }
        $data = $query->get();
        return view('personnel/pointagePers', compact('data'));
    }

    public function addPers(Request $request)
    {
        //$this->attributes['titre'] = ucwords(strtolower($value));

        $number = mt_rand(1000000000, 9999999999);
        $request['pers_code'] = $number;
        $pers = new PersModel();
        $pers ->persNom = strtoupper($request->input('persNom'));
        $pers ->persPrenom = ucwords(strtolower($request->input('persPrenom')));
        $pers ->pers_code = $number;
        $pers ->persEmail = strtolower($request->input('persEmail'));
        $pers ->persFonc = $request->input('persFonc');
        $pers ->persTel = $request->input('persTel');
        $pers -> save();
        if($pers){
            //Alert::success('Félicitation', 'Personnel ajouter avec succès');
            return redirect('listepersonnel');
        }else{
            //Alert::error('Erreur', 'Quelque chose s\'est mal passé');
            return redirect('listepersonnel');
        }
    }

    public function edit($id)
    {
        $personnel = PersModel::find($id);
        return response()->json([
            'status'=>200,
            'personnel'=>$personnel,
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $pers = PersModel::find($id);

        $pers->persNom = $request->input('nom');
        $pers->persPrenom = $request->input('prenom');
        $pers->persEmail = $request->input('email');
        $pers->persFonc = $request->input('fonction');
        $pers->persTel = $request->input('contact');

        $pers->update();
        //Alert::success('Modification', 'Personnel modifier avec succès');
        return redirect('listepersonnel');
    }

    public function suppPers($id)
    {
        $persn = PersModel::find($id);
        return response()->json([
            'status'=>200,
            'persn'=>$persn,
        ]);
    }

    public function deletePers(Request $request)
    {
        $id = $request->input('idSupp');
        $datapers = PersModel::find($id);
        $datapers ->delete();
        //Alert::info('Suppression', 'Personnel supprimer avec succès');
        return redirect('listepersonnel');
    }

    public function cartePers($id)
    {
        $detail = PersModel::find($id);
        $data = [
            'pers' => $detail,
        ];
        return view('personnel.detailPers', $data);
    }

    public function addPointPers(Request $request)
    {
        $pointage = new PointPersModel();
        $pointage ->pointCodePers = $request->input('persCode');

        if($pointage){
            $pointage->save();
            // Alert::success('Félicitation', 'Personnel arriver avec succès');
            return redirect('pointpersonnel');
        }else{
            // Alert::error('Erreur', 'Quelque chose s\'est mal passé');
            return redirect('pointpersonnel');
        }
    }

}
