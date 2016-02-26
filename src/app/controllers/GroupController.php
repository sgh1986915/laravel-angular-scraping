<?php

use Authority\Repo\Group\GroupInterface;
use Authority\Service\Form\Group\GroupForm;

class GroupController extends BaseController {

	/**
	 * Member Vars
	 */
	protected $group;
	protected $groupForm;

	/**
	 * Constructor
	 */
	public function __construct(GroupInterface $group, GroupForm $groupForm) 
	{
		$this->group = $group;
		$this->groupForm = $groupForm;

		// Establish Filters
		$this->beforeFilter('inGroup:Admins');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$groups = $this->group->all();
		return View::make('groups.index')->with('groups', $groups);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//Form for creating a new Group
		return View::make('groups.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Form Processing
        $result = $this->groupForm->save( Input::all() );

        if( $result['success'] )
        {
            // Success!
            Session::flash('success', $result['message']);
            return Redirect::to('/groups');

        } else {
            Session::flash('error', $result['message']);
            return Redirect::action('GroupController@create')
                ->withInput()
                ->withErrors( $this->groupForm->errors() );
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show($id)
	{
		//Show a group and its permissions. 
		$group = $this->group->byId($id);

		return View::make('groups.show')->with('group', $group);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit($id)
	{
		$group = $this->group->byId($id);
		return View::make('groups.edit')->with('group', $group);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update($id)
	{
		// Form Processing
        $result = $this->groupForm->update( Input::all() );

        if( $result['success'] )
        {
            // Success!
            Session::flash('success', $result['message']);
            return Redirect::to('/groups');

        } else {
            Session::flash('error', $result['message']);
            return Redirect::action('GroupController@create')
                ->withInput()
                ->withErrors( $this->groupForm->errors() );
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		if ($this->group->destroy($id))
		{
			Session::flash('success', 'Group Deleted');
            return Redirect::to('/groups');
        }
        else 
        {
        	Session::flash('error', 'Unable to Delete Group');
            return Redirect::to('/groups');
        }
	}

}