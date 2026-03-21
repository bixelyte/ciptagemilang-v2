<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
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

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-building-office-2';
    protected static string | UnitEnum | null $navigationGroup = 'Content';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Translations')->tabs([
                Tab::make('🇮🇩 Indonesian')->schema([
                    TextInput::make('title.id')->label('Title (ID)')->required()->maxLength(255),
                    TextInput::make('location.id')->label('Location (ID)')->required()->maxLength(255),
                    Textarea::make('scope.id')->label('Scope (ID)')->required()->rows(2),
                    RichEditor::make('description.id')->label('Description (ID)')->columnSpanFull(),
                ])->columns(2),
                Tab::make('🇬🇧 English')->schema([
                    TextInput::make('title.en')->label('Title (EN)')->required()->maxLength(255),
                    TextInput::make('location.en')->label('Location (EN)')->required()->maxLength(255),
                    Textarea::make('scope.en')->label('Scope (EN)')->required()->rows(2),
                    RichEditor::make('description.en')->label('Description (EN)')->columnSpanFull(),
                ])->columns(2),
            ])->columnSpanFull(),
            Section::make('Settings')->schema([
                TextInput::make('slug')->maxLength(255)->unique(ignoreRecord: true),
                TextInput::make('year')->required()->maxLength(4),
                Select::make('client_id')->relationship('client', 'name')->searchable()->preload(),
                FileUpload::make('image')->image()->directory('projects'),
                Toggle::make('is_featured')->default(false),
                Toggle::make('is_active')->default(true),
                TextInput::make('sort_order')->numeric()->default(0),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('client.name')->sortable(),
                Tables\Columns\TextColumn::make('location')->searchable(),
                Tables\Columns\TextColumn::make('year')->sortable(),
                Tables\Columns\IconColumn::make('is_featured')->boolean(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
