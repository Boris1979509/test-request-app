<?php

namespace App\UseCases\Request;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class FilterService
 * @package App\UseCases\Request
 */
class FilterService
{
    /**
     * FilterService constructor.
     * @param private Request $request
     */
    public function __construct(
        private Request $request
    ) {}

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;
        foreach ($this->request->query() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }
        return $this->builder;
    }

    /**
     * @param $value
     * @return void
     */
    private function status($value): void
    {
        if (!empty($value)) {
            $this->builder->where('status', $value);
        }
    }

    /**
     * @param $value
     * @return void
     */
    private function trashed($value): void
    {
        if ('yes' === $value) {
            $this->builder->whereNotNull('deleted_at');
        }
    }
}