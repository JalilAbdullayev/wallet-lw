<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubcategoryResource\Pages;
use App\Filament\Resources\SubcategoryResource\RelationManagers;
use App\Models\Subcategory;
use Filament\Forms\Components\Select;
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

class SubcategoryResource extends Resource {
    protected static ?string $model = Subcategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    public static function form(Form $form): Form {
        return $form->schema([
            TextInput::make('title')->required()->maxLength(255)->debounce('500ms')
                ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
            TextInput::make('slug')->maxLength(255)->unique(ignoreRecord: true),
            Toggle::make('status')->default(true),
            Select::make('category_id')->relationship('category', 'title')->searchable()->preload()
        ]);
    }

    public static function table(Table $table): Table {
        return $table->columns([
            TextColumn::make('order')->label('#')->sortable(),
            TextColumn::make('title')->searchable()->sortable(),
            TextColumn::make('category.title')->searchable()->sortable(),
            ToggleColumn::make('status')->sortable()
        ])->reorderable('order')->defaultSort('order')->filters([
            //
        ])->actions([
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
            'index' => Pages\ManageSubcategories::route('/'),
        ];
    }
}
