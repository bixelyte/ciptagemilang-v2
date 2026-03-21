<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Table;
use UnitEnum;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static string | UnitEnum | null $navigationGroup = 'Content';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Translations')->tabs([
                Tab::make('🇮🇩 Indonesian')->schema([
                    TextInput::make('title.id')->label('Title (ID)')->required()->maxLength(255),
                    Textarea::make('short_description.id')->label('Short Description (ID)')->required()->rows(3),
                    RichEditor::make('description.id')->label('Description (ID)')->columnSpanFull(),
                ])->columns(2),
                Tab::make('🇬🇧 English')->schema([
                    TextInput::make('title.en')->label('Title (EN)')->required()->maxLength(255),
                    Textarea::make('short_description.en')->label('Short Description (EN)')->required()->rows(3),
                    RichEditor::make('description.en')->label('Description (EN)')->columnSpanFull(),
                ])->columns(2),
            ])->columnSpanFull(),
            Section::make('Settings')->schema([
                TextInput::make('slug')->maxLength(255)->unique(ignoreRecord: true),
                TextInput::make('icon')->default('engineering')->maxLength(255)->helperText('Google Material Symbols icon name'),
                FileUpload::make('image')->image()->directory('services'),
                TextInput::make('sort_order')->numeric()->default(0),
                Toggle::make('is_active')->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('icon'),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->actions([EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getRelations(): array
    {
        return [
            \App\Filament\RelationManagers\AttachmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
