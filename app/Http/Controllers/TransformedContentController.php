<?php

namespace App\Http\Controllers;

use App\Services\ServiceTransformedContent;
use Exception;
use Illuminate\Http\Request;

class TransformedContentController extends Controller
{
    protected $transformedContentService;

    public function __construct(ServiceTransformedContent $transformedContentService)
    {
        $this->transformedContentService = $transformedContentService;
    }

    public function showAll()
    {
        try {
            $transformedContents = $this->transformedContentService->getAll();
            return view('transformedElementList', ['contentData' => $transformedContents]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function add(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'sourceId' => 'required|string',
                'rawContent' => 'required|string'
            ]);
            $savedData = $this->transformedContentService->add($validatedData['sourceId'], json_decode($validatedData['rawContent'], true));
            return redirect('/listTransformedContents');
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
