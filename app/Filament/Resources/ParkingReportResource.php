<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParkingReportResource\Pages;
use App\Filament\Resources\ParkingReportResource\RelationManagers;
use App\Models\ParkingReport;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ParkingReportResource extends Resource
{
    protected static ?string $model = ParkingReport::class;

    protected static ?string $modelLabel = 'Laporan Parkir';

    protected static ?string $pluralModelLabel = 'Laporan Parkir';

    protected static ?string $navigationIcon = 'heroicon-o-document';

    public static function canCreate(): bool
    {
       return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('plat_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('parking_point_name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('plat_number')
                    ->label('Plat Nomor')
                    ->getStateUsing(fn($record) => strtoupper($record->plat_number))
                    ->searchable()->sortable(),
                Tables\Columns\TextColumn::make('parking_point_name')
                    ->label('Titik Parkir')
                    ->searchable()->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu Masuk')
                    ->dateTime()
                    ->searchable()->sortable(),
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
            'index' => Pages\ListParkingReports::route('/'),
            'create' => Pages\CreateParkingReport::route('/create'),
            'edit' => Pages\EditParkingReport::route('/{record}/edit'),
        ];
    }    
}
