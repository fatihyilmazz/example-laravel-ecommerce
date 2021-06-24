<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $superAdminUser = Admin::find(Admin::ID_SUPER_ADMIN_USER);
        $adminUser = Admin::find(Admin::ID_ADMIN_USER);

        // A
        // Admin Permissions
        $listAdmins             = Permission::create(['guard_name' => 'admin', 'name' => 'list-admins']);
        $createAdmins           = Permission::create(['guard_name' => 'admin', 'name' => 'create-admins']);
        $viewAdmins             = Permission::create(['guard_name' => 'admin', 'name' => 'view-admins']);
        $updateAdmins           = Permission::create(['guard_name' => 'admin', 'name' => 'update-admins']);
        $deleteAdmins           = Permission::create(['guard_name' => 'admin', 'name' => 'delete-admins']);
        $viewAdminsHistories    = Permission::create(['guard_name' => 'admin', 'name' => 'view-admins-histories']);

        $adminPermissions = [$listAdmins, $createAdmins, $viewAdmins, $updateAdmins, $deleteAdmins, $viewAdminsHistories];

        // Activity Log Permissions
        $listActivityLogs = Permission::create(['guard_name' => 'admin', 'name' => 'list-activity-logs']);
        $viewActivityLogs = Permission::create(['guard_name' => 'admin', 'name' => 'view-activity-logs']);

        $activityLogPermissions = [$listActivityLogs, $viewActivityLogs];

        // B
        // Brand Permissions
        $listBrands             = Permission::create(['guard_name' => 'admin', 'name' => 'list-brands']);
        $createBrands           = Permission::create(['guard_name' => 'admin', 'name' => 'create-brands']);
        $viewBrands             = Permission::create(['guard_name' => 'admin', 'name' => 'view-brands']);
        $updateBrands           = Permission::create(['guard_name' => 'admin', 'name' => 'update-brands']);
        $deleteBrands           = Permission::create(['guard_name' => 'admin', 'name' => 'delete-brands']);
        $viewBrandsHistories    = Permission::create(['guard_name' => 'admin', 'name' => 'view-brands-histories']);

        $brandPermissions = [$listBrands, $createBrands, $viewBrands, $updateBrands, $deleteBrands, $viewBrandsHistories];

        // C
        // Category Permissions
        $listCountries          = Permission::create(['guard_name' => 'admin', 'name' => 'list-countries']);
        $createCountries        = Permission::create(['guard_name' => 'admin', 'name' => 'create-countries']);
        $viewCountries          = Permission::create(['guard_name' => 'admin', 'name' => 'view-countries']);
        $updateCountries        = Permission::create(['guard_name' => 'admin', 'name' => 'update-countries']);
        $deleteCountries        = Permission::create(['guard_name' => 'admin', 'name' => 'delete-countries']);
        $viewCountriesHistories = Permission::create(['guard_name' => 'admin', 'name' => 'view-countries-histories']);

        $countryPermissions = [$listCountries, $createCountries, $viewCountries, $updateCountries, $deleteCountries, $viewCountriesHistories];

        // Category Permissions
        $listCategories             = Permission::create(['guard_name' => 'admin', 'name' => 'list-categories']);
        $createCategories           = Permission::create(['guard_name' => 'admin', 'name' => 'create-categories']);
        $viewCategories             = Permission::create(['guard_name' => 'admin', 'name' => 'view-categories']);
        $updateCategories           = Permission::create(['guard_name' => 'admin', 'name' => 'update-categories']);
        $deleteCategories           = Permission::create(['guard_name' => 'admin', 'name' => 'delete-categories']);
        $viewCategoriesHistories    = Permission::create(['guard_name' => 'admin', 'name' => 'view-categories-histories']);

        $categoryPermissions = [$listCategories, $createCategories, $viewCategories, $updateCategories, $deleteCategories, $viewCategoriesHistories];

        // Currency Permissions
        $listCurrencies             = Permission::create(['guard_name' => 'admin', 'name' => 'list-currencies']);
        $createCurrencies           = Permission::create(['guard_name' => 'admin', 'name' => 'create-currencies']);
        $viewCurrencies             = Permission::create(['guard_name' => 'admin', 'name' => 'view-currencies']);
        $updateCurrencies           = Permission::create(['guard_name' => 'admin', 'name' => 'update-currencies']);
        $deleteCurrencies           = Permission::create(['guard_name' => 'admin', 'name' => 'delete-currencies']);
        $viewCurrenciesHistories    = Permission::create(['guard_name' => 'admin', 'name' => 'view-currencies-histories']);

        $currencyPermissions = [$listCurrencies, $createCurrencies, $viewCurrencies, $updateCurrencies, $deleteCurrencies, $viewCurrenciesHistories];

        // D
        // District Permissions
        $listDistricts          = Permission::create(['guard_name' => 'admin', 'name' => 'list-districts']);
        $createDistricts        = Permission::create(['guard_name' => 'admin', 'name' => 'create-districts']);
        $viewDistricts          = Permission::create(['guard_name' => 'admin', 'name' => 'view-districts']);
        $updateDistricts        = Permission::create(['guard_name' => 'admin', 'name' => 'update-districts']);
        $deleteDistricts        = Permission::create(['guard_name' => 'admin', 'name' => 'delete-districts']);
        $viewDistrictsHistories = Permission::create(['guard_name' => 'admin', 'name' => 'view-districts-histories']);

        $districtPermissions = [$listDistricts, $createDistricts, $viewDistricts, $updateDistricts, $deleteDistricts, $viewDistrictsHistories];

        // E
        // F
        // File Setting Permissions
        $listFileSettings  = Permission::create(['guard_name' => 'admin', 'name' => 'list-file-settings']);
        $updateFileSetting = Permission::create(['guard_name' => 'admin', 'name' => 'update-file-settings']);

        $fileSettingPermissions = [$listFileSettings, $updateFileSetting];

        // G
        // General Configuration Permissions
        $listGeneralConfigurations      = Permission::create(['guard_name' => 'admin', 'name' => 'list-general-configurations']);
        $updateGeneralConfigurations    = Permission::create(['guard_name' => 'admin', 'name' => 'update-general-configurations']);

        $generalConfigurationPermissions = [$listGeneralConfigurations, $updateGeneralConfigurations];

        // H
        // I
        // Image Setting Permissions
        $listImageSettings  = Permission::create(['guard_name' => 'admin', 'name' => 'list-image-settings']);
        $updateImageSetting = Permission::create(['guard_name' => 'admin', 'name' => 'update-image-settings']);

        $imageSettingPermissions = [$listImageSettings, $updateImageSetting];
        // J
        // K
        // L
        // Locale Permissions
        $listLocales            = Permission::create(['guard_name' => 'admin', 'name' => 'list-locales']);
        $viewLocales            = Permission::create(['guard_name' => 'admin', 'name' => 'view-locales']);
        $updateLocales          = Permission::create(['guard_name' => 'admin', 'name' => 'update-locales']);
        $viewLocalesHistories   = Permission::create(['guard_name' => 'admin', 'name' => 'view-locales-histories']);

        $localePermissions = [$listLocales, $viewLocales, $updateLocales, $viewLocalesHistories];

        // M
        // Menu Permissions
        $listMenus          = Permission::create(['guard_name' => 'admin', 'name' => 'list-menus']);
        $createMenus        = Permission::create(['guard_name' => 'admin', 'name' => 'create-menus']);
        $viewMenus          = Permission::create(['guard_name' => 'admin', 'name' => 'view-menus']);
        $updateMenus        = Permission::create(['guard_name' => 'admin', 'name' => 'update-menus']);
        $deleteMenus        = Permission::create(['guard_name' => 'admin', 'name' => 'delete-menus']);
        $viewMenusHistories = Permission::create(['guard_name' => 'admin', 'name' => 'view-menus-histories']);

        $menuPermissions = [$listMenus, $createMenus, $viewMenus, $updateMenus, $deleteMenus, $viewMenusHistories];

        // Menu Group Permissions
        $listMenuGroups             = Permission::create(['guard_name' => 'admin', 'name' => 'list-menu-groups']);
        $createMenuGroups           = Permission::create(['guard_name' => 'admin', 'name' => 'create-menu-groups']);
        $viewMenuGroups             = Permission::create(['guard_name' => 'admin', 'name' => 'view-menu-groups']);
        $updateMenuGroups           = Permission::create(['guard_name' => 'admin', 'name' => 'update-menu-groups']);
        $deleteMenuGroups           = Permission::create(['guard_name' => 'admin', 'name' => 'delete-menu-groups']);
        $viewMenuGroupsHistories    = Permission::create(['guard_name' => 'admin', 'name' => 'view-menu-groups-histories']);

        $menuGroupPermissions = [$listMenuGroups, $createMenuGroups, $viewMenuGroups, $updateMenuGroups, $deleteMenuGroups, $viewMenuGroupsHistories];

        // N
        // O
        // P
        // Page Permissions
        $listPages          = Permission::create(['guard_name' => 'admin', 'name' => 'list-pages']);
        $createPages        = Permission::create(['guard_name' => 'admin', 'name' => 'create-pages']);
        $viewPages          = Permission::create(['guard_name' => 'admin', 'name' => 'view-pages']);
        $updatePages        = Permission::create(['guard_name' => 'admin', 'name' => 'update-pages']);
        $deletePages        = Permission::create(['guard_name' => 'admin', 'name' => 'delete-pages']);
        $viewPagesHistories = Permission::create(['guard_name' => 'admin', 'name' => 'view-pages-histories']);

        $pagePermissions = [$listPages, $createPages, $viewPages, $updatePages, $deletePages, $viewPagesHistories];

        // Product Permissions
        $listProducts           = Permission::create(['guard_name' => 'admin', 'name' => 'list-products']);
        $createProducts         = Permission::create(['guard_name' => 'admin', 'name' => 'create-products']);
        $viewProducts           = Permission::create(['guard_name' => 'admin', 'name' => 'view-products']);
        $updateProducts         = Permission::create(['guard_name' => 'admin', 'name' => 'update-products']);
        $deleteProducts         = Permission::create(['guard_name' => 'admin', 'name' => 'delete-products']);
        $viewProductsHistories  = Permission::create(['guard_name' => 'admin', 'name' => 'view-products-histories']);

        $productPermissions = [$listProducts, $createProducts, $viewProducts, $updateProducts, $deleteProducts, $viewProductsHistories];

        // Province Permissions
        $listProvinces          = Permission::create(['guard_name' => 'admin', 'name' => 'list-provinces']);
        $createProvinces        = Permission::create(['guard_name' => 'admin', 'name' => 'create-provinces']);
        $viewProvinces          = Permission::create(['guard_name' => 'admin', 'name' => 'view-provinces']);
        $updateProvinces        = Permission::create(['guard_name' => 'admin', 'name' => 'update-provinces']);
        $deleteProvinces        = Permission::create(['guard_name' => 'admin', 'name' => 'delete-provinces']);
        $viewProvincesHistories = Permission::create(['guard_name' => 'admin', 'name' => 'view-provinces-histories']);

        $provincePermissions = [$listProvinces, $createProvinces, $viewProvinces, $updateProvinces, $deleteProvinces, $viewProvincesHistories];

        // Q
        // R
        // S
        // Stock Unit Permissions
        $listSliders            = Permission::create(['guard_name' => 'admin', 'name' => 'list-sliders']);
        $createSliders          = Permission::create(['guard_name' => 'admin', 'name' => 'create-sliders']);
        $viewSliders            = Permission::create(['guard_name' => 'admin', 'name' => 'view-sliders']);
        $updateSliders          = Permission::create(['guard_name' => 'admin', 'name' => 'update-sliders']);
        $deleteSliders          = Permission::create(['guard_name' => 'admin', 'name' => 'delete-sliders']);
        $viewSlidersHistories   = Permission::create(['guard_name' => 'admin', 'name' => 'view-sliders-histories']);

        $sliderPermissions = [$listSliders, $createSliders, $viewSliders, $updateSliders, $deleteSliders, $viewSlidersHistories];

        // Stock Unit Permissions
        $listStockUnits             = Permission::create(['guard_name' => 'admin', 'name' => 'list-stock-units']);
        $createStockUnits           = Permission::create(['guard_name' => 'admin', 'name' => 'create-stock-units']);
        $viewStockUnits             = Permission::create(['guard_name' => 'admin', 'name' => 'view-stock-units']);
        $updateStockUnits           = Permission::create(['guard_name' => 'admin', 'name' => 'update-stock-units']);
        $deleteStockUnits           = Permission::create(['guard_name' => 'admin', 'name' => 'delete-stock-units']);
        $viewStockUnitsHistories    = Permission::create(['guard_name' => 'admin', 'name' => 'view-stock-units-histories']);

        $stockUnitPermissions = [$listStockUnits, $createStockUnits, $viewStockUnits, $updateStockUnits, $deleteStockUnits, $viewStockUnitsHistories];

        // Supplier Permissions
        $listSuppliers          = Permission::create(['guard_name' => 'admin', 'name' => 'list-suppliers']);
        $createSuppliers        = Permission::create(['guard_name' => 'admin', 'name' => 'create-suppliers']);
        $viewSuppliers          = Permission::create(['guard_name' => 'admin', 'name' => 'view-suppliers']);
        $updateSuppliers        = Permission::create(['guard_name' => 'admin', 'name' => 'update-suppliers']);
        $deleteSuppliers        = Permission::create(['guard_name' => 'admin', 'name' => 'delete-suppliers']);
        $viewSuppliersHistories = Permission::create(['guard_name' => 'admin', 'name' => 'view-suppliers-histories']);

        $supplierPermissions = [$listSuppliers, $createSuppliers, $viewSuppliers, $updateSuppliers, $deleteSuppliers, $viewSuppliersHistories];

        // T
        // Tax Rate Permissions
        $listTaxRates           = Permission::create(['guard_name' => 'admin', 'name' => 'list-tax-rates']);
        $createTaxRates         = Permission::create(['guard_name' => 'admin', 'name' => 'create-tax-rates']);
        $viewTaxRates           = Permission::create(['guard_name' => 'admin', 'name' => 'view-tax-rates']);
        $updateTaxRates         = Permission::create(['guard_name' => 'admin', 'name' => 'update-tax-rates']);
        $deleteTaxRates         = Permission::create(['guard_name' => 'admin', 'name' => 'delete-tax-rates']);
        $viewTaxRatesHistories  = Permission::create(['guard_name' => 'admin', 'name' => 'view-tax-rates-histories']);

        $taxRatePermissions = [$listTaxRates, $createTaxRates, $viewTaxRates, $updateTaxRates, $deleteTaxRates, $viewTaxRatesHistories];

        // U
        // User Permissions
        $listUsers          = Permission::create(['guard_name' => 'admin', 'name' => 'list-users']);
        $createUsers        = Permission::create(['guard_name' => 'admin', 'name' => 'create-users']);
        $viewUsers          = Permission::create(['guard_name' => 'admin', 'name' => 'view-users']);
        $updateUsers        = Permission::create(['guard_name' => 'admin', 'name' => 'update-users']);
        $deleteUsers        = Permission::create(['guard_name' => 'admin', 'name' => 'delete-users']);
        $viewUsersHistories = Permission::create(['guard_name' => 'admin', 'name' => 'view-users-histories']);

        $userPermissions = [$listUsers, $createUsers, $viewUsers, $updateUsers, $deleteUsers, $viewUsersHistories];
        // V
        // W
        // X
        // Y
        // Z

        // Role Admin Permissions
        $listRoles      = Permission::create(['guard_name' => 'admin', 'name' => 'list-roles']);
        $createRoles    = Permission::create(['guard_name' => 'admin', 'name' => 'create-roles']);
        $viewRoles      = Permission::create(['guard_name' => 'admin', 'name' => 'view-roles']);
        $updateRoles    = Permission::create(['guard_name' => 'admin', 'name' => 'update-roles']);
        $deleteRoles    = Permission::create(['guard_name' => 'admin', 'name' => 'delete-roles']);

        $rolePermissions = [$listRoles, $createRoles, $viewRoles, $updateRoles, $deleteRoles];

        $roleAdmin = Role::create(['guard_name' => 'admin', 'name' => Admin::ROLE_NAME_ADMIN])
            ->givePermissionTo([
                $adminPermissions,
                $activityLogPermissions,
                $brandPermissions,
                $countryPermissions,
                $categoryPermissions,
                $currencyPermissions,
                $districtPermissions,
                $fileSettingPermissions,
                $generalConfigurationPermissions,
                $imageSettingPermissions,
                $localePermissions,
                $menuPermissions,
                $menuGroupPermissions,
                $pagePermissions,
                $productPermissions,
                $provincePermissions,
                $sliderPermissions,
                $stockUnitPermissions,
                $supplierPermissions,
                $taxRatePermissions,
                $userPermissions,
                $rolePermissions,
            ]);

        // Role Super Admin Permissions
        $roleSuperAdmin = Role::create(['guard_name' => 'admin', 'name' => Admin::ROLE_NAME_SUPER_ADMIN])
            ->givePermissionTo(Permission::all());

        // Assign Roles for users
        $superAdminUser->assignRole([$roleSuperAdmin]);
        $adminUser->assignRole([$roleAdmin]);
    }
}
