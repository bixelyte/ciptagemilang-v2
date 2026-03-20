<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroBannerResource\Pages;
use App\Models\HeroBanner;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Table;
use UnitEnum;

class HeroBannerResource extends Resource
{
    protected static ?string $model = HeroBanner::class;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-photo';
    protected static string | UnitEnum | null $navigationGroup = 'Content';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Banner Content')->schema([
                TextInput::make('title')->required()->maxLength(255),
                TextInput::make('highlight_text')->maxLength(255),
                Textarea::make('description')->rows(3),
                TextInput::make('badge_text')->maxLength(255),
                FileUpload::make('image')->image()->directory('banners')->required(),
            ])->columns(2),
            Section::make('Call to Action')->schema([
                TextInput::make('cta_primary_text')->maxLength(255),
                TextInput::make('cta_primary_url')->maxLength(255),
                TextInput::make('cta_secondary_text')->maxLength(255),
                TextInput::make('cta_secondary_url')->maxLength(255),
            ])->columns(2),
            Section::make('Settings')->schema([
                TextInput::make('sort_order')->numeric()->default(0),
                Toggle::make('is_active')->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('highlight_text'),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->actions([EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHeroBanners::route('/'),
            'create' => Pages\CreateHeroBanner::route('/create'),
            'edit' => Pages\EditHeroBanner::route('/{record}/edit'),
        ];
    }
}
