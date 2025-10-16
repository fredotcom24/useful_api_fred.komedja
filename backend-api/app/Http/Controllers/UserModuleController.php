<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserModuleRequest;
use App\Http\Requests\UpdateUserModuleRequest;
use App\Models\Module;
use App\Models\UserModule;
use Illuminate\Http\Request;

class UserModuleController extends Controller
{
        /**
     * Store a newly created resource in storage.
     */
    public function activate (Request $request)
    {
        $user = $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $module = Module::where('id', $request->id)->first();

        if (!$module) {
            return response()->json([
                'message' => 'This module does not exit'
            ], 404);
        }

        $user_module = UserModule::where('user_id', $user['user_id'])
                                ->where('module_id', $request->id)
                                ->where('active', true)->first();
        
        if ($user_module) {
            return response()->json([
                'message' => 'THis module is already activated'
            ], 200);
        }

        UserModule::create([
            'user_id' => $user['user_id'],
            'module_id' => $module->id,
            'active' => true,
        ]);

        return response()->json([
            'message' => 'Module activated',
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function deactivate (Request $request)
    {
        $user = $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $module = UserModule::where('module_id', $request->id)
                            ->where('user_id', $user['user_id'])->first();

        if (!$module) {
            return response()->json([
                'message' => 'This module does not exit'
            ], 404);
        }

        $module->active = false;
        $module->save();

        return response()->json([
            'message' => 'Module deactivated',
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserModuleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserModule $userModule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserModule $userModule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserModuleRequest $request, UserModule $userModule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserModule $userModule)
    {
        //
    }
}
