<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form            
            ->schema([
                Forms\Components\TextInput::make('description')                    
                    ->label('Descrição')
                    ->required()
                    ->maxLength(100)
                    ->columnSpan('full'),
                Forms\Components\Checkbox::make('done')
                    ->label('Status')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('#')->alignCenter(), //->searchable()->sortable(),
                Tables\Columns\TextColumn::make('description')->label('Descrição')->searchable()->sortable()->alignLeft(),
                Tables\Columns\IconColumn::make('done')->label('Status')->boolean()->alignCenter(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(''),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make()->label('Excluir?'),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->label('Novo'),
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
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }    
}
