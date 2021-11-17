<?php

namespace App\ElasticRepository;

use Illuminate\Database\Eloquent\Collection;

interface ArticlesRepositoryInterface
{
    public function search(string $query = ''): Collection;
}

?>