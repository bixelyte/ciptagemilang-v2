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
            Section::make('Project Details')->schema([
                Select::make('client_id')->label('Client')->relationship('client', 'name')->required()->searchable()->preload(),
                TextInput::make('location')->label('Location')->required()->maxLength(255),
                Textarea::make('scope')->label('Scope')->required()->rows(2)->columnSpanFull(),
                RichEditor::make('description')->label('Description')->columnSpanFull(),
            ])->columns(1)->columnSpan(['sm' => 3, 'lg' => 2]),

            Section::make('Settings')->schema([
                TextInput::make('slug')->maxLength(255)->unique(ignoreRecord: true),
                TextInput::make('year')->required()->maxLength(4),
                FileUpload::make('image')->image()->directory('projects')->disk('public'),
                FileUpload::make('video')
                    ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/ogg'])
                    ->directory('projects/videos')
                    ->maxSize(102400)
                    ->disk('public'),
                Toggle::make('is_featured')->default(false),
                Toggle::make('is_active')->default(true),
                TextInput::make('sort_order')->numeric()->default(0),
            ])->columns(1)->columnSpan(['sm' => 3, 'lg' => 1]),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->disk('public'),
                Tables\Columns\TextColumn::make('client.name')->label('Client')->searchable()->sortable(),
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
            //
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
