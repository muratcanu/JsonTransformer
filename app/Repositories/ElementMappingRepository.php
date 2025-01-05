<?php

namespace App\Repositories;

use App\Models\ElementMapping;

class ElementMappingRepository {
    public function getAll()
    {
        return ElementMapping::all();
    }

    private function set($elementorMapping, $elementorType, $frontendType, $settingsMapper)
    {
        $elementorMapping->elementor_type = $elementorType;
        $elementorMapping->frontend_type = $frontendType;
        $elementorMapping->settings_mapper = $settingsMapper;
        $elementorMapping->save();
        return $elementorMapping;
    }

    public function add($elementorType, $frontendType, $settingsMapper)
    {
        return $this->set(
            new ElementMapping(),
            $elementorType,
            $frontendType,
            $settingsMapper
        );
    }

    public function edit($id, $elementorType, $frontendType, $settingsMapper)
    {
        return $this->set(
            ElementMapping::find($id),
            $elementorType,
            $frontendType,
            $settingsMapper
        );
    }

    public function findById($id)
    {
        return ElementMapping::find($id);
    }

    public function findByElementor($elementor)
    {
        return ElementMapping::where('elementor_type', $elementor)->first();
    }
}