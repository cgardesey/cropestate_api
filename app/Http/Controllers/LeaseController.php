<?php

namespace App\Http\Controllers;

use App\lease;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::where('api_token', '=', $request->bearerToken())->first();
        $role = $user->role;

        switch ($role) {
            case 'admin':
                $leases = DB::table('lease_tb')->get();
                return $leases;
            default:
                $leases = DB::table('lease_tb')->get();
                return $leases;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\lease  $lease
     * @return \Illuminate\Http\Response
     */
    public function show(lease $lease)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\lease  $lease
     * @return \Illuminate\Http\Response
     */
    public function edit(lease $lease)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\lease  $lease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, lease $lease)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\lease  $lease
     * @return \Illuminate\Http\Response
     */
    public function destroy(lease $lease)
    {
        //
    }
}
