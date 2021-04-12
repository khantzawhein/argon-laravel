<?php

namespace App\Http\Requests;

use App\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => ['required', 'max:255', 'confirmed', (new Password())->requireUppercase()->requireNumeric()],
            'branch_id' => ['required_unless:role_id,'.Role::findByName('super_admin')->id, 'nullable', 'string', 'exists:users,branch_id'],
            'role_id' => ['required', 'exists:roles,id']
        ];
    }

    public function authorize()
    {
        return true;
    }
}