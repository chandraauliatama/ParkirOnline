<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParkingPointResource\Pages;
use App\Filament\Resources\ParkingPointResource\RelationManagers;
use App\Models\ParkingPoint;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ParkingPointResource extends Resource
{
    protected static ?string $model = ParkingPoint::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_occupied')
                    ->default(false)
                    ->columnSpanFull()
                    ->reactive()
                    ->required(),
                Forms\Components\TextInput::make('plat_number')
                    ->maxLength(255)
                    ->disabled(fn($get) => !$get('is_occupied'))
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\IconColumn::make('is_occupied')
                    ->boolean(),
                Tables\Columns\TextColumn::make('plat_number'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListParkingPoints::route('/'),
            'create' => Pages\CreateParkingPoint::route('/create'),
            'edit' => Pages\EditParkingPoint::route('/{record}/edit'),
        ];
    }    
}
