<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TransactionController extends BaseController
{
    protected TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TransactionRequest  $request
     *
     * @return JsonResponse
     */
    public function store(TransactionRequest $request): JsonResponse
    {
        $transaction = $request->validated();

        try {
            if ($data = $this->transactionService->save($transaction)) {
                return $this->sendSuccessfulResponse($data);
            }
        } catch (\Exception $e) {
            return $this->sendErrorResponse($e->getMessage());
        }

        return $this->sendErrorResponse(
            'Error saving transaction.',
            JsonResponse::HTTP_BAD_REQUEST
        );
    }
}
