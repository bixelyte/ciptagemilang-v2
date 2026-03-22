<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyStatResource\Pages;
use App\Models\CompanyStat;
use BackedEnum;
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

class CompanyStatResource extends Resource
{
    protected static ?string $model = CompanyStat::class;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-chart-bar';
    protected static string | UnitEnum | null $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 10;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Translations')->tabs([
                Tab::make('🇮🇩 Indonesian')->schema([
                    TextInput::make('label.id')->label('Label (ID)')->required()->maxLength(255),
                ])->columns(2),
                Tab::make('🇬🇧 English')->schema([
                    TextInput::make('label.en')->label('Label (EN)')->required()->maxLength(255),
                ])->columns(2),
            ])->columnSpan(['sm' => 3, 'lg' => 2]),
            Section::make('Settings')->schema([
                TextInput::make('icon')->required()->helperText('Google Material Symbols name'),
                TextInput::make('value')->required()->maxLength(255),
                TextInput::make('sort_order')->numeric()->default(0),
                Toggle::make('is_active')->default(true),
            ])->columns(1)->columnSpan(['sm' => 3, 'lg' => 1]),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('icon'),
                Tables\Columns\TextColumn::make('value')->sortable(),
                Tables\Columns\TextColumn::make('label')->searchable(),
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
            'index' => Pages\ListCompanyStats::route('/'),
            'create' => Pages\CreateCompanyStat::route('/create'),
            'edit' => Pages\EditCompanyStat::route('/{record}/edit'),
        ];
    }
}
