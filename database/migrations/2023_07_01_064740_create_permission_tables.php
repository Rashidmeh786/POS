<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');
        $teams = config('permission.teams');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }
        if ($teams && empty($columnNames['team_foreign_key'] ?? null)) {
            throw new \Exception('Error: team_foreign_key on config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }

        Schema::create($tableNames['permissions'], function (Blueprint $table) {
            $table->bigIncrements('id'); // permission id
            $table->string('name');       // For MySQL 8.0 use string('name', 125);
            $table->string('guard_name'); 
            $table->string('group_name')->nullable(); // For MySQL 8.0 use string('guard_name', 125);
             // For MySQL 8.0 use string('guard_name', 125);
            $table->timestamps();

            $table->unique(['name', 'guard_name']);
        });
        $permissions = [
            [
                'name' => 'POS.MENU',
                'guard_name' => 'web',
                'group_name' => 'pos'
            ],
            [
                'name' => ' PRODUCT.MENU',
                'guard_name' => 'web',
                'group_name' => 'product'
            ],
            [
                'name' => ' PRODUCT.SHOW',
                'guard_name' => 'web',
                'group_name' => 'product'
            ],
            [
                'name' => ' PRODUCT.CREATE',
                'guard_name' => 'web',
                'group_name' => 'product'
            ],
            [
                'name' => ' PRODUCT.UPDATE',
                'guard_name' => 'web',
                'group_name' => 'product'
            ],
            [
                'name' => ' PRODUCT.DELETE',
                'guard_name' => 'web',
                'group_name' => 'product'
            ],
            [
                'name' => ' SUPPLIER.MENU',
                'guard_name' => 'web',
                'group_name' => 'supplier'
            ],
            [
                'name' => ' SUPPLIER.SHOW',
                'guard_name' => 'web',
                'group_name' => 'supplier'
            ],
            [
                'name' => ' SUPPLIER.CREATE',
                'guard_name' => 'web',
                'group_name' => 'supplier'
            ],
            [
                'name' => ' SUPPLIER.UPDATE',
                'guard_name' => 'web',
                'group_name' => 'supplier'
            ],
            [
                'name' => ' SUPPLIER.DELETE',
                'guard_name' => 'web',
                'group_name' => 'supplier'
            ],
            [
                'name' => ' CUSTOMER.MENU',
                'guard_name' => 'web',
                'group_name' => 'customer'
            ],
            [
                'name' => ' CUSTOMER.SHOW',
                'guard_name' => 'web',
                'group_name' => 'customer'
            ],
            [
                'name' => ' CUSTOMER.INSERT',
                'guard_name' => 'web',
                'group_name' => 'customer'
            ],
            [
                'name' => ' CUSTOMER.UPDATE',
                'guard_name' => 'web',
                'group_name' => 'customer'
            ],
            [
                'name' => ' CUSTOMER.DELETE',
                'guard_name' => 'web',
                'group_name' => 'customer'
            ],
            [
                'name' => ' STOCK.MENU',
                'guard_name' => 'web',
                'group_name' => 'stock'
            ],
            [
                'name' => ' STOCK.VIEW',
                'guard_name' => 'web',
                'group_name' => 'stock'
            ],
            [
                'name' => ' STOCK.ADJUSTMENT',
                'guard_name' => 'web',
                'group_name' => 'stock'
            ],
           
            [
                'name' => ' SALE.MENU',
                'guard_name' => 'web',
                'group_name' => 'sale'
            ],
            [
                'name' => ' SALE.VIEW',
                'guard_name' => 'web',
                'group_name' => 'sale'
            ],
            [
                'name' => ' SALE.CREATE',
                'guard_name' => 'web',
                'group_name' => 'sale'
            ],
            [
                'name' => ' SALE.UPDATE',
                'guard_name' => 'web',
                'group_name' => 'sale'
            ],
            [
                'name' => ' SALE.DELETE',
                'guard_name' => 'web',
                'group_name' => 'sale'
            ],
            [
                'name' => ' PURCHASE.MENU',
                'guard_name' => 'web',
                'group_name' => 'Purchase'
            ],
            [
                'name' => ' PURCHASE.VIEW',
                'guard_name' => 'web',
                'group_name' => 'Purchase'
            ],
            [
                'name' => ' PURCHASE.CREATE',
                'guard_name' => 'web',
                'group_name' => 'Purchase'
            ],
            [
                'name' => ' PURCHASE.UPDATE',
                'guard_name' => 'web',
                'group_name' => 'Purchase'
            ],
            [
                'name' => ' PURCHASE.DELETE',
                'guard_name' => 'web',
                'group_name' => 'Purchase'
            ],
            [
                'name' => ' USERS.MENU',
                'guard_name' => 'web',
                'group_name' => 'user'
            ],
            [
                'name' => ' USERS.VIEW',
                'guard_name' => 'web',
                'group_name' => 'user'
            ],
            [
                'name' => ' USERS.INSERT',
                'guard_name' => 'web',
                'group_name' => 'user'
            ],
            [
                'name' => ' USERS.UPDATE',
                'guard_name' => 'web',
                'group_name' => 'user'
            ],
            [
                'name' => ' USERS.DELETE',
                'guard_name' => 'web',
                'group_name' => 'user'
            ],
            [
                'name' => ' ROLE.MENU',
                'guard_name' => 'web',
                'group_name' => 'role'
            ],
            [
                'name' => ' ROLE.VIEW',
                'guard_name' => 'web',
                'group_name' => 'role'
            ],
            [
                'name' => ' ROLE.INSERT',
                'guard_name' => 'web',
                'group_name' => 'role'
            ],
            [
                'name' => ' ROLE.UPDATE',
                'guard_name' => 'web',
                'group_name' => 'role'
            ],
            [
                'name' => ' ROLE.DELETE',
                'guard_name' => 'web',
                'group_name' => 'role'
            ],
            [
                'name' => ' PERMISSIONS.MENU',
                'guard_name' => 'web',
                'group_name' => 'permission'
            ],
            [
                'name' => ' PERMISSIONS.VIEW',
                'guard_name' => 'web',
                'group_name' => 'permission'
            ],
            [
                'name' => ' PERMISSIONS.INSERT',
                'guard_name' => 'web',
                'group_name' => 'permission'
            ],
            [
                'name' => ' PERMISSIONS.UPDATE',
                'guard_name' => 'web',
                'group_name' => 'permission'
            ],
            [
                'name' => ' PERMISSIONS.DELETE',
                'guard_name' => 'web',
                'group_name' => 'permission'
            ],
          



            
            // Add more permissions as needed
        ];
        
        // Insert the array of permissions into the database
        Permission::insert($permissions);




        Schema::create($tableNames['roles'], function (Blueprint $table) use ($teams, $columnNames) {
            $table->bigIncrements('id'); // role id
            if ($teams || config('permission.testing')) { // permission.testing is a fix for sqlite testing
                $table->unsignedBigInteger($columnNames['team_foreign_key'])->nullable();
                $table->index($columnNames['team_foreign_key'], 'roles_team_foreign_key_index');
            }
            $table->string('name');       // For MySQL 8.0 use string('name', 125);
            $table->string('guard_name'); // For MySQL 8.0 use string('guard_name', 125);
            $table->timestamps();
            if ($teams || config('permission.testing')) {
                $table->unique([$columnNames['team_foreign_key'], 'name', 'guard_name']);
            } else {
                $table->unique(['name', 'guard_name']);
            }
        });

        $Roles = [
            [
                'name' => 'Super Admin',
                'guard_name' => 'web',
               
            ],
            [
                'name' => 'Admin',
                'guard_name' => 'web',
               
            ],
            [
                'name' => 'User',
                'guard_name' => 'web',
               
            ],
           
           
            // Add more permissions as needed
        ];
        
        // Insert the array of permissions into the database
        Role::insert($Roles);

        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames, $teams) {
            $table->unsignedBigInteger(PermissionRegistrar::$pivotPermission);

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_permissions_model_id_model_type_index');

            $table->foreign(PermissionRegistrar::$pivotPermission)
                ->references('id') // permission id
                ->on($tableNames['permissions'])
                ->onDelete('cascade');
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_permissions_team_foreign_key_index');

                $table->primary([$columnNames['team_foreign_key'], PermissionRegistrar::$pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
            } else {
                $table->primary([PermissionRegistrar::$pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
            }

        });

        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames, $teams) {
            $table->unsignedBigInteger(PermissionRegistrar::$pivotRole);

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_roles_model_id_model_type_index');

            $table->foreign(PermissionRegistrar::$pivotRole)
                ->references('id') // role id
                ->on($tableNames['roles'])
                ->onDelete('cascade');
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_roles_team_foreign_key_index');

                $table->primary([$columnNames['team_foreign_key'], PermissionRegistrar::$pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
            } else {
                $table->primary([PermissionRegistrar::$pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
            }
        });

        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedBigInteger(PermissionRegistrar::$pivotPermission);
            $table->unsignedBigInteger(PermissionRegistrar::$pivotRole);

            $table->foreign(PermissionRegistrar::$pivotPermission)
                ->references('id') // permission id
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign(PermissionRegistrar::$pivotRole)
                ->references('id') // role id
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary([PermissionRegistrar::$pivotPermission, PermissionRegistrar::$pivotRole], 'role_has_permissions_permission_id_role_id_primary');
        });

        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }
}
