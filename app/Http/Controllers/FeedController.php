<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->middleware('auth:api');

        $this->user = auth()->user();
    }
}
