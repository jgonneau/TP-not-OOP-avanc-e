<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\PostsBlog as ArticleEntity;
use App\Repository\PostsBlogRepository;

final class ArticleService
{
    private $repository;


    public function __construct(PostsBlogRepository $postsBlogRepository)
    {
        $this->repository = $postsBlogRepository;
    }

    public function find(string $value) : ArticleEntity
    {
        return $this->repository->find($value);
    }

    public function findBy(array $values) : array //Array of repository right??!
    {
        return $this->repository->findBy($values);
    }

    public function findAll() : array //Array of repository right??!
    {
        return $this->repository->findAll();
    }
}