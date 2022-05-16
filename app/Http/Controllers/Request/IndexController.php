<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRequest;
use App\UseCases\Request\UpdateService;
use App\Models\Request as RequestModel;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Enums\RequestStatus;

/**
 * Class IndexController
 * @package App\Http\Controllers\Request
 */
class IndexController extends Controller
{
    /**
     * @var UpdateService $service
     */
    private $service;

    public function __construct(UpdateService $service)
    {
        $this->service = $service;
    }

    /**
     * Total page
     */
    protected const LIMIT = 5;

    /**
     * @return View
     */
    public function index(Request $request): View
    {
        $query = RequestModel::orderByDesc('id');

        if (!empty($value = $request->get('status'))) {
            $query->where('status', $value);
        }

        $statuses = RequestStatus::cases();
        $paginator = $query->paginate(self::LIMIT);

        return view('request.index', compact('paginator', 'statuses'));
    }

    /**
     * @param UpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, int $id)
    {
        try {
            $this->service->update($request, $id);
            return back()->with('success', trans('Saved successfully!'));
        } catch (\DomainException $error) {
            return back()->with('error', $error->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
