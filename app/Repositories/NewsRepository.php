<?php

namespace App\Repositories;

use App\Models\News;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsRepository
{
    /**
     * Returns an array of all news.
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public static function getAllNews(): LengthAwarePaginator
    {
        return News::orderBy('id', 'desc')->paginate();
    }

    /**
     * Returns an array with one news.
     * @param int $id
     * @return array
     */
    public static function getOneNews(int $id): array
    {
        $resp = ['error' => 'not found'];
        $news = News::find($id);
        if($news) {
            $resp = $news->toArray();
        }
        return $resp;
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

    /**
     * Checks the keys in the argument and searches if present.
     * @param array $validatedData
     * @return array
     */
    public static function searchByTitleOrText(array $validatedData): array
    {
        if (isset($validatedData['title'])) {
            $title = $validatedData['title'];
        }
        if (isset($validatedData['text'])) {
            $text = $validatedData['text'];
        }
        if (isset($title)) {
            $resp = News::where('title', 'like', '%' . $title . '%');
        }
        if (isset($text)) {
            $resp = $resp->where('text', 'like', '%' . $text . '%');
        }
        return $resp->get()->toArray();
    }
}
