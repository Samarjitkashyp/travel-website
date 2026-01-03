<?php

namespace App\Filament\Resources;

use App\Models\Destination;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;

class DestinationResource extends Resource
{
    protected static ?string $model = Destination::class;
    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Destination Name')
                                    ->required()
                                    ->maxLength(255),
                                
                                TextInput::make('location')
                                    ->label('Location')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        
                        Grid::make(3)
                            ->schema([
                                Select::make('state')
                                    ->label('State')
                                    ->options([
                                        'assam' => 'Assam',
                                        'goa' => 'Goa',
                                        'kerala' => 'Kerala',
                                        'rajasthan' => 'Rajasthan',
                                        'himachal' => 'Himachal Pradesh',
                                        'uttarakhand' => 'Uttarakhand',
                                        'tamilnadu' => 'Tamil Nadu',
                                    ])
                                    ->required(),
                                
                                Select::make('category')
                                    ->label('Category')
                                    ->options([
                                        'hill' => 'Hill Station',
                                        'beach' => 'Beach',
                                        'heritage' => 'Heritage',
                                        'wildlife' => 'Wildlife',
                                        'adventure' => 'Adventure',
                                        'religious' => 'Religious',
                                        'historical' => 'Historical',
                                    ])
                                    ->required(),
                                
                                Select::make('type')
                                    ->label('Type')
                                    ->options([
                                        'city' => 'City',
                                        'cultural' => 'Cultural',
                                        'natural' => 'Natural',
                                        'religious' => 'Religious',
                                    ])
                                    ->required(),
                            ]),
                        
                        Grid::make(2)
                            ->schema([
                                TextInput::make('price')
                                    ->label('Price (₹)')
                                    ->numeric()
                                    ->required(),
                                
                                TextInput::make('rating')
                                    ->label('Rating (1-5)')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(5)
                                    ->step(0.1)
                                    ->required(),
                            ]),
                        
                        Grid::make(2)
                            ->schema([
                                TextInput::make('best_time')
                                    ->label('Best Time to Visit')
                                    ->maxLength(50),
                                
                                TextInput::make('ideal_duration')
                                    ->label('Ideal Duration')
                                    ->maxLength(50),
                            ]),
                        
                        Grid::make(2)
                            ->schema([
                                TextInput::make('hotels_count')
                                    ->label('Number of Hotels')
                                    ->numeric()
                                    ->default(0),
                                
                                Select::make('status')
                                    ->label('Status')
                                    ->options([
                                        'active' => 'Active',
                                        'inactive' => 'Inactive',
                                        'draft' => 'Draft',
                                    ])
                                    ->default('active')
                                    ->required(),
                            ]),
                        
                        Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->required()
                            ->maxLength(500),
                        
                        FileUpload::make('image')
                            ->label('Destination Image')
                            ->image()
                            ->directory('destinations')
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Destination')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('location')
                    ->label('Location')
                    ->searchable(),
                
                TextColumn::make('state')
                    ->label('State')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'assam' => 'success',
                        'goa' => 'info',
                        'kerala' => 'warning',
                        default => 'primary',
                    }),
                
                TextColumn::make('category')
                    ->label('Category')
                    ->badge(),
                
                TextColumn::make('price')
                    ->label('Price')
                    ->money('INR')
                    ->sortable(),
                
                TextColumn::make('rating')
                    ->label('Rating')
                    ->formatStateUsing(fn ($state) => number_format($state, 1))
                    ->badge()
                    ->color(fn ($state) => match (true) {
                        $state >= 4.5 => 'success',
                        $state >= 4.0 => 'warning',
                        default => 'danger',
                    }),
                
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        'draft' => 'warning',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('state')
                    ->label('Filter by State')
                    ->options([
                        'assam' => 'Assam',
                        'goa' => 'Goa',
                        'kerala' => 'Kerala',
                        'rajasthan' => 'Rajasthan',
                    ]),
                
                Tables\Filters\SelectFilter::make('category')
                    ->label('Filter by Category')
                    ->options([
                        'hill' => 'Hill Station',
                        'beach' => 'Beach',
                        'heritage' => 'Heritage',
                        'wildlife' => 'Wildlife',
                    ]),
                
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'draft' => 'Draft',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->color('primary')
                    ->icon('heroicon-o-pencil'),
                
                Tables\Actions\DeleteAction::make()
                    ->color('danger')
                    ->icon('heroicon-o-trash'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}