<?php

class LibrariesController extends \BaseController {

	/**
	 * Display a listing of libraries
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('libraries.index');
	}

	/**
	 * Show the form for creating a new library
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('libraries.create');
	}

	/**
	 * Store a newly created library in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data["user_id"] 	= intval(Sentry::getUser()->id);
		$data["thumbnail"] 	= Input::get('thumbnail');
		$data["src"] 		= Input::get('src');
		$data["type"] 		= Input::get('type');

		$validator = Validator::make($data, Library::$rules);

		if ($validator->fails())
		{
			return $validator->messages()->toJson();
		}

		return Library::create($data);

	}

	/**
	 * Display the specified library.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$library = Library::findOrFail($id);

		return View::make('libraries.show', compact('library'));
	}

	/**
	 * Show the form for editing the specified library.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$library = Library::find($id);

		return View::make('libraries.edit', compact('library'));
	}

	/**
	 * Update the specified library in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$library = Library::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Library::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		return $library->update($data);
	}

	/**
	 * Remove the specified library from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return Library::destroy($id);
	}

}
