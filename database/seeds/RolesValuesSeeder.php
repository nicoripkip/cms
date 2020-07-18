<?php

use Illuminate\Database\Seeder;
use App\RolesValues;

class RolesValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'dashboard_read', 'value' => 1, 'role_id' => 1],
            ['name' => 'menu_read', 'value' => 1, 'role_id' => 1],
            ['name' => 'menu_create', 'value' => 1, 'role_id' => 1],
            ['name' => 'menu_update', 'value' => 1, 'role_id' => 1],
            ['name' => 'menu_delete', 'value' => 1, 'role_id' => 1],
            ['name' => 'theme_read', 'value' => 1, 'role_id' => 1],
            ['name' => 'theme_create', 'value' => 1, 'role_id' => 1],
            ['name' => 'theme_select', 'value' => 1, 'role_id' => 1],
            ['name' => 'theme_detail', 'value' => 1, 'role_id' => 1],
            ['name' => 'theme_delete', 'value' => 1, 'role_id' => 1],
            ['name' => 'page_read', 'value' => 1, 'role_id' => 1],
            ['name' => 'page_create', 'value' => 1, 'role_id' => 1],
            ['name' => 'page_update', 'value' => 1, 'role_id' => 1],
            ['name' => 'page_delete', 'value' => 1, 'role_id' => 1],
            ['name' => 'page_builder', 'value' => 1, 'role_id' => 1],
            ['name' => 'module_read', 'value' => 1, 'role_id' => 1],
            ['name' => 'module_create', 'value' => 1, 'role_id' => 1],
            ['name' => 'module_update', 'value' => 1, 'role_id' => 1],
            ['name' => 'module_delete', 'value' => 1, 'role_id' => 1],
            ['name' => 'module_builder', 'value' => 1, 'role_id' => 1],
            ['name' => 'moduleitem_read', 'value' => 1, 'role_id' => 1],
            ['name' => 'moduleitem_create', 'value' => 1, 'role_id' => 1],
            ['name' => 'moduleitem_update', 'value' => 1, 'role_id' => 1],
            ['name' => 'moduleitem_delete', 'value' => 1, 'role_id' => 1],
            ['name' => 'attributes_read', 'value' => 1, 'role_id' => 1],
            ['name' => 'attributes_create', 'value' => 1, 'role_id' => 1],
            ['name' => 'attributes_update', 'value' => 1, 'role_id' => 1],
            ['name' => 'attributes_delete', 'value' => 1, 'role_id' => 1],
            ['name' => 'templates_read', 'value' => 1, 'role_id' => 1],
            ['name' => 'templates_create', 'value' => 1, 'role_id' => 1],
            ['name' => 'templates_update', 'value' => 1, 'role_id' => 1],
            ['name' => 'templates_delete', 'value' => 1, 'role_id' => 1],
            ['name' => 'templates_builder', 'value' => 1, 'role_id' => 1],
            ['name' => 'forms_read', 'value' => 1, 'role_id' => 1],
            ['name' => 'forms_create', 'value' => 1, 'role_id' => 1],
            ['name' => 'forms_update', 'value' => 1, 'role_id' => 1],
            ['name' => 'forms_delete', 'value' => 1, 'role_id' => 1],
            ['name' => 'forms_builder', 'value' => 1, 'role_id' => 1],
            ['name' => 'forms_export', 'value' => 1, 'role_id' => 1],
            ['name' => 'mails_read', 'value' => 1, 'role_id' => 1],
            ['name' => 'mails_create', 'value' => 1, 'role_id' => 1],
            ['name' => 'mails_update', 'value' => 1, 'role_id' => 1],
            ['name' => 'mails_delete', 'value' => 1, 'role_id' => 1],
            ['name' => 'mails_builder', 'value' => 1, 'role_id' => 1],
            ['name' => 'users_read', 'value' => 1, 'role_id' => 1],
            ['name' => 'users_create', 'value' => 1, 'role_id' => 1],
            ['name' => 'users_update', 'value' => 1, 'role_id' => 1],
            ['name' => 'users_delete', 'value' => 1, 'role_id' => 1],
            ['name' => 'roless_read', 'value' => 1, 'role_id' => 1],
            ['name' => 'roles_create', 'value' => 1, 'role_id' => 1],
            ['name' => 'roles_update', 'value' => 1, 'role_id' => 1],
            ['name' => 'roles_delete', 'value' => 1, 'role_id' => 1],
            ['name' => 'settings_algemeen', 'value' => 1, 'role_id' => 1],
            ['name' => 'settings_social', 'value' => 1, 'role_id' => 1],
            ['name' => 'settings_environment', 'value' => 1, 'role_id' => 1],
        ];

        foreach ($data as $t) {
            RolesValues::create($t);
        }
    }
}
