<?php

namespace App\Managers;

use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use Illuminate\Http\Request;
use DB;

class CrudManager {
    const HTTP_STATUS = [
        200,
        201,
        202,
        204,
        400,
        401,
        403,
        404,
        405,
        409,
        422,
        500,
        503,
    ];
    
    public static function retrieve(Request $request, string|object $model, ?array $relations = null) {
        $list = $model::query()
        ->when($relations, function ($query, $relations) {
            $query->with($relations);
        });

        if($list->count() > 1) {
            return $list->paginate($request->paginator ?? 20);
        }

        return $list->get();
    }

    public static function create(mixed $request, string $model) {
        try {
            DB::beginTransaction();

            $response = $model::create(
                is_array($request) ? $request : $request->all()
            );

            DB::commit();

            return [
                'data' => $response,
                'message' => 'Ok',
            ];

        } catch(\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'error' => 'An error occurred while creating the resource.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public static function show(string|object $model) {
        return response()->json([
            'data' => $model,
            'message' => 'Object retrieved properly!',
        ]);
    }

    public static function update(mixed $request, string|object $model) {
        try {
            DB::beginTransaction();

            $model::query()->update(
                is_array($request) ? $request : $request->all()
            );

            DB::commit();

            return [
                'data' => $model,
                'message' => 'Record updated succesfully',
            ];

        } catch(\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => 'An error occurred while updating the resource.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public static function delete(string|object $model) {
        try {
            $model->delete();

            return response()->json([
                'message' => 'Currency deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while deleting the currency.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}