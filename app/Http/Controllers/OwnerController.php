<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\Owner;

class OwnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owner');
    }    

    public function index()
    {
        $owner = new Owner();
        $owner_data = $owner->getOwner()[0];

        return view('owner.index', ['owner' => $owner_data]);
    }
}