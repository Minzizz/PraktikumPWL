<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                Tabs::make('Product Tabs')
                    ->tabs([
                        Tabs\Tab::make('Product Info')
                            ->icon('heroicon-o-academic-cap')
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Product Name')
                                    ->weight('bold')
                                    ->color('primary'),
                                TextEntry::make('id')
                                    ->label('Product ID'),
                                TextEntry::make('sku')
                                    ->label('SKU')
                                    ->badge()
                                    ->color('success'),
                                TextEntry::make('description')
                                    ->label('Description'),
                                TextEntry::make('created_at')
                                    ->label('Created At')
                                    ->date('d M Y')
                                    ->color('info'),
                            ]),
                        Tab::make('Pricing & Stock')
                        ->icon('heroicon-o-currency-dollar')
                            ->schema([
                                TextEntry::make('price')
                                    ->label('Price')
                                    ->icon('heroicon-o-currency-dollar'),
                                TextEntry::make('stock')
                                    ->label('Stock')
                                    ->badge()
                                    ->color(fn ($state) => $state > 200 ? 'success' : 'danger')
                            ]),
                        Tabs\Tab::make('Media & Status')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                ImageEntry::make('image')
                                    ->label('Product Image')
                                    ->disk('public'),
                                IconEntry::make('is_visible')
                                    ->label('Active')
                                    ->boolean(),
                                IconEntry::make('is_featured')
                                    ->label('Featured')
                                    ->boolean(),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->vertical(),

                Section::make('Product Info')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Product Name')
                            ->weight('bold')
                            ->color('primary'),
                        TextEntry::make('id')
                            ->label('Product ID'),
                        TextEntry::make('sku')
                            ->label('Product SKU')
                            ->badge()
                            ->color('success'),
                        TextEntry::make('description')
                            ->label('Product Description'),
                        TextEntry::make('created_at')
                            ->label('Product Creation Date')
                            ->date('d M Y')
                            ->color('info'),
                    ])
                    ->columnSpanFull(),
                Section::make('Pricing & Stock')
                    ->schema([
                        TextEntry::make('price')
                            ->label('Product Price')
                            ->icon('heroicon-o-currency-dollar'),
                        TextEntry::make('stock')
                            ->label('Product Stock'),
                    ])
                    ->columnSpanFull(),
                Section::make('Image and Status')
                    ->description('Gambar produk dan statusnya')
                    ->schema([
                        ImageEntry::make('image')
                            ->label('Product Image')
                            ->disk('public'),
                        TextEntry::make('price')
                            ->label('Product Price')
                            ->weight('bold')
                            ->color('primary')
                            ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 2))
                            ->icon('heroicon-o-currency-dollar'),
                        TextEntry::make('stock')
                            ->label('Product Stock')
                            ->weight('bold')
                            ->color('primary')
                            ->icon('heroicon-o-cube'),
                        IconEntry::make('is_visible')
                            ->label('Is Visible')
                            ->boolean(),
                        IconEntry::make('is_featured')
                            ->label('Is Featured')
                            ->boolean(),
                    ]),
            ]);
    }
}
