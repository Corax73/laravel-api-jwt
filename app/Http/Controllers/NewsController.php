<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsCreateRequest;
use App\Http\Requests\NewsDestroyRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Models\News;
use App\Repositories\NewsRepository;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Returns all news.
     * @return \Illuminate\Http\Response
     */
    public function index(): \Illuminate\Http\Response
    {
        return response(NewsRepository::getAllNews());
    }

    /**
     * Returns one news by id.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id): \Illuminate\Http\Response
    {
        return response(NewsRepository::getOneNews($id));
    }

    /**
     * Creates news based on data from the request.
     * @param App\Http\Requests\NewsCreateRequest
     * @return \Illuminate\Http\Response
     */
    public function store(NewsCreateRequest $request): \Illuminate\Http\Response
    {
        $validatedData = $request->validated();
        $resp = NewsRepository::createNews(array_merge($validatedData, ['user_id' => auth()->user()->id])) ?
            ['message' => 'News created.'] : ['message' => 'Try again.'];
        return response($resp);
    }

    /**
     * Updates the news by id and fields from the request.
     * @param int $id
     * @param App\Http\Requests\NewsUpdateRequest
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, NewsUpdateRequest $request): \Illuminate\Http\Response
    {
        $validatedData = $request->validated();
        $resp = NewsRepository::updateNews($id, $validatedData) ?
            ['message' => 'News updated.'] : ['message' => 'Try again.'];
        return response($resp);
    }

    /**
     * Deletes news by id.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id, NewsDestroyRequest $request): \Illuminate\Http\Response
    {
        $resp = NewsRepository::deleteNews($id) ?
            ['message' => 'News deleted.'] : ['message' => 'Try again.'];
        return response($resp);
    }
}
