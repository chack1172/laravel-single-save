<?php

namespace Chack1172\SingleSave\Eloquent;

use Closure;
use Illuminate\Contracts\Database\Eloquent\Builder;

trait SingleSave
{
    /**
     * Indicates if single save is enabled
     *
     * @var bool
     */
    protected $singleSaving = false;

    public function singleSave(Closure $callback)
    {
        $this->singleSaving = true;

        $callback($this);

        $this->singleSaving = false;

        return $this->save();
    }

    protected function performUpdate(Builder $query)
    {
        if ($this->singleSaving) {
            return false;
        }

        return parent::performUpdate($query);
    }

    protected function finishSave(array $options)
    {
        if (!$this->singleSaving) {
            parent::finishSave($options);
        }
    }
}
