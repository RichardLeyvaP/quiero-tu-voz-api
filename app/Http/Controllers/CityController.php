<?php

namespace App\Http\Controllers;

use App\Helpers\AppConstants;
use App\Models\City;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Http\Resources\CityResource;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\Response;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;

#[Group('City', 'Ciudad')]
class CityController extends Controller
{
    #[Endpoint('List', 'Permite mostrar las Ciudades.')]
    #[ResponseFromApiResource(CityResource::class, City::class, paginate: AppConstants::PAGE_SIZE)]
    public function index()
    {
        $this->authorize('viewAny', City::class);

        return CityResource::collection(City::with('country')->get());
    }

    #[Endpoint('Store', 'Permite guardar una Ciudad')]
    #[ResponseFromApiResource(CityResource::class, City::class, 201)]
    public function store(StoreCityRequest $request)
    {
        $this->authorize('create', City::class);

        $city = City::create([
            'country_id' => $request->country_id,
            'name' => $request->name
        ]);

        return (new CityResource($city))
            ->additional(['message' => __('messages.created')])
            ->response()->setStatusCode(201);
    }

    #[Endpoint('Show', 'Permite mostrar una Ciudad')]
    #[ResponseFromApiResource(CityResource::class, City::class)]
    public function show(City $city)
    {
        $this->authorize('view', $city);

        return new CityResource($city);
    }

    #[Endpoint('Update', 'Permite actualizar una Ciudad')]
    #[ResponseFromApiResource(CityResource::class, City::class)]
    public function update(UpdateCityRequest $request, City $city)
    {
        $this->authorize('update', $city);

        $city->update([
            'country_id' => $request->country_id,
            'name' => $request->name
        ]);

        return (new CityResource($city))
            ->additional(['message' => __('messages.updated')]);
    }

    #[Endpoint('Delete', 'Permite borrar una Ciudad')]
    #[Response(['message' => 'Se ha eliminado satisfactoriamente'])]
    public function destroy(City $city)
    {
        $operation = $city->delete();

        if ($operation) {
            return response()->json(['message' => __('messages.deleted')]);
        }

        return response()->json(['message' => __('http-statuses.417')], 417);
    }
}
