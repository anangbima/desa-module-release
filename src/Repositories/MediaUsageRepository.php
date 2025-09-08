<?php

namespace Modules\DesaModuleRelease\Repositories;

use Modules\DesaModuleRelease\Models\MediaUsage;
use Modules\DesaModuleRelease\Repositories\Interfaces\MediaUsageRepositoryInterface;

class MediaUsageRepository implements MediaUsageRepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = new MediaUsage();
    }

    /**
     * Create a new media usage record.
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }
}