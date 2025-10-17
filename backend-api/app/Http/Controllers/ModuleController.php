<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModulesRequest;
use App\Http\Requests\UpdateModulesRequest;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('modules')->get(['id', 'name', 'description']);

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $modules)
    {
        //
    }
}
