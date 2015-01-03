<?php

class FriendsController extends BaseController {

	/**
	 * Store a newly created friend in storage.
	 *
	 * @return Response
	 */
	public function create()
	{
		$input = Input::only(['user_id','friend_id']);
		$validator = Validator::make($input, Friend::$rules);

		if ($validator->fails())
		{
			return null;
		}

		return Friend::create($input);
	}

	/**
	 * Get all your friends.
	 *
	 * @return Response
	 */
	public function friendsList()
	{
		$friends = [];
		$friends_count = 0;

		$results = DB::table('friends')->where('user_id', Auth::user()->id)->get();
		foreach($results as $friend){
			$user = User::find($friend->friend_id);
			$person = Person::where('user_id', '=', $user->id)->first();
			if($user && $person){
				$friends[$friends_count] = ['name'=>$user->username, 'img_src'=>$person->photo];
				$friends_count++;
			}
		}
		unset($friend);
		
		$results = DB::table('friends')->where('friend_id', Auth::user()->id)->get();
		foreach($results as $friend){
			$user = User::find($friend->user_id);
			$person = Person::where('user_id', '=', $user->id)->first();
			if($user && $person){
				$friends[$friends_count] = ['name'=>$user->username, 'img_src'=>$person->photo];
				$friends_count++;
			}
		}

		return $friends;
	}

}
