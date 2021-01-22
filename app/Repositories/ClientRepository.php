<?php


namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class ClientRepository implements ClientRepositoryInterface
{

    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function createNewClient(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        return $this->client->create($data);
    }

    public function getCient(int $id)
    {

    }
}
