<?php


namespace App\Traits;

use Illuminate\Support\Str;

/**
 * Linkable Trait Create links for Current Model
 * @package App\Traits
 */
trait Linkable
{
    /**
     * @return string
     */
    public function editLink(): string
    {
        return route("admin.{$this->table}.edit", [Str::camel(Str::singular($this->table)) => $this->id]);
    }

    /**
     * @return string
     */
    public function updateLink(): string
    {
        return route("admin.{$this->table}.update", [Str::camel(Str::singular($this->table)) => $this->id]);
    }

    /**
     * @return string
     */
    public function deleteLink(): string
    {
        return route("admin.{$this->table}.destroy", [Str::camel(Str::singular($this->table)) => $this->id]);
    }

    /**
     * @return string
     */
    public function transactionHistoriesLink(): string
    {
        return route("admin.{$this->table}.histories", ['subject_id' => $this->id]);
    }
}
