<?php

namespace App\Dash\Metrics\Values;

use Dash\Extras\Metrics\Value;
use Modules\Categories\Entities\Category;

class Categories extends Value
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
                $query->where('status', true);
            })
            // ->at('created_at') // optional
            ->column(6) // optional
            ->href(dash('resource/Categories'))
            ->icon('<i class="fa fa-book"></i>') // icon by fontawesome or other | optional
            ->title('All active Categories') // optional
            // ->subTitle('Your subTitle') // optional
            //  ->textBody('Text In Body') // optional
            ->prefix('<i class="fa fa-class"></i> ') // add prefix before number or icon
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
