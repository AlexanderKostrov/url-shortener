<?php

namespace App\Filament\Resources\LinkResource\RelationManagers;

use App\Models\Link;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class VisitsRelationManager extends RelationManager
{
    protected static string $relationship = 'visits';

    protected static ?string $title = 'Visits';

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        return $ownerRecord instanceof Link && $ownerRecord->user_id === auth()->id();
    }

    public function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ip_address')
                    ->label('IP address'),
                Tables\Columns\TextColumn::make('visited_at')
                    ->label('Visited at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user_agent')
                    ->label('User agent')
                    ->limit(80),
                Tables\Columns\TextColumn::make('referer')
                    ->label('Referer')
                    ->limit(80),
            ])
            ->defaultSort('visited_at', 'desc')
            ->paginated([10, 25, 50])
            ->headerActions([])
            ->actions([])
            ->bulkActions([]);
    }
}
