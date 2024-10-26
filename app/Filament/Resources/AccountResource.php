<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccountResource\Pages;
use App\Filament\Resources\AccountResource\RelationManagers;
use App\Models\Account;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class AccountResource extends Resource {
    protected static ?string $model = Account::class;

    protected static ?string $navigationIcon = 'heroicon-s-wallet';

    public static function form(Form $form): Form {
        return $form->schema([
            TextInput::make('title')->required()->maxLength(255)->debounce('500ms')
                ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
            TextInput::make('slug')->maxLength(255)->unique(ignoreRecord: true),
            TextInput::make('total')->numeric()->required(),
            Toggle::make('status')->default(true),
        ]);
    }

    public static function table(Table $table): Table {
        return $table->columns([
            TextColumn::make('order')->label('#')->sortable(),
            TextColumn::make('title')->searchable()->sortable(),
            TextColumn::make('total')->sortable()->searchable(),
            ToggleColumn::make('status')
        ])->reorderable('order')->defaultSort('order')->filters([
            //
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ManageAccounts::route('/'),
        ];
    }
}
