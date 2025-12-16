<?php

namespace App\Imports;

use App\Models\Area;
use App\Models\Doctor;
use App\Models\Specialization;
use App\Models\User;
use App\Models\Classification;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class FilesImport implements ToCollection
{
    protected int $warehouseId;

    public function __construct($warehouseId)
    {
        $this->warehouseId = $warehouseId;
    }

    /* =========================
        توحيد الاسم (مهم جدًا)
    ========================= */
    private function normalize($value): string
    {
        if ($value === null) {
            return '-';
        }

        $value = trim((string) $value);

        $value = str_replace(
            ['أ', 'إ', 'آ', 'ئ'],
            ['ا', 'ا', 'ا', 'ي'],
            $value
        );

        // توحيد المسافات
        return preg_replace('/\s+/u', ' ', $value);
    }


    public function collection(Collection $rows)
    {
        // تجاهل العناوين
        $rows->shift();

        DB::transaction(function () use ($rows) {

            /* =========================
                تحميل الكاش مرة واحدة
            ========================= */
            $areas = Area::pluck('id', 'name')->toArray();

            $specializations = Specialization::where('warehouse_id', $this->warehouseId)
                ->pluck('id', 'name')->toArray();

            $classifications = Classification::where('warehouse_id', $this->warehouseId)
                ->pluck('id', 'name')->toArray();

            $users = User::pluck('id', 'email')->toArray();

            foreach ($rows as $r) {

                if (empty($r[1])) {
                    continue; // تخطي الصف الفارغ
                }

                $doctorName = $this->normalize($r[1] ?? null);
                $gender     = ($r[2] ?? '') === 'ذكر' ? 'male' : 'female';
                $specName   = $this->normalize($r[3] ?? null);
                $areaName   = $this->normalize($r[4] ?? null);
                $address    = $this->normalize($r[5] ?? null);
                $className  = $this->normalize($r[6] ?? null);

                /* =========================
                    Area
                ========================= */
                $areaId = $areas[$areaName] ??= Area::create([
                    'name' => $areaName,
                ])->id;

                /* =========================
                    Specialization
                ========================= */
                $specId = $specializations[$specName] ??= Specialization::create([
                    'name' => $specName,
                    'warehouse_id' => $this->warehouseId,
                ])->id;

                /* =========================
                    Classification
                ========================= */
                $classId = $classifications[$className] ??= Classification::create([
                    'name' => $className,
                    'warehouse_id' => $this->warehouseId,
                ])->id;

                /* =========================
                    User
                ========================= */
                $email = Str::of($r[7])
                    ->lower()
                    ->replaceMatches('/[^a-z0-9]+/i', '')
                    ->append('@royvit.com')
                    ->toString();

                $userId = $users[$email] ??= User::create([
                    'name' => trim($r[7]),
                    'email' => $email,
                    'warehouse_id' => $this->warehouseId,
                    'password' => bcrypt('12345678'),
                ])->id;

                /* =========================
                    Doctor (منع التكرار الحقيقي)
                ========================= */
                Doctor::firstOrCreate(
                    [
                        'name' => $doctorName,
                        'address' => $address,
                        'warehouse_id' => $this->warehouseId,
                        'gender' => $gender,
                        'specialization_id' => $specId,
                        'area_id' => $areaId,
                        'representative_id' => $userId,
                        'classification_id' => $classId,
                    ]
                );
            }
        });
    }
}
