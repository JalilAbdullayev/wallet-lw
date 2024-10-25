<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages\ManageCategories;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CategoryResource extends Resource {
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-s-folder';

    public static function form(Form $form): Form {
        return $form->schema([
            TextInput::make('title')->required()->maxLength(255)->debounce('500ms')
                ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
            TextInput::make('slug')->maxLength(255),
            Toggle::make('status')->default(true),
        ]);
    }

    public static function table(Table $table): Table {
        return $table->columns([
            TextColumn::make('order')->name('#')->sortable(),
            TextColumn::make('title')->searchable()->sortable(),
            ToggleColumn::make('status')
        ])->reorderable('order')->defaultSort('order')->filters([
            //
        ])->extremePaginationLinks()->paginatedWhileReordering()->actions([
            EditAction::make(),
            DeleteAction::make(),
        ])->bulkActions([
            BulkActionGroup::make([
                DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getPages(): array {
        return [
            'index' => ManageCategories::route('/'),
        ];
    }
}
