<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyRequest;
use App\Managers\CrudManager;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Resources\CurrencyResource;

class CurrencyController extends Controller
{
    /**
     * Muestra una lista de todas las monedas.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     *
     * ## Ejemplo de uso:
     * GET /api/currencies
     *
     * ## Respuesta:
     * {
     *    "data": [
     *      {
     *        "id": 1,
     *        "name": "Dólar estadounidense",
     *        "symbol": "USD",
     *        "exchange_rate": 1.00
     *      },
     *      {
     *        "id": 2,
     *        "name": "Euro",
     *        "symbol": "EUR",
     *        "exchange_rate": 0.92
     *      }
     *    ]
     * }
     */
    public function index(Request $request)
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
     *
     * ## Ejemplo de payload:
     * {
     *    "name": "Peso Mexicano",
     *    "symbol": "MXN",
     *    "exchange_rate": 16.80
     * }
     *
     * ## Respuesta:
     * {
     *    "id": 3,
     *    "name": "Peso Mexicano",
     *    "symbol": "MXN",
     *    "exchange_rate": 16.8
     * }
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
     *
     * ## Ejemplo de uso:
     * GET /api/currencies/1
     *
     * ## Respuesta:
     * {
     *    "data": {
     *       "id": 1,
     *       "name": "Dólar estadounidense",
     *       "symbol": "USD",
     *       "exchange_rate": 1.00
     *    }
     * }
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
     *
     * ## Ejemplo de payload:
     * {
     *    "name": "Euro",
     *    "symbol": "EUR",
     *    "exchange_rate": 0.95
     * }
     *
     * ## Respuesta:
     * {
     *    "data": {
     *       "id": 2,
     *       "name": "Euro",
     *       "symbol": "EUR",
     *       "exchange_rate": 0.95
     *    }
     * }
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
     *
     * ## Ejemplo de uso:
     * DELETE /api/currencies/2
     *
     * ## Respuesta:
     * {
     *    "message": "Recurso eliminado correctamente."
     * }
     */
    public function destroy(Currency $currency)
    {
        return CrudManager::delete($currency);
    }
}
