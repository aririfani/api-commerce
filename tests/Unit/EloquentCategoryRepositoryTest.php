<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class EloquentCategoryRepositoryTest extends TestCase
{
    protected $category;
    protected $categoryRepositoryMock;
    protected $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->category = new Category(['name' => 'Food', 'enable' => true]);
        $this->categoryRepositoryMock = $this->createMock(CategoryRepository::class);
        $this->repository = new EloquentCatetgoryRepository($this->categoryRepository);
    }

    /**
     * A basic unit test example.
     */
    public function test_create_category_success(): void
    {
        $this->categoryRepositoryMock->expects($this->once())
            ->method('create')
            ->with([
                'name' => 'food',
                'enable' => true
            ])
            ->willReturn($this->category);

        $result = $this->repository->create([
            'name' => 'food',
            'enable' => true
        ]);

        $this->assertEquals('food', $result->name);
        $this->assertEquals('enable', $result->enable);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        unset($this->category);
        unset($this->categoryRepositoryMock);
        unset($this->repository);
    }
}
