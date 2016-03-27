<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Http\Request;
use Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $password          = $request->input("password");
        $blowfish_password = password_hash($password, CRYPT_BLOWFISH);
        $default_password  = password_hash($password, PASSWORD_DEFAULT);

        $response = <<<response
$password => $blowfish_password (CRYPT_BLOWFISH)

$password => $default_password (PASSWORD_DEFAULT)
response;

        return nl2br($response);
    }

    /**
     * @param Material $material
     *
     * @return string
     */
    public function encrypt(Material $material)
    {
        $json_data = json_encode($material->json_data);
        $encrypt = Crypt::encrypt($json_data);

        $html = $encrypt . "<br>";
        $html .= Crypt::decrypt($encrypt) . "<br>";

        return $html;
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
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
