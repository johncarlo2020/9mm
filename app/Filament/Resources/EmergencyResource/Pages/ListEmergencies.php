<?php

namespace App\Filament\Resources\EmergencyResource\Pages;

use App\Filament\Resources\EmergencyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Livewire\Component;
use Livewire\Attributes\On; 
use Illuminate\Foundation\Testing\RefreshDatabase;
class ListEmergencies extends ListRecords
{

    use RefreshDatabase;
    protected static string $resource = EmergencyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
