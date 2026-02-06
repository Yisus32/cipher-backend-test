<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyRequest;
use App\Http\Requests\IndexRequest;
use App\Managers\CrudManager;
use App\Models\Currency;
use App\Http\Resources\CurrencyResource;

class CurrencyController extends Controller
{
    /**
     * Muestra una lista de todas las monedas.
     *
     * @param \App\Http\Requests\IndexRequest; $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(IndexRequest $request)
    { 
        $currencies = CrudManager::retrieve(
            $request, 
            Currency::class
        );

        return CurrencyResource::collection($currencies);
    }

    /**
     * Almacena una nueva moneda en la base de datos.
     *
     * @param \App\Http\Requests\CurrencyRequest $request
     * @return \Illuminate\Http\JsonResponse|array
     */
    public function store(CurrencyRequest $request)
    {
        $currency = CrudManager::create(
            $request, 
            Currency::class
        );

        return response()->json($currency);
    }

    /**
     * Muestra una moneda específica.
     *
     * @param \App\Models\Currency $currency
     * @return \App\Http\Resources\CurrencyResource
     */
    public function show(Currency $currency)
    {
        return new CurrencyResource($currency);
    }

    /**
     * Actualiza la información de una moneda existente.
     *
     * @param \App\Http\Requests\CurrencyRequest $request
     * @param \App\Models\Currency $currency
     * @return \App\Http\Resources\CurrencyResource|array
     */
    public function update(CurrencyRequest $request, Currency $currency)
    {
        $updatedCurrency = CrudManager::update(
            $request, 
            $currency
        );

        if (isset($updatedCurrency['data'])) {
            return new CurrencyResource(
                $updatedCurrency['data']
            );
        }
        
        return $updatedCurrency;
    }

    /**
     * Elimina una moneda de la base de datos.
     *
     * @param \App\Models\Currency $currency
     * @return \Illuminate\Http\JsonResponse|array
     */
    public function destroy(Currency $currency)
    {
        return CrudManager::delete($currency);
    }
}
