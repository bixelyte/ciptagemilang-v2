<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanySettingResource\Pages;
use App\Models\CompanySetting;
use BackedEnum;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
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

class CompanySettingResource extends Resource
{
    protected static ?string $model = CompanySetting::class;
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static string | UnitEnum | null $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 11;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()->schema([
                TextInput::make('key')->required()->maxLength(255)->unique(ignoreRecord: true),
            ]),
            Tabs::make('Translations')->tabs([
                Tab::make('🇮🇩 Indonesian')->schema([
                    Textarea::make('value.id')->label('Value (ID)')->rows(4)->columnSpanFull(),
                ]),
                Tab::make('🇬🇧 English')->schema([
                    Textarea::make('value.en')->label('Value (EN)')->rows(4)->columnSpanFull(),
                ]),
            ])->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('value')->limit(80),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable(),
            ])
            ->actions([EditAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanySettings::route('/'),
            'create' => Pages\CreateCompanySetting::route('/create'),
            'edit' => Pages\EditCompanySetting::route('/{record}/edit'),
        ];
    }
}
