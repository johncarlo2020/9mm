<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmergencyResource\Pages;
use App\Filament\Resources\EmergencyResource\RelationManagers;
use App\Models\Emergency;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Agency;

class EmergencyResource extends Resource
{
    protected static ?string $model = Emergency::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('agency_id')
                    ->label('Agency')
                    ->options(Agency::all()->pluck('name', 'id'))
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        0   => 'Pending',
                        1   => 'Dispatched',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('agency.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\BadgeColumn::make('status')
                    ->color(static function ($state): string {
                        if ($state === 'Pending') {
                            return 'warning';
                        }
                        else{
                            return 'success';
                        }
                    }),
            ])
            ->filters([
                //
            ])
            ->striped()
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])  ;
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ImagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmergencies::route('/'),
           // 'create' => Pages\CreateEmergency::route('/create'),
           // 'edit' => Pages\EditEmergency::route('/{record}/edit'),
           'view' => Pages\ViewEmergency::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder 
    {

        $agency = auth()->user()->agency;
        if($agency == null)
        {
            $query = parent::getEloquentQuery();
        }
        else{
            $query = parent::getEloquentQuery();
            $query->where('agency_id',$agency);
        }
       
        
        return $query;
    }
}
