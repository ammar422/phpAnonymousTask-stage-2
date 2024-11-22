<?php

namespace Modules\Categories\app\Dash\Resources;

use Dash\Resource;
use App\Dash\Resources\Users;
use App\Dash\Filters\CategoryOwner;
use Modules\Categories\Entities\Category;
use App\Dash\Actions\ChangeCategoryStatus;
use App\Dash\Metrics\Values\Categories as ValuesCategories;
use App\Dash\Metrics\Values\CategoriesHasSaubiscripers;
use App\Dash\Metrics\Values\EmptyCategory;
use App\Dash\Metrics\Values\InactiveCategory;

class Categories extends Resource
{


	/**
	 * define Model of resource
	 * @var string $model
	 */
	public static $model = Category::class;

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
	public static $group = 'Categories';

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
	public static $searchWithRelation = [
		'user' => ['name']
	];

	/**
	 * if you need to custom resource name in menu navigation
	 * @return string
	 */
	public static function customName()
	{
		return 'Categories';
	}

	/**
	 * you can define vertext in header of page like (Card,HTML,view blade)
	 * @return array<string>
	 */
	public static function vertex()
	{
		return [
			(new ValuesCategories)->render(),
			(new InactiveCategory)->render(),
			(new EmptyCategory)->render(),
			(new CategoriesHasSaubiscripers)->render()
		];
	}

	/**
	 * define fields by Helpers
	 * @return array<string>
	 */
	public function fields()
	{
		return [
			// id(__('dash::dash.id'), 'id'),
			id()->make('category index', 'id')->orderable(false),


			// text(__('dash::dash.name'), 'name'),
			text()->make('category name', 'name')
				->ruleWhenCreate('required')
				->ruleWhenUpdate('nullable'),


			// text(__('dash::dash.description'), 'description'),
			// text()->make('category description', 'description')->rule('required'),
			ckeditor()->make('category description', 'description')
				->hideInIndex(),


			image()->make('category image', 'image')
				->path('category/image')
				->rule(
					'required',
					'image'
					// )->accept('image/*')->disableDownloadButton() -> deleteable(false),
				)->accept('image/*')->disableDownloadButton(),


			text('slug', 'slug')
				->rule('required')->onlyForms(),
			// text('sttaus', 'slug'),

			text('category status', 'status'),

			dropzone()->make('upload file')
				->maxFiles(3)
				->maxFileSize(.5)
				->acceptedMimeTypes('image/*', 'video/*')
				->hideInIndex(),


			belongsTo('owner name', 'user', Users::class)
				// ->inlineButton()
				// ->inline()
				->viewColumns('email')
				->query(function ($model) {
					return $model::where('account_type', 'admin');
				}),


			hasMany('subscribers', 'users', Users::class),


			// fullDateTime('creation date' , 'created_at' )->onlyIndex()
			// fullTime('creation date' , 'created_at' )->inline()
			fullTime('creation date', 'created_at')->weekNumbers()
			// fullTime('creation date' , 'created_at' )->allowInput()
			// month('creation date' , 'created_at' )->onlyIndex()
		];
	}

	/**
	 * define the actions To Using in Resource (index,show)
	 * php artisan dash:make-action ActionName
	 * @return array<string>
	 */
	public function actions()
	{
		return [
			ChangeCategoryStatus::class,
			// ChangeCategoryOwner::class,
		];
	}

	/**
	 * define the filters To Using in Resource (index)
	 * php artisan dash:make-filter FilterName
	 * @return array<string>
	 */
	public function filters()
	{
		return [
			CategoryOwner::class,
		];
	}


	public static function dtButtons()
	{
		return [
			'pageLength',
			'collection',
			'colvis',
			'colvisRestore',
			'columnsToggle',
			'colvisGroup',
			'pdf',
			'csv',
			[
				'extend' => 'print',
				'text' => 'Print',
				'key' => ['key' => 'p', 'altkey' => true]
			],
			[
				'extend' => 'excel',
				'text' => 'Execl',
				'key' => ['key' => 'x', 'altkey']
			],
			[
				'extend' => 'copy',
				'text' => 'Copy',
				'key' => ['key' => 'c', 'altkey' => true]

			],

		];
	}

	// public static $paging = false;
	public static $pagingType = 'numbers';
	// public static $pagingType = 'simple';
	public static $lengthMenu = [10];
	// public static $ordering = false;
}
