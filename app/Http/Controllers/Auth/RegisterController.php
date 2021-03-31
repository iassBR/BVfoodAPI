<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientFormRequest;
use App\Http\Resources\ClientResource;
use App\Services\ClientService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    protected $clientService;
    
    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function store(StoreClientFormRequest $request)
    {
       $client = $this->clientService->storeNewClient($request->all());

       return new ClientResource($client);
    }
}
