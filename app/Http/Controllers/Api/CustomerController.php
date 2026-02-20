<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Http\Resources\CustomerResource;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Requests\ListCustomersRequest;

class CustomerController extends Controller
{
    public function index(ListCustomersRequest $request)
    {
        // Si les paramètres sont invalides, Laravel renvoie automatiquement une erreur 422
        // Le code ci-dessous ne s'exécutera que si la validation est passée avec succès.

        $customers = QueryBuilder::for(Customer::class)
            ->allowedFilters(['first_name', 'last_name', 'email'])
            ->allowedSorts(['first_name', 'last_name', 'email'])
            ->paginate(
                $request->input('page.size', 10),
                ['*'],
                'page[number]',
                $request->input('page.number', 1)
            );

        return CustomerResource::collection($customers);
    }
}
