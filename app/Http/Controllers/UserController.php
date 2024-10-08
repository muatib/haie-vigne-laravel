<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Form;
class UserController extends Controller
{

    public function account()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $form = Form::where('user_id', $user->id)->first();

            return view('UserAccount', [
                'user' => $user,
                'form' => $form
            ]);
        } else {
            return redirect()->route('login')->with('message', 'Veuillez vous connecter pour accéder à votre compte.');
        }
    }
    public function deleteSelected(Request $request)
{
    $selectedUsers = $request->input('selected_users', []);

    if (empty($selectedUsers)) {
        return redirect()->back()->with('warning', 'Aucun utilisateur n\'a été sélectionné pour la suppression.');
    }

    $deletedCount = User::whereIn('id', $selectedUsers)->delete();

    if ($deletedCount > 0) {
        $message = $deletedCount === 1 ? 'L\'utilisateur a bien été supprimé.' : "$deletedCount utilisateurs ont été supprimés.";
        return redirect()->back()->with('success', $message);
    } else {
        return redirect()->back()->with('warning', 'Aucun utilisateur n\'a pu être supprimé.');
    }
}
}
