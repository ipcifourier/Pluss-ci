<?php

namespace App\Filament\Resources\Gtts\Schemas;

use Filament\Schemas\Components as Layouts;
use Filament\Forms\Components as Fields;

use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

use Illuminate\Support\Str;


class GttForm
{
    public static function schema(): array
    {
        return [
            Layouts\Tabs::make('GTT')
                ->tabs([

                    /*
                    |--------------------------------------------------------------------------
                    | INFORMATIONS
                    |--------------------------------------------------------------------------
                    */
                    Layouts\Tabs\Tab::make('Informations')
                        ->schema([

                            Layouts\Grid::make(2)
                                ->schema([

                                    Fields\TextInput::make('name')
                                        ->label('Nom du GTT')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(function (Set $set, Get $get) {
                                            if ($get('name')) {
                                                $set('slug', Str::slug($get('name')));
                                            }
                                        }),

                                    Fields\TextInput::make('slug')
                                        ->label('Slug')
                                        ->required()
                                        ->disabled()
                                        ->dehydrated()
                                        ->unique(ignoreRecord: true),

                                    Fields\TextInput::make('leader')
                                        ->label('Responsable du GTT')
                                        ->maxLength(255)
                                        ->columnSpanFull(),

                                    Fields\Textarea::make('short_description')
                                        ->label('Description courte')
                                        ->rows(3)
                                        ->maxLength(500)
                                        ->columnSpanFull(),

                                    Fields\RichEditor::make('description')
                                        ->label('Description détaillée')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    /*
                    |--------------------------------------------------------------------------
                    | MÉDIAS
                    |--------------------------------------------------------------------------
                    */
                    Layouts\Tabs\Tab::make('Médias')
                        ->schema([

                            Layouts\Grid::make(2)
                                ->schema([

                                    Fields\FileUpload::make('logo')
                                        ->label('Logo')
                                        ->image()
                                        ->imagePreviewHeight('150')
                                        ->imageCropAspectRatio('1:1')
                                        ->directory('gtts/logos')
                                        ->disk('public')
                                        ->maxSize(2048),

                                    Fields\FileUpload::make('cover_image')
                                        ->label('Image de couverture')
                                        ->image()
                                        ->imagePreviewHeight('150')
                                        ->imageResizeTargetWidth('1200')
                                        ->directory('gtts/covers')
                                        ->disk('public')
                                        ->maxSize(4096),
                                ]),
                        ]),

                    /*
                    |--------------------------------------------------------------------------
                    | PUBLICATION
                    |--------------------------------------------------------------------------
                    */
                    Layouts\Tabs\Tab::make('Publication')
                        ->schema([

                            Layouts\Grid::make(2)
                                ->schema([

                                    Fields\Toggle::make('is_published')
                                        ->label('Publié')
                                        ->default(false)
                                        ->live()
                                        ->afterStateUpdated(
                                            fn (Set $set, $state) =>
                                                $state ? $set('published_at', now()) : $set('published_at', null)
                                        ),

                                    Fields\DatePicker::make('published_at')
                                        ->label('Date de publication')
                                        ->visible(fn (Get $get) => $get('is_published')),
                                ]),
                        ]),
                ])
                ->columnSpanFull(),
        ];
    }
}