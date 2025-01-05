<?php

namespace App\Http\Controllers;

use App\Services\ServiceElementMapping;
use Exception;
use Illuminate\Http\Request;

class ElementMappingController extends Controller
{
    protected $elementMappingService;

    public function __construct(ServiceElementMapping $elementMappingService)
    {
        $this->elementMappingService = $elementMappingService;
    }

    public function showAll() {
        try {
            $mappingData = $this->elementMappingService->getAll();
            return view('elementMappingList', ['mappingData' => $mappingData]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function add(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'elementorType' => 'required|string',
                'frontendType' => 'required|string',
                'settingsMapper' => 'required|string'
            ]);
            $savedData = $this->elementMappingService->add(
                $validatedData['elementorType'], 
                $validatedData['frontendType'], 
                $validatedData['settingsMapper']);
            return redirect('/listElements');
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function showEdit(Request $request, $id)
    {
        try {
            $mappingData = $this->elementMappingService->findById($id);
            return view('elementMappingEditForm', ['mappingData' => $mappingData]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'elementorType' => 'required|string',
                'frontendType' => 'required|string',
                'settingsMapper' => 'required|string'
            ]);
            $editedData = $this->elementMappingService->edit(
                $id, 
                $validatedData['elementorType'], 
                $validatedData['frontendType'],
                $validatedData['settingsMapper']);
            return redirect('/listElements');
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
