<?php

namespace App\Filament\Resources\Books;

use App\Filament\Resources\Books\Pages\CreateBook;
use App\Filament\Resources\Books\Pages\EditBook;
use App\Filament\Resources\Books\Pages\ListBooks;
use App\Filament\Resources\Books\Pages\ViewBook;
use App\Filament\Resources\Books\Schemas\BookForm;
use App\Filament\Resources\Books\Schemas\BookInfolist;
use App\Filament\Resources\Books\Tables\BooksTable;
use App\Models\Book;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::BookOpen;
    protected static string|UnitEnum|null $navigationGroup = 'Acervo';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'livro';
    protected static ?string $pluralModelLabel = 'livros';
    protected static ?string $recordTitleAttribute = 'title';

    public static function getNavigationBadge(): ?string
    {
        return (string) Book::query()->where('copies_available', '>', 0)->count();
    }

    public static function form(Schema $schema): Schema { return BookForm::configure($schema); }
    public static function infolist(Schema $schema): Schema { return BookInfolist::configure($schema); }
    public static function table(Table $table): Table { return BooksTable::configure($table); }

    public static function getPages(): array
    {
        return [
            'index' => ListBooks::route('/'),
            'create' => CreateBook::route('/create'),
            'view' => ViewBook::route('/{record}'),
            'edit' => EditBook::route('/{record}/edit'),
        ];
    }
}
