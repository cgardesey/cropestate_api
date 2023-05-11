<?php

namespace App\Http\Controllers;

use App\lease;
use App\LeaseUpload;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
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
                $users[] = $user;
                return $users;
            default:
                $users[] = $user;
                return $users;
                break;
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
        $userid = Str::uuid();
        User::forceCreate(
            ['userid' => $userid] +
            $request->all());

        $user = User::where('userid', $userid)->first();

        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($userid)
    {
        $user = User::where('userid', $userid)->first();

        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        $updated_user = User::where('userid', $user->userid)->first();

        return response()->json($updated_user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    protected function register()
    {
        $user = User::where('email', request('email'))->first();
        if (!$user) {
            $userid = Str::uuid();
            $created_field_user = User::forceCreate([
                'userid' => $userid,
                'email' => request('email'),
                'password' => Hash::make(request('password')),
                'role' => request('role'),
                'api_token' => Str::uuid(),
                'confirmation_token' => Str::random(40)
            ]);
            Mail::to($created_field_user->email)->send(
                new VerificationEmailSent($created_field_user)
            );

            return response()->json(array(
                'successful' => true
            ));
        } else {
            return response()->json(array(
                'user_already_exist' => true
            ));
        }
    }

    public function login(){
        $user = User::where('email', request('email'))->first();

        if(!$user){
            return response()->json(array(
                'user_not_found' => true
            ));
        }
        else {
            if (!$user->email_verified) {
                return response()->json(array(
                    'email_not_verified' => true
                ));
            }
            elseif (Hash::check(request('password'), $user->password)){

                // fetch field user
                $users[] = $user;

                // fetch leases
                $leases = DB::table('lease_tb')->get();

                // fetch lease uploads
                $lease_uploads = LeaseUpload::all();

                // fetch lease holders
                $lease_holders = DB::table('users_tb')->get();


                return Response::json(array(
                    'userid' => $user->userid,
                    'api_token' => $user->api_token,
                    'users' => $users,
                    'leases' => $leases,
                    'lease_holders' => $lease_holders,
                    'lease_uploads' => $lease_uploads
                ));
            }
            else {
                return response()->json(array(
                    'incorrect_password' => true
                ));
            }
        }
    }
}
