<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use League\CommonMark\Extension\Attributes\Node\Attributes;

class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find('1');

        $data = ['id' => $user->id, "email" => $user->email];
        return json_encode($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {



        return $request;


        // $user = new User();
        // $user->name = $dados->name;
        // $user->email = $dados->email;
        // $user->password = $dados->password;
        // $user->access_level = $dados->acess_level;
        // $user->AL_id = $dados->Al_id;
        // $user->save();

        // return json_encode(["status" => "ok"]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}