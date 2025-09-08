<?php

namespace Modules\DesaModuleRelease\Repositories;

use Modules\DesaModuleRelease\Models\Media;
use Modules\DesaModuleRelease\Repositories\Interfaces\MediaRepositoryInterface;

class MediaRepository implements MediaRepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = new Media();
    }

    /**
     * Create a new media record.
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }
}