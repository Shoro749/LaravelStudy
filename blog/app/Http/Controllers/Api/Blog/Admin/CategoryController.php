<?php

namespace App\Http\Controllers\Api\Blog\Admin;

use App\Models\BlogCategory;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use Illuminate\Support\Str;
use Illuminate\Database\UniqueConstraintViolationException;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//      dd(__METHOD__);
        $paginator = BlogCategory::paginate(5);

        return $paginator;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->all();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

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
    public function show(string $id)
    {
        dd(__METHOD__);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        $item = BlogCategory::find($id);

        if (empty($item)) { //якщо ід не знайдено
            return ['message' => "Запис id=[{$id}] не знайдено"];
        }

        $data = $request->all(); //отримаємо масив даних, які надійшли з форми

        if (empty($data['slug'])) { //якщо псевдонім порожній
            $data['slug'] = Str::slug($data['title']); //генеруємо псевдонім
        }

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

    }
}
