<?php

namespace App\UseCases\Request;

use App\Http\Requests\UpdateRequest;
use App\Jobs\RequestJob;
use App\Models\Request;
use App\Models\Request as RequestModel;

class UpdateService
{
    /**
     * @param UpdateRequest $request
     * @param int $id
     * @return void
     */
    public function update(UpdateRequest $request, int $id): void
    {
        /** @var Request $requestModel */
        $requestModel = RequestModel::find($id);
        if (!$requestModel) {
            throw new \DomainException(trans('Request not found.'));
        }
        $responseData = $requestModel->updateRequest($request->comment);
        RequestJob::dispatch($responseData);
    }

}