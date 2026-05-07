<?php

namespace App\Console\Commands;

use App\Models\PersonRoleAssignment;
use Illuminate\Console\Command;

class FixEntityType extends Command
{
    protected $signature = 'fix:entity-type';
    protected $description = 'Fix entity_type to use full class names';

    public function handle()
    {
        $assignments = PersonRoleAssignment::whereNotNull('entity_type')
            ->where('entity_type', '!=', '')
            ->get();

        $map = [
            'association' => 'App\Models\Association',
            'group' => 'App\Models\Group', 
            'diocese' => 'App\Models\Diocese',
        ];

        foreach ($assignments as $a) {
            if (isset($map[$a->entity_type])) {
                $this->info("Fixing assignment {$a->id}: {$a->entity_type} -> {$map[$a->entity_type]}");
                $a->entity_type = $map[$a->entity_type];
                $a->save();
            }
        }

        $this->info('Done');
    }
}