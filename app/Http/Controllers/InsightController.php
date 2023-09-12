<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insight;
use App\Services\InsightService;

class InsightController extends Controller
{
    protected $insightService;

    public function __construct(InsightService $insightService)
    {
        $this->insightService = $insightService;
    }

    public function addInsight(Request $request)
    {
        $insight = $this->insightService->createInsight(
            auth()->id(),
            $request->chapter_id,
            $request->verse_number,
            $request->content
        );

        return response()->json(['message' => 'Insight added successfully', 'data' => $insight], 201);
    }

    public function getInsights()
    {
        $userId = auth()->id();

        $insights = $this->insightService->getInsightsByUser($userId);

        return response()->json($insights, 200);
    }

    public function updateInsight(Request $request, $id)
    {
        $updatedInsight = $this->insightService->updateInsightByUser(auth()->id(), $id, $request->input('content'));

        if ($updatedInsight) {
            return response()->json(['message' => 'Insight updated successfully', 'data' => $updatedInsight], 200);
        } else {
            return response()->json(['message' => 'Insight not found or not authorized'], 404);
        }
    }

    public function deleteInsight($id)
    {
        $deleted = $this->insightService->deleteInsightByUser(auth()->id(), $id);

        if ($deleted) {
            return response()->json(['message' => 'Insight deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Insight not found or not authorized'], 404);
        }
    }

    

    /*
    data body post request = 
{
  chapter_id: 1,
  verse_number: 2,
  content: "This is an insight about the verse."
};
    */

}
