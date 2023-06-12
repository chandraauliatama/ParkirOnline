<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StaticImageResource\Pages;
use App\Filament\Resources\StaticImageResource\RelationManagers;
use App\Models\StaticImage;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class StaticImageResource extends Resource
{
    protected static ?string $model = StaticImage::class;

    protected static ?string $navigationIcon = 'heroicon-o-camera';

    protected static ?string $modelLabel = 'Pengaturan Gambar';

    public static function canCreate(): bool
    {
       return false;
    }

    public static function canDelete(Model $record): bool
    {
       return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('label')->required()->disabled(),
                Forms\Components\FileUpload::make('source')
                    ->image()
                    ->preserveFilenames()
                    ->directory('static_images')
                    ->visibility('public')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('source')->label('Image')->height(20)
                    ->url(function($record) {
                        return Storage::disk('public')->url($record->source, now()->addMinutes(10));
                    }),
                Tables\Columns\TextColumn::make('label'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListStaticImages::route('/'),
            'create' => Pages\CreateStaticImage::route('/create'),
            'edit' => Pages\EditStaticImage::route('/{record}/edit'),
        ];
    }    
}
