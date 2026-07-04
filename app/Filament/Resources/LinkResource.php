<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LinkResource\Pages;
use App\Filament\Resources\LinkResource\RelationManagers;
use App\Models\Link;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class LinkResource extends Resource
{
    protected static ?string $model = Link::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';

    protected static ?string $navigationLabel = 'Short links';

    protected static ?string $modelLabel = 'Short link';

    protected static ?string $pluralModelLabel = 'Short links';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('original_url')
                    ->label('Original URL')
                    ->required()
                    ->rules(['url:http,https'])
                    ->maxLength(2048)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('original_url')
                    ->label('Original URL')
                    ->limit(70)
                    ->searchable()
                    ->tooltip(fn (Link $record): string => $record->original_url),
                Tables\Columns\TextColumn::make('short_url')
                    ->label('Short URL')
                    ->state(fn (Link $record): string => rtrim(config('app.url'), '/') . '/' . $record->short_code)
                    ->limit(40)
                    ->copyable(),
                Tables\Columns\TextColumn::make('clicks_count')
                    ->label('Clicks')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('original_url')
                    ->label('Original URL'),
                Infolists\Components\TextEntry::make('short_url')
                    ->label('Short URL')
                    ->state(fn (Link $record): string => rtrim(config('app.url'), '/') . '/' . $record->short_code)
                    ->copyable(),
                Infolists\Components\TextEntry::make('short_code')
                    ->label('Code'),
                Infolists\Components\TextEntry::make('clicks_count')
                    ->label('Clicks'),
                Infolists\Components\TextEntry::make('created_at')
                    ->label('Created')
                    ->dateTime('d.m.Y H:i'),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id());
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\VisitsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLinks::route('/'),
            'create' => Pages\CreateLink::route('/create'),
            'view' => Pages\ViewLink::route('/{record}'),
            'edit' => Pages\EditLink::route('/{record}/edit'),
        ];
    }
}
