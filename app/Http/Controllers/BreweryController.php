<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BreweryController extends Controller
{
    private string $breweryApiUrl='https://api.openbrewerydb.org/v1/breweries';


    public function __invoke(Request $request)
    {
        $page     = $request->input('page',1);
        $per_page = $request->input('per_page',10);

        try{
            return Http::get($this->breweryApiUrl, ['page'=> $page, 'per_page'=> $per_page]);
        }
        catch(\Exception $e){
            return response()->json(
                [ 'error'=> $e->getMessage() ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
