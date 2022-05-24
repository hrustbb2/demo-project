<?php

namespace App\Models\Interfaces\JsonObjects;

interface ISeoOptions {
    public function getTitle(): string;
    public function getDescription(): string;
}