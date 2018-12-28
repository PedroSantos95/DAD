<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\RedirectResponse;
use App\User;

class UserController extends Controller
{
    
	public function confirmRegist($id) {
		$user = User::findOrFail($id);
		
		if ($user->email_verified_at == null) {
            /*CREATE VIEW - EM FALTA */
			return view("")->with('user', $user);
		}

		return redirect('/');
	}

}
