<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class IngredientController extends Controller
{
	public function index() : Response
	{
		$ingredients = Ingredient::all();

		return Inertia::render('cms/ingredients', ['ingredients' => $ingredients]);
	}

	public function create() : Response
	{
		// @TODO make create page
		return Inertia::render('cms/create_ingredient');
	}

	public function edit(int $id)
	{
		$ingredient = Ingredient::findOrFail($id);

		return Inertia::render('cms/ingredientEdit', ['ingredient' => $ingredient]);
	}

	public function store($request) : Response
	{
		$ingredient = Ingredient::make();

		return $this->update($request, $ingredient);
	}

	public function update(Request $request, Ingredient $ingredient) : Response
	{
		// @TODO create update function

		return $this->index();
	}

	public function destroy(Ingredient $ingredient) : Response
	{
		return $this->index();
	}
}
