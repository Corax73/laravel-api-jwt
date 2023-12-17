<?php

namespace App\Repositories;

use App\Models\News;

class NewsRepository
{
    /**
     * Returns an array of all news.
     * @return array
     */
    public static function getAllNews(): array
    {
        return News::orderBy('id', 'desc')->get()->toArray();
    }

    /**
     * Returns an array with one news.
     * @param int $id
     * @return array
     */
    public static function getOneNews(int $id): array
    {
        return News::findOrFail($id)->toArray();
    }

    /**
     * Creates news.
     * @param array $validatedData
     * @return bool
     */
    public static function createNews(array $validatedData): bool
    {
        $news = new News($validatedData);
        return $news->saveOrFail();
    }

    /**
     * Updates the news.
     * @param int $id
     * @param array $validatedData
     * @return bool
     */
    public static function updateNews(int $id, array $validatedData): bool
    {
        $news = News::findOrFail($id);
        return $news->update($validatedData);
    }

    /**
     * Deletes news.
     * @param int $id
     * @return bool
     */
    public static function deleteNews(int $id): bool
    {
        $news = News::findOrFail($id);
        return (bool)($news->delete());
    }
}
