<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRequest;
use App\UseCases\Request\FilterService;
use App\UseCases\Request\UpdateService;
use App\Models\Request as RequestModel;
use Illuminate\Http\RedirectResponse;
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
     * IndexController constructor.
     * @param private UpdateService $service
     */
    public function __construct(
        private UpdateService $service,
    ) {}

    /**
     * Total page
     */
    private const LIMIT = 5;

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $builder = RequestModel::orderByDesc('id')->withTrashed();


        $statuses = RequestStatus::cases();
        $paginator = (new FilterService($request))
                        ->apply($builder)
                        ->paginate(self::LIMIT);
        return view('request.index', compact('paginator', 'statuses'));
    }

    /**
     * @param UpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, int $id): RedirectResponse
    {
        try {
            $this->service->update($request, $id);
            return back()->with('success', trans('Saved successfully'));
        } catch (\DomainException $error) {
            return back()->with('error', $error->getMessage());
        }
    }

    /**
     * Delete request
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $requestModel = RequestModel::findOrFail($id);
        if ($requestModel->delete()) {
            return back()->with('success', trans('Successfully deleted'));
        }
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        $restore = RequestModel::withTrashed()
                        ->whereId($id)
                        ->restore();
        if($restore) {
            return back()->with('success', trans('Restored successfully'));
        }
    }
}
