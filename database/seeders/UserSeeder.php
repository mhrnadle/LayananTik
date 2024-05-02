<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * List of applications to add.
     */
    private $adminPermissions = [
        'role-list', 'role-create', 'role-edit', 'role-delete',
        'layanan-list', 'layanan-create', 'layanan-edit', 'layanan-delete',
        'sublayanan-list', 'sublayanan-create', 'sublayanan-edit', 'sublayanan-delete',
        'syarat-list', 'syarat-create', 'syarat-edit', 'syarat-delete',
        'infolayanan-list', 'infolayanan-create', 'infolayanan-edit', 'infolayanan-delete',
        'pengajuan-list', 'pengajuan-edit', 'pengajuan-delete', 'pengajuan-approve',
    ];

    private $userPermissions = [
        'sublayanan-list','pengajuan-list', 'pengajuan-create', 'pengajuan-edit'
    ];

    private $unitKerjaPermissions = [
        'sublayanan-list', 'pengajuan-list', 'pengajuan-create', 'pengajuan-edit'
    ];

    private $individuASNPermissions = [
        'sublayanan-list', 'pengajuan-list', 'pengajuan-create', 'pengajuan-edit'
    ];

    private $instansiLainPermissions = [
        'sublayanan-list', 'pengajuan-list', 'pengajuan-create', 'pengajuan-edit'
    ];

    private $internalPermissions = [
        'sublayanan-list', 'pengajuan-list', 'pengajuan-create', 'pengajuan-edit'
    ];

    private $internalTimSIMKIPermissions = [
        'pengajuan-list', 'pengajuan-create', 'pengajuan-edit', 'pengajuan-approve'
    ];

    private $internalTimTIKPermissions = [
        'sublayanan-list', 'pengajuan-list', 'pengajuan-create', 'pengajuan-edit'
    ];
    
    public function superAdminPermissions():array
    {
        return array_merge($this->adminPermissions, $this->userPermissions);
    }

    private const ADMIN_ROLE = 'Super Admin';
    private const UNIT_KERJA_ROLE = 'Unit Kerja';
    private const INDIVIDU_ASN_ROLE = 'Individu ASN';
    private const INSTANSI_LAIN_ROLE = 'Instansi Lain';
    private const INTERNAL_ROLE = 'Internal';
    private const INTERNAL_TIM_SIMKI_ROLE = 'Internal SIMKI';
    private const INTERNAL_TIM_TIK_ROLE = 'Internal TIK';

    private function getUserData(): array
    {
        return [
            [
                'username' => 'admin',
                'name' => 'Admin',
                'email' => 'test@example.com',
                'password' => 'password',
                'role' => self::ADMIN_ROLE,
                'permissions' => $this->superAdminPermissions(),
            ],
            [
                'username' => 'unitkerja',
                'name' => 'Unit Kerja',
                'email' => 'unitkerja@example.com',
                'password' => 'password',
                'role' => self::UNIT_KERJA_ROLE,
                'permissions' => $this->unitKerjaPermissions,
            ],
            [
                'username' => 'individuasn',
                'name' => 'Individu ASN',
                'email' => 'asn@example.com',
                'password' => 'password',
                'role' => self::INDIVIDU_ASN_ROLE,
                'permissions' => $this->individuASNPermissions,
            ],
            [
                'username' => 'instansilain',
                'name' => 'Instansi Lain',
                'email' => 'instansilain@example.com',
                'password' => 'password',
                'role' => self::INSTANSI_LAIN_ROLE,
                'permissions' => $this->instansiLainPermissions,
            ],
            [
                'username' => 'internal',
                'name' => 'Internal',
                'email' => 'internal@example.com',
                'password' => 'password',
                'role' => self::INTERNAL_ROLE,
                'permissions' => $this->internalPermissions,
            ],
            [
                'username' => 'internalsimki',
                'name' => 'Internal SIMKI',
                'email' => 'internalsimki@example.com',
                'password' => 'password',
                'role' => self::INTERNAL_TIM_SIMKI_ROLE,
                'permissions' => $this->internalTimSIMKIPermissions,
            ],
            [
                'username' => 'internaltik',
                'name' => 'Internal TIK',
                'email' => 'internaltik@example.com',
                'password' => 'password',
                'role' => self::INTERNAL_TIM_TIK_ROLE,
                'permissions' => $this->internalTimTIKPermissions,
            ]
        ];
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createPermissions($this->superAdminPermissions());

        foreach ($this->getUserData() as $userData) {
            $this->createUser($userData);
        }
    }

    private function createUser(array $userData): void
    {
        $user = User::create([
            'username' => $userData['username'],
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
        ]);

        $role = Role::create(['name' => $userData['role']]);
        $role->syncPermissions(Permission::whereIn('name', $userData['permissions'])->pluck('id', 'id')->all());
        $user->assignRole([$role->id]);
    }

    private function createPermissions(array $permissions): void
    {
        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }
    }
}
