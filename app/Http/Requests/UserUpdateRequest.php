<?php

namespace App\Http\Requests;

use App\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;
use Spatie\Permission\Models\Role;

class UserUpdateRequest extends FormRequest
{
    public function rules()
    {
        $user = $this->route()->parameter('user');
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user,
            'password' => [new RequiredIf($this->filled('password')), 'nullable', 'string', 'max:255', 'confirmed', (new Password())->requireUppercase()->requireNumeric()],
            'branch_id' => ['required_unless:role_id,'.Role::findByName('super_admin')->id, 'nullable', 'string', 'exists:users,branch_id'],
            'role_id' => ['required', 'exists:roles,id']
        ];
    }

    public function authorize()
    {
        return true;
    }
}
