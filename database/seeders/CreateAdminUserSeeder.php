<?php 
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
class CreateAdminUserSeeder extends Seeder
{
    
    public function run(): void
    {
        $user = User::create([
            'name' => 'superadmin2', 
            'email' => 'superadmin2@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        
        $role = Role::create(['name' => 'super admin']);
         
        $permissions = Permission::pluck('id','id')->all();
       
        $role->syncPermissions($permissions);
         
        $user->assignRole([$role->id]);
    }
}
