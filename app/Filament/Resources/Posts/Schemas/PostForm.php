<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\IconColumn;
use App\Models\Category;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                Group::make([
                    Section::make('Post Details')
                        ->description('Informasi dasar tentang post')
                        ->icon('heroicon-o-document-text')
                        ->schema([
                            Group::make([
                                TextInput::make('title')
                                    ->required()
                                    ->minLength(5)
                                    ->maxLength(255),
                                TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                Select::make('category_id')
                                    ->label('Category')
                                    ->options(
                                        \App\Models\Category::all()->pluck('name', 'id')
                                    )
                                    ->required(),
                                ColorPicker::make('color'),
                            ])->columns(2),
                            //MarkdownEditor::make('body'),
                            RichEditor::make('body')
                        ])->columnSpan(2),
                    Section::make('Image Upload')
                        ->schema([
                            FileUpload::make('image')
                                ->disk('public')
                                ->directory('post'),
                        ]),
                ])->columnSpan(2),
                Section::make('Meta')
                    ->schema([
                        TagsInput::make('tags'),
                        Checkbox::make('published'),
                        DatePicker::make('published_at')
                    ])->columnSpan(1),
            ])->columns(3);
    }
}
