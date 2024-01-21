<?php

namespace App\Filament\Resources\EmergencyResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Responder;
use Livewire\Component as Livewire;

class RespondersRelationManager extends RelationManager
{
    protected static string $relationship = 'responders';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('responder_id')
                    ->label('Responder')
                    ->options(function (callable $get, Livewire $livewire){
                            return Responder::where('agency_id',$livewire->ownerRecord->agency_id)->pluck('name','id');
                        })
                    ->searchable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('responder.name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
