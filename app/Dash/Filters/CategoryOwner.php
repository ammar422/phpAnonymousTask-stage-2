<?php

namespace App\Dash\Filters;

use Dash\Extras\Inspector\Filter;
use Modules\Categories\Entities\Category;

class CategoryOwner extends Filter
{

	/**
	 * use this optional label to set custom name or can remove
	 * it to automatic using label from resource
	 * @return string
	 */
	public static function label()
	{
		return 'Category Status'; // you can use trans
	}


	/**
	 * options method to set a options
	 * for filtration data in index page in resource
	 * you can use Model with Pluck Example: User::pluck('name','id')
	 * @return array<string>
	 */
	public static function options()
	{
		return [
			'owner_id' => Category::pluck('id', 'owner_id'), // first Column
			'status'   => [
				1    => 'active', // you can use trans
				0  => 'inactive',
			],
		];
	}
}
