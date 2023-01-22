<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->all();
        $name = $input['query'];
        $users = User::select('id', 'name')->where('name', 'like', '%' . $name. '%')->get();
        return response()->json($users);
    }
}
