<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\NewRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Request as RequestModel;

/**
 * Class RequestController
 * @package App\Http\Controllers\Api
 */
class RequestController extends Controller
{
    /**
     * @param Request $request
     * @return  JsonResponse
     */
    public function __invoke(NewRequest $request): JsonResponse
    {
        $data = RequestModel::new($request->only(['name', 'email', 'message']));
        return response()->json(
            [
                'status' => 'success',
                'message' => trans('Successfully sent!'),
                'data' => $data
            ],
            200
        );
    }
}
