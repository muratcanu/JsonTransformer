<?php

namespace App\Repositories;

use App\Models\TransformedContent;

class TransformedContentRepository {
    public function getAll()
    {
        return TransformedContent::all();
    }

    private function set($transformedContentObject, $sourceId, $transformedContent)
    {
        $transformedContentObject->source_id = $sourceId;
        $transformedContentObject->transformed_content = $transformedContent;
        $transformedContentObject->save();
        return $transformedContentObject;
    }

    public function add($sourceId, $transformedContent)
    {
        return $this->set(
            new TransformedContent(),
            $sourceId,
            $transformedContent
        );
    }

    public function edit($id, $sourceId, $transformedContent)
    {
        return $this->set(
            TransformedContent::find($id),
            $sourceId,
            $transformedContent
        );
    }

    public function findById($id)
    {
        return TransformedContent::find($id);
    }
}