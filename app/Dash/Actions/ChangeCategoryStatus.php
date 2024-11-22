<?php
namespace App\Dash\Actions;
use Dash\Extras\Inspector\Action;

class ChangeCategoryStatus extends Action {

	/**
	 * options to do some action with type message
	 * like danger,info,warning,success
	 * @return array<string>
	 */
	public static function options() {
		//Example
		return [
			'status' => [
				true => [
					'success' => 'category changed successfully to active ',
				],
				false => [
					'success' => 'category changed successfully to inactive',
				]
			],
		];
	}

}
