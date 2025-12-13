<?php
namespace App\Services;

use App\Models\User;
use App\Models\UserInformation;
use Illuminate\Support\Facades\Hash;
use App\Services\Interfaces\ProfileServiceInterface;

class PrfileService 
{
    public function getUserInformations()
    {
        $user = auth()->user();
        return UserInformation::firstOrCreate(['id' => $user->id]);
    }
    // Update the user's profile information.
    public function update(array $data)
    {
    $user = auth()->user();
    $userInformations = $this->getUserInformations();

    // حقول جدول users فقط
    $userData = [
        'name' => $data['name'] ?? null,
        'email' => $data['email'] ?? null,
    ];

    // حقول جدول user_informations
    $infoData = collect($data)->except(['name', 'email'])->toArray();
    $user->update($userData);
    $userInformations->update($infoData);
    }
    // Update the user's password.
    public function updatePassword(User $user, array $data)
    {
        $user->password = Hash::make($data['new_password']);
        $user->save();
    }
}
