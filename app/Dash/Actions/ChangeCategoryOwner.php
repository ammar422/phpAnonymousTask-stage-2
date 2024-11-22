<?php

namespace App\Dash\Actions;

use Dash\Extras\Inspector\Action;

class ChangeCategoryOwner extends Action
{

	/**
	 * options to do some action with type message
	 * like danger,info,warning,success
	 * @return array<string>
	 */
	public static function options()
	{
		//Example
		return [
			'owner_id' => [
				1 => [
					'success' => 'changed to admin',
				],
				2 => [
					'success' => 'chnaged to user',
				]
			],
		];
	}
}
