<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponses;
use Illuminate\Http\Request;

class _ApiController extends Controller
{
    public function index(){
        try {


            return ApiResponses::Success('Welcome to the API',[
                'version'=>'0.0.1',
                'author'=>'{ JEBC-DeV }',
                'source'=>'_ApiController=>index()',
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
