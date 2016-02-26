<?php

class FavoritesController extends \BaseController {

	/**
	 * Display a listing of favorites
	 *
	 * @return Response
	 */
	public function index()
	{
		$favorites = Favorites::all();

		return View::make('favorites.index', compact('favorites'));
	}

	/**
	 * Show the form for creating a new favorite
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('favorites.create');
	}

	/**
	 * Store a newly created favorite in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$data["user_id"] = intval(Sentry::getUser()->id);
		$data["keyword"] = Input::get('keyword');

		$validator = Validator::make($data, Favorites::userRules(Sentry::getUser()->id));


		if ($validator->fails())
		{
			return $validator->messages()->toJson();
		}


		$favorite = Favorites::create($data);

		return $favorite;
	}

	/**
	 * Display the specified favorite.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$favorite = Favorites::findOrFail($id);

		return View::make('favorites.show', compact('favorite'));
	}

	/**
	 * Show the form for editing the specified favorite.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$favorite = Favorites::find($id);

		return View::make('favorites.edit', compact('favorite'));
	}

	/**
	 * Update the specified favorite in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$favorite = Favorites::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Favorites::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$favorite->update($data);

		return Redirect::route('favorites.index');
	}

	/**
	 * Remove the specified favorite from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return Favorites::destroy($id);
	}

}
