<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexRequest;
use App\Http\Requests\PriceProductRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\PriceListResource;
use App\Http\Resources\ProductResource;
use App\Managers\CrudManager;
use App\Models\PricesProduct;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Muestra una lista de productos.
     *
     * @param \App\Http\Requests\IndexRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $products = CrudManager::retrieve(
            $request, 
            Product::class
        );  

        return ProductResource::collection($products);
    }

    /**
     * Almacena un nuevo producto en la base de datos.
     *
     * @param \App\Http\Requests\ProductRequest $request
     * @return \App\Http\Resources\ProductResource|\Illuminate\Http\JsonResponse|array
     */
    public function store(ProductRequest $request)
    {
        $result = CrudManager::create(
            $request,
            Product::class
        );
        
        if (isset($result['data'])) {
            return new ProductResource(
                $result['data']
            );
        }

        return $result;
    }

    /**
     * Muestra un producto específico.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Http\JsonResponse|array
     */
    public function show(Product $product)
    {
        return CrudManager::show($product);
    }

    /**
     * Actualiza la información de un producto.
     *
     * @param \App\Http\Requests\ProductRequest $request
     * @param \App\Models\Product $product
     * @return \App\Http\Resources\ProductResource|\Illuminate\Http\JsonResponse|array
     */
    public function update(ProductRequest $request, Product $product)
    {
        $result = CrudManager::update(
            $request, 
            $product
        );

        if (isset($result['data'])) {
            return new ProductResource($product);
        }

        return $result;
    }

    /**
     * Elimina un producto específico.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\JsonResponse|array
     */
    public function destroy(Product $product)
    {
        return CrudManager::delete($product);
    }

    /**
     * Agrega un nuevo precio para el producto especificado.
     *
     * @param \App\Http\Requests\PriceProductRequest $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\JsonResponse|array
     */
    public function addProductPrice(PriceProductRequest $request, Product $product) {
        $data = array_merge(['product_id' => $product->id], $request->all());

        $result = CrudManager::create(
            $data, 
            PricesProduct::class
        );

        return $result;
    }

    /**
     * Obtiene todos los precios del producto especificado.
     *
     * @param \App\Http\Requests\IndexRequest $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getProductPrices(IndexRequest $request, Product $product) {
        $list = CrudManager::retrieve(
            $request, 
            Product::class, 
            ['prices']
        );

        return PriceListResource::collection($list);
    }
}
