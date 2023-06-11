<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParkingPointResource\Pages;
use App\Filament\Resources\ParkingPointResource\RelationManagers;
use App\Models\ParkingPoint;
use App\Models\User;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ParkingPointResource extends Resource
{
    protected static ?string $model = ParkingPoint::class;

    protected static ?string $modelLabel = 'Titik Parkir';

    protected static ?string $pluralModelLabel = 'Titik Parkir';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Titik Parkir')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_occupied')
                    ->label('Sudah Ditempati')
                    ->default(false)
                    ->columnSpanFull()
                    ->reactive()
                    ->required(),
                Forms\Components\TextInput::make('plat_number')
                    ->label('Plat Nomor')
                    ->maxLength(255)
                    ->hidden(fn($get) => !$get('is_occupied'))
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('date_in')
                    ->label('Waktu Masuk')
                    ->default(now())
                    ->hidden(fn($get) => !$get('is_occupied'))
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Titik Parkir')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_occupied')
                    ->label('Sudah Ditempati')->boolean()->toggle(),
                Tables\Columns\TextColumn::make('plat_number')
                    ->label('Plat Nomor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_in')
                    ->label('Waktu Masuk')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('keluar')
                    ->hidden(fn ($record) => !$record->is_occupied)
                    ->button()->color('danger')
                    ->requiresConfirmation()
                    ->action(function($record) {
                        $user = User::where('plat_number', $record->plat_number)?->first();
                        $user->parking_point_id = null;
                        $user->last_in = null;
                        $user->last_out = now();
                        $user->save();

                        $record->is_occupied = false;
                        $record->plat_number = null;
                        $record->date_in = null;
                        $record->save();
                        
                        return Notification::make()->success()
                            ->title('Motor Berhasil Keluar')->send();
                    }),
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
