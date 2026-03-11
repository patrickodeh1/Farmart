<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RezgoTrackingController extends Controller
{
    /**
     * Get Rezgo API submissions for an order
     */
    public function getSubmission($orderId)
    {
        $submission = DB::table('rezgo_submissions')
            ->where('order_id', $orderId)
            ->latest()
            ->first();

        if (!$submission) {
            return response()->json([
                'success' => false,
                'message' => 'No Rezgo submission found for this order',
                'order_id' => $orderId,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'order_id' => $submission->order_id,
            'rezgo_booking_id' => $submission->rezgo_booking_id,
            'status' => $submission->status,
            'http_status' => $submission->http_status,
            'submitted_at' => $submission->created_at,
            'api_request' => json_decode($submission->request_payload, true),
            'api_response' => $submission->response_payload,
            'error_message' => $submission->error_message,
        ]);
    }

    /**
     * Get all Rezgo submissions
     */
    public function getAllSubmissions(Request $request)
    {
        $limit = $request->input('limit', 20);

        $submissions = DB::table('rezgo_submissions')
            ->select([
                'id',
                'order_id',
                'rezgo_booking_id',
                'status',
                'http_status',
                'created_at',
            ])
            ->latest()
            ->limit($limit)
            ->get();

        return response()->json([
            'success' => true,
            'total' => $submissions->count(),
            'submissions' => $submissions,
        ]);
    }

    /**
     * Get submission detail with full payload
     */
    public function getSubmissionDetail($id)
    {
        $submission = DB::table('rezgo_submissions')
            ->where('id', $id)
            ->first();

        if (!$submission) {
            return response()->json([
                'success' => false,
                'message' => 'Submission not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'id' => $submission->id,
            'order_id' => $submission->order_id,
            'rezgo_booking_id' => $submission->rezgo_booking_id,
            'status' => $submission->status,
            'http_status_code' => $submission->http_status,
            'submitted_at' => $submission->created_at,
            'request_sent_to_rezgo' => json_decode($submission->request_payload, true),
            'response_from_rezgo' => $submission->response_payload,
            'error_details' => $submission->error_message,
        ]);
    }
}
