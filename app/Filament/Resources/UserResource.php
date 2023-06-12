<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\ParkingPoint;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $modelLabel = 'Pengguna';

    protected static ?string $pluralModelLabel = 'Pengguna';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('username')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->nullable()
                    ->maxLength(255),
                Forms\Components\Select::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'user'  => 'User'
                    ])
                    ->required(),
                Forms\Components\TextInput::make('plat_number')
                    ->label('Plat Nomor')
                    ->reactive()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\Select::make('parking_point_id')
                    ->label('Titik Parkir')
                    ->reactive()
                    ->options(ParkingPoint::where('is_occupied', false)->pluck('name', 'id'))
                    ->visible(fn ($get) => $get('plat_number'))
                    ->searchable(),
                Forms\Components\DateTimePicker::make('last_in')
                    ->visible(fn ($get) => $get('parking_point_id')),
                Forms\Components\DateTimePicker::make('last_out')
                    ->hidden(fn (string $context): bool => $context === 'create'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create'),

                // Forms\Components\DateTimePicker::make('email_verified_at'),
                // Forms\Components\TextInput::make('password')
                //     ->password()
                //     ->required()
                //     ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('username')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('role'),
                Tables\Columns\TextColumn::make('plat_number')
                    ->searchable()
                    ->label('Plat Nomor'),
                Tables\Columns\TextColumn::make('parkingPoint.name')
                    ->searchable()
                    ->label('Titik Parkir'),
                Tables\Columns\TextColumn::make('last_in')
                    ->label('Waktu Masuk')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('last_out')
                    ->label('Waktu Keluar')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime(),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'user' => 'User'
                    ])
                    ->label('Jenis Akun')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }    
}
