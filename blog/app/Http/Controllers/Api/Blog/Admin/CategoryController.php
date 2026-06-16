<?php

namespace App\Http\Controllers\Api\Blog\Admin;

use App\Http\Resources\Api\Blog\Admin\CategoryResource;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Database\UniqueConstraintViolationException;

class CategoryController extends BaseController
{
    public function __construct(private BlogCategoryRepository $blogCategoryRepository)
    {
        //parent::__construct();

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//      dd(__METHOD__);
//        $paginator = BlogCategory::paginate(5);
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(5);
        return CategoryResource::collection($paginator);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->all();

        try {
            $item = BlogCategory::create($data);

            if ($item) {
                return [
                    'success' => true,
                    'message' => 'Категорію успішно створено',
                    'data' => $item
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Помилка створення категорії'
                ];
            }

        } catch (UniqueConstraintViolationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Помилка збереження: категорія з таким псевдонімом (slug) або назвою вже існує в базі даних.'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = $this->blogCategoryRepository->getEdit($id);

        if (empty($item)) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return new CategoryResource($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
//        $item = BlogCategory::find($id);
        $item = $this->blogCategoryRepository->getEdit($id);

        if (empty($item)) { //якщо ід не знайдено
            return ['message' => "Запис id=[{$id}] не знайдено"];
        }

        $data = $request->all(); //отримаємо масив даних, які надійшли з форми

        try {
            $result = $item->update($data);  //оновлюємо дані об'єкта і зберігаємо в БД

            if ($result) {
                return [
                    'success' => true,
                    'message' => 'Категорію успішно змінено',
                    'data' => $item
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Помилка редагування категорії'
                ];
            }

        } catch (UniqueConstraintViolationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Помилка редагуванння: категорія з таким псевдонімом (slug) або назвою вже існує в базі даних.'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = BlogCategory::destroy($id); //софт деліт, запис лишається

        //$result = BlogPost::find($id)->forceDelete(); //повне видалення з БД

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => "Запис id=[{$id}] успішно видалено"
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Помилка при видаленні запису'
            ], 500);
        }
    }
}
