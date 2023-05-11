<?php

namespace App\Http\Controllers;

use App\LeaseHolder;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaseHolderController extends Controller
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
                $lease_holders = DB::table('users_tb')->get();
                return $lease_holders;
            default:
                $lease_holders = DB::table('users_tb')->get();
                return $lease_holders;
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
     * @param  \App\LeaseHolder  $leaseHolder
     * @return \Illuminate\Http\Response
     */
    public function show(LeaseHolder $leaseHolder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeaseHolder  $leaseHolder
     * @return \Illuminate\Http\Response
     */
    public function edit(LeaseHolder $leaseHolder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeaseHolder  $leaseHolder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeaseHolder $leaseHolder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeaseHolder  $leaseHolder
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaseHolder $leaseHolder)
    {
        //
    }
}
