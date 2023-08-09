<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemResource\Pages;
use App\Filament\Resources\ItemResource\RelationManagers\ItemTypesRelationManager;
use App\Models\Item;
use App\Models\ItemType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('id'),
                Forms\Components\TextInput::make('description')->label('Descrição')->placeholder('Digite a descrição')->columnSpanFull()->required()->maxLength(100),                
                Forms\Components\Textarea::make('body')->label('Texto')->columnSpan('full')->placeholder('Digite o texto'),
                Forms\Components\RichEditor::make('rich_text')->label('Editor')->columnSpan('full')->placeholder('Digite o editor'),
                Forms\Components\Select::make('item_types_id')
                    ->label('Tipo')
                    ->required()
                    ->searchable()
                    ->options(fn (): array => ItemType::searchPluckToArray(null))
                    ->getSearchResultsUsing(fn ($search): array => ItemType::searchPluckToArray($search))
                    ->getOptionLabelUsing(fn($value): ?string => ItemType::getDescription($value))
                    ->columnSpan(['sm' => 1]),
                Forms\Components\TextInput::make('value')->numeric()->placeholder('R$ 0,00')->inputMode('decimal')->required()->columnSpan(['sm' => 1]),
                Forms\Components\DatePicker::make('now_at')->rules(['date_format:Y-m-d'])->label('Data')->required()->columnSpan(['sm' => 1]),
                Forms\Components\TimePicker::make('time_at')->placeholder('HH:mm')->rules(['date_format:H:i:s'])->label('Hora')->required()->columnSpan(['sm' => 1]),
                Forms\Components\FileUpload::make('image')->image()->imageEditor()
                    ->columnSpanFull()
                    ->disk('images')->directory('items')->visibility('public'),
                Forms\Components\Checkbox::make('status')->label('Status')->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('#')->alignCenter(), //->searchable()->sortable(),
                Tables\Columns\TextColumn::make('description')->label('Descrição')->searchable()->sortable()->alignLeft(),
                Tables\Columns\TextColumn::make('itemTypes.description')->label('Tipo')->searchable()->sortable()->alignCenter(),
                Tables\Columns\IconColumn::make('status')->label('Status')->boolean()->alignCenter(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(''),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->label('Novo'),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //ItemTypesRelationManager::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }    
}
