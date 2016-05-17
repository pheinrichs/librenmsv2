<?php

namespace App\Http\Controllers;

use App\DataTables\DeviceDataTable;
use Dingo\Api\Http;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    use Helpers;

    /**
     * Constructor
     */
    public function __construct(Request $request) {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(DeviceDataTable $dataTable)
    {
        return $dataTable->render('devices.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // add new device form
        return view('devices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // save device

        $this->validate($request, [
            'hostname'        => 'required|unique:devices|max:128',
            'snmpver'         => 'required|alpha_num|max:4',
            'transport'       => 'required|alpha_num|max:16',
            'port_assoc_mode' => 'required|alpha',
            'community'       => 'required_if:snmpver,v1,v2c|max:255',
            'authlevel'       => 'required_if:snmpver,v3|alpha|max:15',
            'authname'        => 'required_if:authlevel,authNoPriv|max:64',
            'authalgo'        => 'required_if:authlevel,authNoPriv|in:MD5,SHA|max:3',
            'cryptopass'      => 'required_if:authlevel,authPriv|max:64',
            'cryptoalgo'      => 'required_if:authlevel,authPriv|in:AES,DES|max:3',
        ]);
        return redirect()->route('devices.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('devices.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //edit device form??
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //process device modify
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete device
    }
}
