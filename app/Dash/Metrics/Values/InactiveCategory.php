<?php

namespace App\Dash\Metrics\Values;

use Dash\Extras\Metrics\Value;
use Modules\Categories\Entities\Category;

class InactiveCategory extends Value
{

    /**
     * calculate method is short to calc to using in value
     * for more information about this visit https://phpdash.com/docs/1.x/Metrics#Value
     * @return $this->sum or count method
     *
     */
    public function calc()
    {
        return
            $this->count(Category::class, function ($query) {
                $query->where('status', false);
            }) // or sum // $this->sum(YourModel::class,'id') | id column is optional
            // ->at('created_at') // optional
            ->column(6) // optional
            // ->href(dash('resource/YourResourceOr Other Links'))
            ->icon('<i class="fa fa-flag"></i>') // icon by fontawesome or other | optional
            ->title('All Inactive Categories') // optional
            // ->subTitle('Your subTitle') // optional
            //  ->textBody('Text In Body') // optional
            // ->prefix('<i class="fa fa-user"></i> ') // add prefix before number or icon
            // ->suffix('Your suffix') // optional add suffix after number
        ;
    }

    /**
     * ranges
     * enable dropdown select to set range to count or sum data you can add more by days like 730
     * @return array<string>
     */
    public function ranges()
    {
        return [
            'all' => 'All',
            'today' => 'Today',
            'yesterday' => 'Yesterday',
            '3' => 'last 3 days',
            '4' => 'last 4 days',
            'week' => 'Week',
            'month' => 'month',
            'year' => 'year',
            '730' => '2 years',
        ];
    }
}
