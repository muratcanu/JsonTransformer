<?php

namespace App\Services;

use App\Repositories\ElementMappingRepository;

class ServiceElementMapping {
    protected $elementMappingRepository;
    
    public function __construct(ElementMappingRepository $elementMappingRepository)
    {
        $this->elementMappingRepository = $elementMappingRepository;
    }

    public function getAll()
    {
        return $this->elementMappingRepository->getAll();
    }

    public function add($elementorType, $frontendType, $settingsMapper)
    {
        return $this->elementMappingRepository->add($elementorType, $frontendType, $settingsMapper);
    }

    public function edit($id, $elementorType, $frontendType, $settingsMapper)
    {
        return $this->elementMappingRepository->edit($id, $elementorType, $frontendType, $settingsMapper);
    }

    public function findById($id)
    {
        return $this->elementMappingRepository->findById($id);
    }
}