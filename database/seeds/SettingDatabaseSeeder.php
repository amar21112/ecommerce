<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::setMany([
            'default_locale' => 'ar',
            'default_timezone' => 'Africa/cairo',
            'reviews_enabled' => true,
            'auto_approve_reviews' => true,
            'supported_currencies' => ['USD' , 'LE' ,'SAR'],
            'default_currency' => 'USD',
            'store_email' => 'admin@ecommerce.com' ,
            'search_engine' => 'mysql',

            'locale_shipping_cost' => 0,
            'outer_shipping_cost' => 0,
            'free_shipping_cost' => 0,
            'translatable' => [
                'store_name' => 'Ammar Store' ,
                'free_shipping_label' => 'Free Shipping' ,
                'locale_shipping_label' => 'Locale Label' ,
                'outer_shipping_label' => 'Outer Label' ,

            ]
        ]);
    }
}
