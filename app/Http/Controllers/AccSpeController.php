<?php

namespace App\Http\Controllers;

use App\Models\AccSpeModel;
use Illuminate\Http\Request;
use App\Models\PointExtModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AccSpeController extends Controller
{
    public function index()
   {
    $data_ext = AccSpeModel::paginate(10);
    return view('asOs.listeASOS', compact('data_ext'));
   }

    public function externePoint()
    {
        return view('asOs/pointageAS');
    }
    public function deleteExt(Request $request)
    {
        $id = $request->input('idSupp');
        $datapers = AccSpeModel::find($id);
        $datapers ->delete();
        //Alert::info('Suppression', 'Personnel supprimer avec succès');
        return redirect('listeAS');
    }

    public function addExt(Request $request)
    {
        $number = mt_rand(1000000000, 9999999999);
        $request['ext_code'] = $number;
        $ext = new AccSpeModel();
        $ext ->extNom = strtoupper($request->input('extNom'));
        $ext ->extPrenom = ucwords(strtolower($request->input('extPrenom')));
        $ext ->ext_code = $number;
        $ext ->extEmail = strtolower($request->input('extEmail'));
        $ext ->extFonc = strtoupper($request->input('extFonc'));
        $ext ->extTel = $request->input('extTel');
        $ext -> save();
        if($ext){
            //Alert::success('Félicitation', 'Personnel ajouter avec succès');
            return redirect('listeAS');
        }else{
            //Alert::error('Erreur', 'Quelque chose s\'est mal passé');
            return redirect('listeAS');
        }
    }

    public function extCodeExists($number)
    {
        return AccSpeModel::whereExtCode($number)->exists();
    }

    public function pointageExt()
    {
        $todayDate = Carbon::now();
        $data = DB ::table('pointage_os_as')
        ->Join('pers_ext', 'pointage_os_as.pointCodeExt', '=', 'pers_ext.ext_code')
        ->select('pers_ext.extNom', 'pers_ext.extPrenom', 'pers_ext.extFonc', 'pointage_os_as.pointCodeExt', 'pointage_os_as.created_at')
        ->whereDate('pointage_os_as.created_at', $todayDate)
        ->get();
        return view('asOs/pointageASOS', compact('data'));
    }

    public function pointageFiltreExt(Request $request)
    {
        $query = DB ::table('pointage_os_as')
        ->Join('pers_ext', 'pointage_os_as.pointCodeExt', '=', 'pers_ext.ext_code')
        ->select('pers_ext.extNom', 'pers_ext.extPrenom', 'pers_ext.extFonc', 'pointage_os_as.pointCodeExt', 'pointage_os_as.created_at');
        $date = $request->date_filter;

        switch ($date) {
            case 'today':
                $query->whereDate('pointage_os_as.created_at', Carbon::today());
                break;
            case 'yesterday':
                $query->whereDate('pointage_os_as.created_at', Carbon::yesterday());
                break;
            case 'this_week':
                $query->whereBetween('pointage_os_as.created_at',[Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()]);
                break;
            case 'last_week':
                $query->whereBetween('pointage_os_as.created_at',[Carbon::now()->subWeek(),Carbon::now()]);
                //$query->whereBetween('pointage_os_as.created_at',Carbon::now()->subWeek()->week);
                break;
            case 'this_month':
                $query->whereMonth('pointage_os_as.created_at',Carbon::now()->month);
                break;
            case 'last_month':
                $query->whereMonth('pointage_os_as.created_at',Carbon::now()->subMonth()->month);
                break;
            case 'this_year':
                $query->whereMonth('pointage_os_as.created_at',Carbon::now()->year);
                break;
            case 'last_year':
                $query->whereMonth('pointage_os_as.created_at',Carbon::now()->subYear()->year);
                break;

        }
        $data = $query->get();
        return view('asOs/pointageASOS', compact('data'));
    }

    public function addExtPoint(Request $request)
    {
        $pointageExt = new PointExtModel();
        $pointageExt ->pointCodeExt = $request->input('persCode');

        if($pointageExt){
            $pointageExt->save();
            //Alert::success('Félicitation', 'Personnel arriver avec succès');
            return redirect('pointAS');
        }else{
            //Alert::error('Erreur', 'Quelque chose s\'est mal passé');
            return redirect('pointAS');
        }
    }

    public function detailExt($id)
    {
        $detail = AccSpeModel::find($id);
        $data = [
            'ext' => $detail,
        ];
        return view('asOs.detailExt', $data);
    }

    public function edit($id)
    {
        $personnel = AccSpeModel::find($id);
        return response()->json([
            'status'=>200,
            'personnel'=>$personnel,
        ]);
    }

    public function updateExt(Request $request)
    {
        $id = $request->input('id');
        $pers = AccSpeModel::find($id);

        $pers->extNom = $request->input('nom');
        $pers->extPrenom = $request->input('prenom');
        $pers->extEmail = $request->input('email');
        $pers->extFonc = $request->input('fonction');
        $pers->extTel = $request->input('contact');

        $pers->update();
        //Alert::success('Modification', 'Personnel modifier avec succès');
        return redirect('listeAS');
    }

    public function carteExt($id)
    {
        $detail = AccSpeModel::find($id);
        $data = [
            'pers' => $detail,
        ];
        return view('asOs.detailExt', $data);
    }

    public function suppPers($id)
    {
        $persn = AccSpeModel::find($id);
        return response()->json([
            'status'=>200,
            'persn'=>$persn,
        ]);
    }

    public function deletePers(Request $request)
    {
        $id = $request->input('idSupp');
        $datapers = AccSpeModel::find($id);
        $datapers ->delete();
        //Alert::info('Suppression', 'Personnel supprimer avec succès');
        return redirect('listeAS');
    }
}
