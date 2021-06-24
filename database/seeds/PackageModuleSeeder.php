<?php

use App\Module;
use App\SystemType;
use App\Package;
use App\PackageModule;
use Illuminate\Database\Seeder;

class PackageModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->delete();

        $modules = [
            [
                'id' => Module::ID_LOCALE_MANAGEMENT,
                'translation_key' => 'locale.management',
                'parent_id' => null,
                'usable_system_type_ids' => json_encode([SystemType::ID_ECOMMERCE, SystemType::ID_CORPORATE, SystemType::ID_NEWS, SystemType::ID_PROPERTY, SystemType::ID_CAR]),
                'is_active' => true,
            ],

            [
                'id' => Module::ID_CONTENT_MANAGEMENT,
                'translation_key' => 'content.management',
                'parent_id' => null,
                'usable_system_type_ids' => json_encode([SystemType::ID_ECOMMERCE, SystemType::ID_CORPORATE, SystemType::ID_NEWS, SystemType::ID_PROPERTY, SystemType::ID_CAR]),
                'is_active' => true,
            ],
            [
                'id' => Module::ID_MENU_MANAGEMENT,
                'translation_key' => 'menu.management',
                'parent_id' => Module::ID_CONTENT_MANAGEMENT,
                'usable_system_type_ids' => json_encode([SystemType::ID_ECOMMERCE, SystemType::ID_CORPORATE, SystemType::ID_NEWS, SystemType::ID_PROPERTY, SystemType::ID_CAR]),
                'is_active' => true,
            ],
            [
                'id' => Module::ID_SLIDER_MANAGEMENT,
                'translation_key' => 'slider.management',
                'parent_id' => Module::ID_CONTENT_MANAGEMENT,
                'usable_system_type_ids' => json_encode([SystemType::ID_ECOMMERCE, SystemType::ID_CORPORATE, SystemType::ID_NEWS, SystemType::ID_PROPERTY, SystemType::ID_CAR]),
                'is_active' => true,
            ],
            [
                'id' => Module::ID_PAGE_MANAGEMENT,
                'translation_key' => 'page.management',
                'parent_id' => Module::ID_CONTENT_MANAGEMENT,
                'usable_system_type_ids' => json_encode([SystemType::ID_ECOMMERCE, SystemType::ID_CORPORATE, SystemType::ID_NEWS, SystemType::ID_PROPERTY, SystemType::ID_CAR]),
                'is_active' => true,
            ],

            [
                'id' => Module::ID_PRODUCT_MANAGEMENT,
                'translation_key' => 'product.management',
                'parent_id' => null,
                'usable_system_type_ids' => json_encode([SystemType::ID_ECOMMERCE, SystemType::ID_CORPORATE]),
                'is_active' => true,
            ],
            [
                'id' => Module::ID_BRAND_MANAGEMENT,
                'translation_key' => 'brand.management',
                'parent_id' => Module::ID_PRODUCT_MANAGEMENT,
                'usable_system_type_ids' => json_encode([SystemType::ID_ECOMMERCE, SystemType::ID_CORPORATE]),
                'is_active' => true,
            ],
            [
                'id' => Module::ID_CATEGORY_MANAGEMENT,
                'translation_key' => 'category.management',
                'parent_id' => Module::ID_PRODUCT_MANAGEMENT,
                'usable_system_type_ids' => json_encode([SystemType::ID_ECOMMERCE, SystemType::ID_CORPORATE]),
                'is_active' => true,
            ],
            [
                'id' => Module::ID_TAX_RATE_MANAGEMENT,
                'translation_key' => 'tax_rate.management',
                'parent_id' => Module::ID_PRODUCT_MANAGEMENT,
                'usable_system_type_ids' => json_encode([SystemType::ID_ECOMMERCE, SystemType::ID_CORPORATE]),
                'is_active' => true,
            ],
            [
                'id' => Module::ID_CURRENCY_MANAGEMENT,
                'translation_key' => 'currency.management',
                'parent_id' => Module::ID_PRODUCT_MANAGEMENT,
                'usable_system_type_ids' => json_encode([SystemType::ID_ECOMMERCE, SystemType::ID_CORPORATE]),
                'is_active' => true,
            ],

            [
                'id' => Module::ID_USER_MANAGEMENT,
                'translation_key' => 'user.management',
                'parent_id' => null,
                'usable_system_type_ids' => json_encode([SystemType::ID_ECOMMERCE]),
                'is_active' => true,
            ],
            [
                'id' => Module::ID_CUSTOMER_MANAGEMENT,
                'translation_key' => 'customer.management',
                'parent_id' => Module::ID_USER_MANAGEMENT,
                'usable_system_type_ids' => json_encode([SystemType::ID_ECOMMERCE]),
                'is_active' => true,
            ],
            [
                'id' => Module::ID_ADMIN_MANAGEMENT,
                'translation_key' => 'staff.management',
                'parent_id' => Module::ID_USER_MANAGEMENT,
                'usable_system_type_ids' => json_encode([SystemType::ID_ECOMMERCE, SystemType::ID_CORPORATE, SystemType::ID_NEWS, SystemType::ID_PROPERTY, SystemType::ID_CAR]),
                'is_active' => true,
            ],
            [
                'id' => Module::ID_ROLE_MANAGEMENT,
                'translation_key' => 'customer.management',
                'parent_id' => Module::ID_USER_MANAGEMENT,
                'usable_system_type_ids' => json_encode([SystemType::ID_ECOMMERCE, SystemType::ID_CORPORATE, SystemType::ID_NEWS, SystemType::ID_PROPERTY, SystemType::ID_CAR]),
                'is_active' => true,
            ],
        ];

        foreach ($modules as $module) {
            Module::create($module);
        }

        DB::table('packages')->delete();

        $packages = [
            [
                'id' => Package::ID_ALL_PROPERTIES,
                'system_type_id' => SystemType::ID_ECOMMERCE,
                'translation_key' => 'all_properties',
                'module_ids' => json_encode([
                    Module::ID_LOCALE_MANAGEMENT,
                    Module::ID_CONTENT_MANAGEMENT,
                    Module::ID_MENU_MANAGEMENT,
                    Module::ID_SLIDER_MANAGEMENT,
                    Module::ID_PAGE_MANAGEMENT,
                    Module::ID_PRODUCT_MANAGEMENT,
                    Module::ID_BRAND_MANAGEMENT,
                    Module::ID_CATEGORY_MANAGEMENT,
                    Module::ID_TAX_RATE_MANAGEMENT,
                    Module::ID_CURRENCY_MANAGEMENT,
                    Module::ID_USER_MANAGEMENT,
                    Module::ID_CUSTOMER_MANAGEMENT,
                    Module::ID_ADMIN_MANAGEMENT,
                    Module::ID_ROLE_MANAGEMENT,
                ]),
                'is_active' => true,
                'created_at' => \Carbon\Carbon::now(),
            ],
        ];

        Package::insert($packages);
    }
}
