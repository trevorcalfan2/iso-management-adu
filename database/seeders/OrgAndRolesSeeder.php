<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrgAndRolesSeeder extends Seeder
{
    public function run(): void
    {
        // ISO/BASC roles
        $roles = [
            ['code'=>'SYSTEM_ADMIN','label'=>'System Admin'],
            ['code'=>'QMR','label'=>'Quality Manager (QMR)'],
            ['code'=>'PROCESS_OWNER','label'=>'Process Owner'],
            ['code'=>'AREA_ASSISTANT','label'=>'Area Assistant'],
            ['code'=>'AUDITOR','label'=>'Auditor'],
            ['code'=>'BASC_OFFICER','label'=>'BASC Security Officer'],
            ['code'=>'READER','label'=>'Reader'],
        ];
        DB::table('iso_roles')->upsert($roles, ['code'], ['label']);

        // Áreas
        $areas = ['Calidad','Operaciones','Logística','Comercial','RRHH','Seguridad'];
        foreach ($areas as $a) DB::table('areas')->updateOrInsert(['name'=>$a]);

        // Puestos
        $positions = ['Jefe de Área','Asistente','Coordinador','Analista','Operador'];
        foreach ($positions as $p) DB::table('positions')->updateOrInsert(['name'=>$p]);

        // Procesos
        $processes = ['Estrategia','Gestión Comercial','Operaciones','Compras','Logística','Gestión de Calidad','Seguridad BASC'];
        foreach ($processes as $p) DB::table('processes')->updateOrInsert(['name'=>$p,'parent_id'=>null]);
    }
}
