<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UtilisateurController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('utilisateur/utilisateur', compact('data'));
    }

    // public function deleteUser($id)
    // {
    //     $datapers = User::find($id);
    //     $datapers ->delete();
    //     //Alert::info('Suppression', 'Utilisateur supprimer avec succès');
    //     return redirect('utilisateur');
    // }

    public function suppUser($id)
    {
        $persn = User::find($id);
        return response()->json([
            'status'=>200,
            'persn'=>$persn,
        ]);
    }

    public function deleteUser(Request $request)
    {
        $id = $request->input('idSupp');
        $datapers = User::find($id);
        $datapers ->delete();
        //Alert::info('Suppression', 'Personnel supprimer avec succès');
        return redirect('utilisateur');
    }

    public function editUser($id)
    {
        $personnel = User::find($id);
        return response()->json([
            'status'=>200,
            'personnel'=>$personnel,
        ]);
    }

    public function updateUser(Request $request)
    {
        $id = $request->input('id');
        $pers = User::find($id);

        $pers->admin = $request->input('admin');
        $pers->role = $request->input('role');

        $pers->update();
        //Alert::success('Modification', 'Personnel modifier avec succès');
        return redirect('utilisateur');
    }
}
