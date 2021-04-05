<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEvaluationFormRequest;
use App\Http\Resources\EvaluationResource;
use App\Services\EvaluationService;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    protected $evaluationService;

    public function __construct(EvaluationService $evaluationService)
    {
        $this->evaluationService = $evaluationService;
    }

    public function store(StoreEvaluationFormRequest $request)
    {
        $data = $request->only('stars', 'comment');
        $evaluation = $this->evaluationService->storeNewEvaluationOrder($request->identify, $data);

        return new EvaluationResource($evaluation);
    }
}
