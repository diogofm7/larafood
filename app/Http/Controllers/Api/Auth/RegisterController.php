<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClient;
use App\Http\Resources\ClienteResource;
use App\Services\ClientService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    /**
     * @var ClientService
     */
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function store(StoreClient $request)
    {
        $client = $this->clientService->createNewClient($request->validated());

        return new ClienteResource($client);
    }

}
