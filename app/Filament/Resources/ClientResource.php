<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Models\Client;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
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

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-user-group';
    protected static string | UnitEnum | null $navigationGroup = 'Content';
    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Translations')->tabs([
                Tab::make('🇮🇩 Indonesian')->schema([
                    Textarea::make('description.id')->label('Description (ID)')->rows(3),
                ])->columns(2),
                Tab::make('🇬🇧 English')->schema([
                    Textarea::make('description.en')->label('Description (EN)')->rows(3),
                ])->columns(2),
            ])->columnSpanFull(),
            Section::make('Settings')->schema([
                TextInput::make('name')->required()->maxLength(255),
                TextInput::make('slug')->maxLength(255)->unique(ignoreRecord: true),
                FileUpload::make('logo')->image()->directory('clients'),
                TextInput::make('website')->url()->maxLength(255),
                TextInput::make('sort_order')->numeric()->default(0),
                Toggle::make('is_active')->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')->circular(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('projects_count')->counts('projects')->sortable()->label('Projects'),
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
