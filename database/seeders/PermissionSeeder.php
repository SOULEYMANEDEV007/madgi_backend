<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Assessment;
use App\Models\Certificate;
use App\Models\Departement;
use App\Models\Emargement;
use App\Models\FormField;
use App\Models\Grade;
use App\Models\Holiday;
use App\Models\Infos;
use App\Models\Leave;
use App\Models\Media;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Site;
use App\Models\Unlock;
use App\Models\User;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            User::$import,

            Setting::$permission,
            Holiday::$permission,
            Unlock::$permission,

            Emargement::$permission,

            Role::$permission,
            Admin::$permission,
            Media::$permission,
            Infos::$permission,
            User::$agent,
            Departement::$permission,
            Grade::$permission,
            Service::$permission,
            Site::$permission,
            Leave::$permission,

            User::$worker,
            User::$intern,
            User::$temporaryworker,
            User::$employee,
            User::$official,
            User::$external,
            User::$fixed,
            User::$available,

            Assessment::$permission,
            FormField::$permission,
            Certificate::$permission,
        ];

        foreach($permissions as $permission) {
            if($permission == User::$import) {
                Permission::create([
                    'title' => $permission,
                    'name' => "IMPORT $permission",
                    'guard_name' => 'admin'
                ]);
            }
            else if($permission == Holiday::$permission || $permission == Unlock::$permission) {
                Permission::create([
                    'title' => $permission,
                    'name' => "READ $permission",
                    'guard_name' => 'admin'
                ]);
                Permission::create([
                    'title' => $permission,
                    'name' => "UPDATE $permission",
                    'guard_name' => 'admin'
                ]);
            }
            else if($permission == Emargement::$permission) {
                Permission::create([
                    'title' => $permission,
                    'name' => "READ $permission",
                    'guard_name' => 'admin'
                ]);
                Permission::create([
                    'title' => $permission,
                    'name' => "CREATE $permission",
                    'guard_name' => 'admin'
                ]);
                Permission::create([
                    'title' => $permission,
                    'name' => "DISABLE $permission",
                    'guard_name' => 'admin'
                ]);
                Permission::create([
                    'title' => $permission,
                    'name' => "EXPORT $permission",
                    'guard_name' => 'admin'
                ]);
            }
            else if($permission == Role::$permission || $permission == Admin::$permission || $permission == Media::$permission || $permission == Infos::$permission || $permission == User::$agent || $permission == Departement::$permission || $permission == Grade::$permission || $permission == Service::$permission || $permission == Site::$permission || $permission == Assessment::$permission || $permission == FormField::$permission || $permission == Certificate::$permission || $permission == Setting::$permission) {
                Permission::create([
                    'title' => $permission,
                    'name' => "CREATE $permission",
                    'guard_name' => 'admin'
                ]);
                Permission::create([
                    'title' => $permission,
                    'name' => "READ $permission",
                    'guard_name' => 'admin'
                ]);
                Permission::create([
                    'title' => $permission,
                    'name' => "UPDATE $permission",
                    'guard_name' => 'admin'
                ]);
                Permission::create([
                    'title' => $permission,
                    'name' => "DELETE $permission",
                    'guard_name' => 'admin'
                ]);
            }
            else if($permission == Leave::$permission) {
                Permission::create([
                    'title' => $permission,
                    'name' => "CREATE $permission",
                    'guard_name' => 'admin'
                ]);
                Permission::create([
                    'title' => $permission,
                    'name' => "READ $permission",
                    'guard_name' => 'admin'
                ]);
                Permission::create([
                    'title' => $permission,
                    'name' => "UPDATE $permission",
                    'guard_name' => 'admin'
                ]);
                Permission::create([
                    'title' => $permission,
                    'name' => "DELETE $permission",
                    'guard_name' => 'admin'
                ]);
                Permission::create([
                    'title' => $permission,
                    'name' => "SIGNER $permission",
                    'guard_name' => 'admin'
                ]);
            }
            else {
                Permission::create([
                    'title' => $permission,
                    'name' => "READ $permission",
                    'guard_name' => 'admin'
                ]);
                Permission::create([
                    'title' => $permission,
                    'name' => "UPDATE $permission",
                    'guard_name' => 'admin'
                ]);
                Permission::create([
                    'title' => $permission,
                    'name' => "DISABLE $permission",
                    'guard_name' => 'admin'
                ]);
                Permission::create([
                    'title' => $permission,
                    'name' => "DELETE $permission",
                    'guard_name' => 'admin'
                ]);
                Permission::create([
                    'title' => $permission,
                    'name' => "EXPORT $permission",
                    'guard_name' => 'admin'
                ]);
            }
        }
    }
}
