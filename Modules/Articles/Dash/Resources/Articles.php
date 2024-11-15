<?php

namespace Modules\Articles\app\Dash\Resources;

use Dash\Resource;
use Modules\Articles\Entities\Article;

class Articles extends Resource
{

	/**
	 * define Model of resource
	 * @var string $model
	 */
	public static $model = Article::class;

	/**
	 * Policy Permission can handel
	 * (viewAny,view,create,update,delete,forceDelete,restore) methods
	 * @var string $policy
	 */
	//public static $policy = UserPolicy::class;

	/**
	 * define this resource in group to show in navigation menu
	 * if you need to translate a dynamic name
	 * define dash.php in /resources/views/lang/en/dash.php
	 * and add this key directly users
	 * @var string $group
	 */
	public static $group = 'Articles';

	/**
	 * show or hide resouce In Navigation Menu true|false
	 * @var bool $displayInMenu
	 */
	public static $displayInMenu = true;

	/**
	 * change icon in navigation menu
	 * you can use font awesome icons LIKE (<i class="fa fa-users"></i>)
	 * @var string $icon
	 */
	public static $icon = ''; // put <i> tag or icon name

	/**
	 * title static property to labels in Rows,Show,Forms
	 * @var string $title
	 */
	public static $title = 'name';

	/**
	 * defining column name to enable or disable search in main resource page
	 * @var array<string> $search
	 */
	public static $search = [
		'id',
		'name',
	];

	/**
	 *  if you want define relationship searches
	 *  one or Multiple Relations
	 * 	Example: method=> 'invoices'  => columns=>['title'],
	 * @var array<string> $searchWithRelation
	 */
	public static $searchWithRelation = [];

	/**
	 * if you need to custom resource name in menu navigation
	 * @return string
	 */
	public static function customName()
	{
		return 'Articles';
	}

	/**
	 * you can define vertext in header of page like (Card,HTML,view blade)
	 * @return array<string>
	 */
	public static function vertex()
	{
		return [];
	}

	/**
	 * define fields by Helpers
	 * @return array<string>
	 */
	public function fields()
	{
		return [
			id(__('dash::dash.id'), 'id'),
			text(__('dash::dash.title'), 'title'),
			textarea(__('dash::dash.content'), 'content'),
			belongsTo()->make('Category', 'category', Article::class)->rule('required', 'numeric', 'exists:categories,id'),
			belongsTo()->make('Author', 'author', Article::class)->rule('required', 'numeric', 'exists:users,id'),
			text(__('dash::dash.category'), 'category_id')->rule('required', 'numeric', 'exists:categories,id'),
			text('slug', 'slug')->onlyForms(),
		];
	}

	/**
	 * define the actions To Using in Resource (index,show)
	 * php artisan dash:make-action ActionName
	 * @return array<string>
	 */
	public function actions()
	{
		return [];
	}

	/**
	 * define the filters To Using in Resource (index)
	 * php artisan dash:make-filter FilterName
	 * @return array<string>
	 */
	public function filters()
	{
		return [];
	}
}
