<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    protected static ?int $navigationSort = 0;

    public static function getNavigationLabel(): string
    {
        return __('trans.product');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make(__('trans.product-info'))->schema([
                        TextInput::make('name')
                            ->label(__('trans.name'))
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function(string $operation, $state, Set $set){
                                if($operation !== 'create'){
                                    return;
                                }
                                $set('slug', Str::slug($state));
                            }),
                        TextInput::make('slug')
                            ->label(__('trans.slug'))
                            ->required()
                            ->unique(Product::class, 'slug', ignoreRecord: true)
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated(),
                        MarkdownEditor::make('description')
                            ->label(__('trans.description'))
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('products')
                    ])->columns(2),

                    Section::make(__('trans.images'))->schema([
                        FileUpload::make('images')
                            ->label(__('trans.images'))
                            ->multiple()
                            ->directory('products')
                            ->maxFiles(5)
                            ->reorderable(),
                    ])
                ])->columnSpan(2),
                
                Group::make()->schema([
                    Section::make(__('trans.price'))->schema([
                        TextInput::make('price')
                            ->label(__('trans.price'))
                            ->numeric()
                            ->required()
                            ->prefix('PHP'),
                    ]),

                    Section::make(__('trans.specification'))->schema([
                        Select::make('specs')
                            ->label(__('trans.specification'))
                            ->required()
                            ->searchable()
                            ->options([
                                'bundle' => 'Bundle',
                                'pc' => 'Pc',
                                'g' => 'G',
                                'pack' => 'Pack'
                            ])
                    ]),

                    Section::make(__('trans.associations'))->schema([
                        Select::make('sub_category_id')
                            ->label(__('trans.sub-category'))
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('sub_category', 'name')
                    ]),

                    Section::make(__('trans.status'))->schema([
                        Toggle::make('is_active')
                            ->label(__('trans.is-active'))
                            ->required()
                            ->default(true),
                        Toggle::make('is_selected')
                            ->label(__('trans.is-selected'))
                            ->required(),
                        Toggle::make('is_promotion')
                            ->label(__('trans.is-promotion'))
                            ->required(),
                        Toggle::make('is_preorder')
                            ->label(__('trans.is-preorder'))
                            ->required(),
                        Toggle::make('in_stock')
                            ->label(__('trans.in-stock'))
                            ->required()
                            ->default(true),
                    ])

                ])->columnSpan(1)
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('trans.name'))
                    ->searchable(),
                ImageColumn::make('images')
                    ->label(__('trans.image')),
                TextColumn::make('sub_category.name')
                    ->label(__('trans.sub-category'))
                    ->sortable(),
                TextColumn::make('price')
                    ->label(__('trans.price'))
                    ->money('PHP')
                    ->sortable(),
                
                IconColumn::make('is_active')->boolean()
                    ->label(__('trans.is-active')),
                IconColumn::make('is_selected')->boolean()
                    ->label(__('trans.is-selected')),
                IconColumn::make('is_promotion')->boolean()
                    ->label(__('trans.is-promotion')),
                IconColumn::make('is_preorder')->boolean()
                    ->label(__('trans.is-preorder')),
                IconColumn::make('in_stock')->boolean()
                    ->label(__('trans.in-stock')),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                    
            ])
            ->filters([
                SelectFilter::make('category')->relationship('sub_category', 'name'),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
                
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
