<?php
/**
 * 员工验证器
 */

namespace app\common\validate;

class StaffValidate extends Validate
{
    protected $rule = [
        'name|姓名'            => 'require',
        'department_id|部门'   => 'require',
        'position_id|职位'     => 'require',
        'job_number|工号'      => 'require',
        'mobile|手机号'         => 'require',
        'email|邮箱'           => 'require',
        'birthday|生日'        => 'require',
        'hired_date|入职日期'    => 'require',
        'is_boss|是否为老板'      => 'require',
        'is_leader|是否所属部门领导' => 'require',
        'sort_number|排序'     => 'require',

    ];

    protected $message = [
        'name.require'          => '姓名不能为空',
        'department_id.require' => '部门不能为空',
        'position_id.require'   => '职位不能为空',
        'job_number.require'    => '工号不能为空',
        'mobile.require'        => '手机号不能为空',
        'email.require'         => '邮箱不能为空',
        'birthday.require'      => '生日不能为空',
        'hired_date.require'    => '入职日期不能为空',
        'is_boss.require'       => '是否为老板不能为空',
        'is_leader.require'     => '是否所属部门领导不能为空',
        'sort_number.require'   => '排序不能为空',

    ];

    protected $scene = [
        'add'  => ['name', 'department_id', 'position_id', 'job_number', 'mobile', 'email', 'birthday', 'hired_date', 'is_boss', 'is_leader', 'sort_number',],
        'edit' => ['name', 'department_id', 'position_id', 'job_number', 'mobile', 'email', 'birthday', 'hired_date', 'is_boss', 'is_leader', 'sort_number',],

    ];


}
