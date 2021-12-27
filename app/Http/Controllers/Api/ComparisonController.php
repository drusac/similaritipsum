<?php

namespace App\Http\Controllers\Api;

use App\Models\Comparison;
use App\Services\BaconIpsumHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetComparison;
use App\Http\Resources\ComparisonResource;

class ComparisonController extends Controller
{
    public function index()
    {
        return ComparisonResource::collection(Comparison::latest()->paginate());
    }

    public function similarText(GetComparison $request)
    {
        $baconIpsumHandler = new BaconIpsumHandler;

        $baconString1 = $baconIpsumHandler->getBaconString();
        $baconString2 = $baconIpsumHandler->getBaconString();

        $matchingChars = similar_text($baconString1, $baconString2, $percentage);

        if ($request->boolean('persist-to-db')) {
            $comparison = $baconIpsumHandler->persistResultToDatabase([
                'string1' => $baconString1,
                'string2' => $baconString2,
                'matching_chars' => $matchingChars,
                'match_percentage' => round($percentage, 2),
            ]);

            $savedToDb = boolval($comparison);
        }

        return response()->json([
            'data' => [
                'bacon_string_1' => $baconString1,
                'bacon_string_2' => $baconString2,
                'matching_chars' => $matchingChars,
                'percentage' => round($percentage, 2),
                'saved_result_to_db' => $savedToDb ?? false,
            ]
        ]);
    }
}
