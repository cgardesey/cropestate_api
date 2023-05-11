<?php

namespace App\Http\Controllers;

use App\Upload;
use App\LeaseUpload;
use App\Traits\UploadTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LeaseUploadController extends Controller
{
    use UploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::where('api_token', '=', $request->bearerToken())->first();
        $role = $user->role;

        switch ($role) {
            case 'admin':
                return LeaseUpload::all();
            case 'student':
                return LeaseUpload::all();
            default:
                'default';
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Define folder path
        $folder = '/uploads/lease-uploads/';
        // Make a file name based on title and current timestamp
        $name = $request->input('leaseuploadid');
        // Get image file
        $image = $request->file("file");
        // Make a file path where image will be stored [ folder path + file name + file extension]
        $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
        // Upload image
        $this->uploadOne($image, $folder, '', $name);/**/

        LeaseUpload::forceCreate(
            ['leaseuploadid' => $request->input('leaseuploadid')] +
            ['leasecode' => $request->input('leasecode')] +
            ['title' => $request->input('title')] +
            ['description' => $request->input('description')] +
            ['url' => asset('storage/app') . "$filePath"]

        );

        $lease_upload = LeaseUpload::where('leaseuploadid', $request->input('leaseuploadid'))->first();

        return response()->json($lease_upload);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeaseUpload $leaseUpload
     * @return \Illuminate\Http\Response
     */
    public function show(LeaseUpload $leaseUpload)
    {
        return $leaseUpload;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeaseUpload $leaseUpload
     * @return \Illuminate\Http\Response
     */
    public function edit(LeaseUpload $leaseUpload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\LeaseUpload $leaseUpload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeaseUpload $leaseUpload)
    {
        $leaseUpload->update($request->all());

        $updated_leaseUpload = LeaseUpload::where('leaseUploadid', $leaseUpload->leaseUploadid)->first();

        return response()->json($updated_leaseUpload);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeaseUpload $leaseUpload
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaseUpload $leaseUpload)
    {
        //
    }
}
