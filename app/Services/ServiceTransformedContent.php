<?php

namespace App\Services;

use App\Repositories\TransformedContentRepository;
use App\Repositories\ElementMappingRepository;

class ServiceTransformedContent {
    protected $transformedContentRepository;
    protected $elementMappingReposityory;
    
    public function __construct(TransformedContentRepository $transformedContentRepository, ElementMappingRepository $elementMappingReposityory)
    {
        $this->transformedContentRepository = $transformedContentRepository;
        $this->elementMappingReposityory = $elementMappingReposityory;
    }

    public function getAll()
    {
        return $this->transformedContentRepository->getAll();
    }

    public function add($sourceId, $rawContent)
    {
        $transformedContent = $this->transformData($rawContent);

        return $this->transformedContentRepository->add($sourceId, json_encode($transformedContent));
    }

    private function transformData($rawContent)
    {
        $data = $rawContent;
        unset($data["elements"]);
        //dd($data);
        $mappingArrayStr = $this->elementMappingReposityory->findByElementor($data['elType']);
        eval('$result = ' . $mappingArrayStr->settings_mapper . ';');
        $elementsData = $rawContent["elements"] ??  null;
        if ($elementsData != null) {
            foreach ($elementsData as $element)
            {
                $childData = $this->transformData($element);
                $result['children'] = $childData;
            }
        }
        return $result;
    }

    public function edit($id, $sourceId, $transformedContent)
    {
        return $this->transformedContentRepository->edit($id, $sourceId, $transformedContent);
    }

    public function findById($id)
    {
        return $this->transformedContentRepository->findById($id);
    }
}