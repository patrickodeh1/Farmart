<?php

namespace Botble\RezgoConnector\Http\Controllers;

use Botble\RezgoConnector\Services\RezgoApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RezgoPricingApiController
{
    protected RezgoApiService $apiService;

    public function __construct(RezgoApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Get pricing for a specific date.
     * Query: ?uid=TOUR_UID&date=YYYY-MM-DD
     */
    public function getPricingByDate(Request $request): JsonResponse
    {
        $uid = $request->query('uid');
        $date = $request->query('date');

        if (!$uid || !$date) {
            return response()->json([
                'success' => false,
                'error' => 'Missing required parameters: uid, date',
            ], 400);
        }

        $result = $this->apiService->getPricingByDate($uid, $date);

        return response()->json($result);
    }

    /**
     * Get pricing for all dates in a month (for calendar).
     * Query: ?uid=TOUR_UID&year=2026&month=05
     */
    public function getPricingForMonth(Request $request): JsonResponse
    {
        $uid = $request->query('uid');
        $year = (int)$request->query('year');
        $month = (int)$request->query('month');

        if (!$uid || !$year || !$month) {
            return response()->json([
                'success' => false,
                'error' => 'Missing required parameters: uid, year, month',
            ], 400);
        }

        $result = $this->apiService->getPricingForMonth($uid, $year, $month);

        return response()->json($result);
    }
}
