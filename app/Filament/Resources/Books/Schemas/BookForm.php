<?php

namespace App\Filament\Resources\Books\Schemas;

use App\Models\Book;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->columns(2)->components([
            TextInput::make('title')->label('Titulo')->required()->maxLength(255),
            TextInput::make('author')->label('Autor')->required()->maxLength(255),
            Select::make('category_id')->label('Categoria')->relationship('category', 'name')->searchable()->preload(),
            TextInput::make('isbn')->label('ISBN')->maxLength(255),
            TextInput::make('publisher')->label('Editora')->maxLength(255),
            TextInput::make('publication_year')->label('Ano')->numeric(),
            TextInput::make('pages')->label('Paginas')->numeric(),
            TextInput::make('shelf_location')->label('Localizacao na estante')->maxLength(255),
            Select::make('status')->label('Status')->options(Book::statusOptions())->default('available')->required(),
            Toggle::make('is_featured')->label('Destacar na home')->default(true),
            TextInput::make('copies_total')->label('Exemplares totais')->required()->numeric()->minValue(0)->default(1),
            TextInput::make('copies_available')->label('Exemplares disponiveis')->required()->numeric()->minValue(0)->default(1),
            TextInput::make('cover_path')->label('Caminho da capa')->helperText('Exemplo: /src/img/oPequenoPrincipe.jpg')->columnSpanFull(),
            ColorPicker::make('accent_color')->label('Cor do card')->default('#5B6183')->required(),
            Textarea::make('description')->label('Descricao')->rows(5)->columnSpanFull(),
        ]);
    }
}
