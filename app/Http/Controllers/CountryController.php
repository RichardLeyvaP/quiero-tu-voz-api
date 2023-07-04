<?php

namespace App\Http\Controllers;

use App\Helpers\AppConstants;
use App\Models\Country;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Http\Resources\CountryResource;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\Response;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;

#[Group('Country', 'País')]
class CountryController extends Controller
{
    #[Endpoint('List', 'Permite mostrar los Paises.')]
    #[ResponseFromApiResource(CountryResource::class, Country::class, paginate: AppConstants::PAGE_SIZE)]
    public function index()
    {
        $this->authorize('viewAny', Country::class);

        return CountryResource::collection(Country::all());
    }

    #[Endpoint('Store', 'Permite guardar un País')]
    #[ResponseFromApiResource(CountryResource::class, Country::class, 201)]
    public function store(StoreCountryRequest $request)
    {
        $this->authorize('create', Country::class);

        $country = Country::create([
            'name' => $request->name
        ]);

        return (new CountryResource($country))
            ->additional(['message' => __('messages.created')])
            ->response()->setStatusCode(201);
    }

    #[Endpoint('Show', 'Permite mostrar un País')]
    #[ResponseFromApiResource(CountryResource::class, Country::class)]
    public function show(Country $country)
    {
        $this->authorize('view', $country);

        return new CountryResource($country);
    }

    #[Endpoint('Update', 'Permite actualizar un País')]
    #[ResponseFromApiResource(CountryResource::class, Country::class)]
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $this->authorize('update', $country);

        $country->update([
            'name' => $request->name
        ]);

        return (new CountryResource($country))
            ->additional(['message' => __('messages.updated')]);
    }

    #[Endpoint('Delete', 'Permite borrar un País')]
    #[Response(['message' => 'Se ha eliminado satisfactoriamente'])]
    public function destroy(Country $country)
    {
        $operation = $country->delete();

        if ($operation) {
            return response()->json(['message' => __('messages.deleted')]);
        }

        return response()->json(['message' => __('http-statuses.417')], 417);
    }
}
