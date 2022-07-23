<?php

namespace Tests\Unit;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
//use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function dataProviderRoles()
    {
        return [
            ['Admin', 'Admin', true], //если пользователь Admin, то я хочу проверять, что при создании роли Admin, я получу true
            ['Admin', ['admin'], true], //если пользователь Admin, то если помещу роль admin в массив, он так же ее найдет
            ['Admin', ['admin', 'manager'], true],
            ['Admin', ['Client', 'manager'], false], //если присутствует роль клиент и менеджер, то он не находит ничего
            ['Client', ['Client', 'manager'], true], //находит
            ['Client', ['Admin', 'manager'], false], //не находит ничего
        ];
    }

    /**
     * @dataProvider dataProviderRoles
     * @param $roleName
     * @param $testRole
     * @param $expectedResult
     */
    public function testHasAnyRole($roleName, $testRole, $expectedResult)
    {
        $role = Role::where('name', $roleName)->first();
        $user = User::factory()->create([
            'role_id' => $role->id,
        ]);

        $this->assertEquals($expectedResult, $user->hasAnyRole($testRole)); // проверяем что expectedResult равен $user->hasAnyRole($testRole)
    }
}