<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BreweryService;
use Symfony\Component\HttpFoundation\Response;

class BreweryController extends Controller
{


    public function __invoke(Request $request, BreweryService $brewery_service)
    {
        $page     = $request->input('page',1);
        $per_page = $request->input('per_page',10);

        try{
            return $brewery_service->fetch($page, $per_page);
        }
        catch(\Exception $e){
            return response()->json(
                [ 'error'=> $e->getMessage() ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
