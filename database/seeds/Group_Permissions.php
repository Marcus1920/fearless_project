<?php

use Illuminate\Database\Seeder;

class Group_Permissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB:table('Group_Permissions')->delete();
        GroupPermission::create(['id'=>'6', 'permission_id'=>'1', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:33:14', 'updated_at'=>'2016-06-16 22:33:14']);
        GroupPermission::create(['id'=>'9', 'permission_id'=>'13', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:39', 'updated_at'=>'2016-06-16 22:40:39']);
        GroupPermission::create(['id'=>'10', 'permission_id'=>'9', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:45', 'updated_at'=>'2016-06-16 22:40:45']);
        GroupPermission::create(['id'=>'18', 'permission_id'=>'15', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:39', 'updated_at'=>'2016-06-16 22:40:39']);
        GroupPermission::create(['id'=>'19', 'permission_id'=>'14', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:39', 'updated_at'=>'2016-06-16 22:40:39']);
        GroupPermission::create(['id'=>'20', 'permission_id'=>'2', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:33:14', 'updated_at'=>'2016-06-16 22:33:14']);
        GroupPermission::create(['id'=>'21', 'permission_id'=>'3', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:33:14', 'updated_at'=>'2016-06-16 22:33:14']);
        GroupPermission::create(['id'=>'22', 'permission_id'=>'4', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:33:14', 'updated_at'=>'2016-06-16 22:33:14']);
        GroupPermission::create(['id'=>'23', 'permission_id'=>'5', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:33:14', 'updated_at'=>'2016-06-16 22:33:14']);
        GroupPermission::create(['id'=>'24', 'permission_id'=>'6', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:33:14', 'updated_at'=>'2016-06-16 22:33:14']);
        GroupPermission::create(['id'=>'25', 'permission_id'=>'7', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:33:14', 'updated_at'=>'2016-06-16 22:33:14']);

        GroupPermission::create(['id'=>'26', 'permission_id'=>'8', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:33:14', 'updated_at'=>'2016-06-16 22:33:14']);
        GroupPermission::create(['id'=>'27', 'permission_id'=>'10', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:45', 'updated_at'=>'2016-06-16 22:40:45']);
        GroupPermission::create(['id'=>'28', 'permission_id'=>'11', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:45', 'updated_at'=>'2016-06-16 22:40:45']);
        GroupPermission::create(['id'=>'29', 'permission_id'=>'12', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:45', 'updated_at'=>'2016-06-16 22:40:45']);
        GroupPermission::create(['id'=>'30', 'permission_id'=>'16', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:39', 'updated_at'=>'2016-06-16 22:40:39']);
        GroupPermission::create(['id'=>'31', 'permission_id'=>'17', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:39', 'updated_at'=>'2016-06-16 22:40:39']);
        GroupPermission::create(['id'=>'32', 'permission_id'=>'18', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:39', 'updated_at'=>'2016-06-16 22:40:39']);
        GroupPermission::create(['id'=>'33', 'permission_id'=>'19', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:39', 'updated_at'=>'2016-06-16 22:40:39']);
        GroupPermission::create(['id'=>'34', 'permission_id'=>'20', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:39', 'updated_at'=>'2016-06-16 22:40:39']);
        GroupPermission::create(['id'=>'35', 'permission_id'=>'21', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:39', 'updated_at'=>'2016-06-16 22:40:39']);
        GroupPermission::create(['id'=>'36', 'permission_id'=>'22', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:39', 'updated_at'=>'2016-06-16 22:40:39']);

        GroupPermission::create(['id'=>'37', 'permission_id'=>'23', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:39', 'updated_at'=>'2016-06-16 22:40:39']);
        GroupPermission::create(['id'=>'38', 'permission_id'=>'24', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:39', 'updated_at'=>'2016-06-16 22:40:39']);
        GroupPermission::create(['id'=>'39', 'permission_id'=>'25', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:39', 'updated_at'=>'2016-06-16 22:40:39']);
        GroupPermission::create(['id'=>'40', 'permission_id'=>'26', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:39', 'updated_at'=>'2016-06-16 22:40:39']);
        GroupPermission::create(['id'=>'41', 'permission_id'=>'27', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:39', 'updated_at'=>'2016-06-16 22:40:39']);
        GroupPermission::create(['id'=>'42', 'permission_id'=>'28', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:39', 'updated_at'=>'2016-06-16 22:40:39']);
        GroupPermission::create(['id'=>'43', 'permission_id'=>'29', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:39', 'updated_at'=>'2016-06-16 22:40:39']);
        GroupPermission::create(['id'=>'44', 'permission_id'=>'30', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:39', 'updated_at'=>'2016-06-16 22:40:39']);
        GroupPermission::create(['id'=>'45', 'permission_id'=>'31', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:39', 'updated_at'=>'2016-06-16 22:40:39']);
        GroupPermission::create(['id'=>'46', 'permission_id'=>'32', 'group_id'=>'1', 'created_by'=>'1', 'updated_by'=>'0', 'active'=>'1', 'remember_token'=>'NULL', 'craeted_at'=>'2016-06-16 22:40:39', 'updated_at'=>'2016-06-16 22:40:39']);

        //
    }
}
