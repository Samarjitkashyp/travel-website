<?php

namespace App\Filament\Resources;

use App\Models\Hotel;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TagsInput;
use Illuminate\Database\Eloquent\Builder;

class HotelResource extends Resource
{
    protected static ?string $model = Hotel::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        $amenityOptions = [
            'Free WiFi',
            'Swimming Pool',
            'Spa',
            'Restaurant',
            'Parking',
            'AC',
            'Beach View',
            'Mountain View',
            'All Inclusive',
            'Kids Club',
            'Water Sports',
            'Tea Plantation',
            'Bonfire',
            'Trekking',
            'Royal Suites',
            'Fine Dining',
            'Butler Service',
            'Fireplace',
            'Snow View',
            'Library',
            'Garden'
        ];

        $featureOptions = [
            '5-star Luxury Hotel',
            'Beach Resort',
            'Hill Station Resort',
            'Heritage Palace Hotel',
            'Colonial Style Hotel',
            'Lake Palace Hotel',
            'Tea Estate Hotel',
            'Business Hotel',
            'Backwater Resort',
            'Yoga Retreat'
        ];

        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Hotel Name')
                                    ->required()
                                    ->maxLength(255),
                                
                                TextInput::make('location')
                                    ->label('Location')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        
                        Grid::make(3)
                            ->schema([
                                TextInput::make('price')
                                    ->label('Price per Night (₹)')
                                    ->numeric()
                                    ->required()
                                    ->prefix('₹'),
                                
                                TextInput::make('rating')
                                    ->label('Rating (1-5)')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(5)
                                    ->step(0.1)
                                    ->required(),
                                
                                TextInput::make('recommended_percentage')
                                    ->label('Recommended %')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(100)
                                    ->suffix('%'),
                            ]),
                        
                        Grid::make(2)
                            ->schema([
                                Select::make('type')
                                    ->label('Hotel Type')
                                    ->options(array_combine($featureOptions, $featureOptions))
                                    ->required()
                                    ->searchable(),
                                
                                TextInput::make('near_location')
                                    ->label('Near Location')
                                    ->placeholder('e.g., Near Kamakhya Temple')
                                    ->maxLength(255),
                            ]),
                        
                        TagsInput::make('amenities')
                            ->label('Amenities')
                            ->placeholder('Add amenity')
                            ->suggestions($amenityOptions)
                            ->separator(',')
                            ->required(),
                        
                        TagsInput::make('features')
                            ->label('Features')
                            ->placeholder('Add feature')
                            ->suggestions($featureOptions)
                            ->separator(',')
                            ->required(),
                        
                        Grid::make(2)
                            ->schema([
                                Select::make('status')
                                    ->label('Status')
                                    ->options([
                                        'active' => 'Active',
                                        'inactive' => 'Inactive',
                                        'draft' => 'Draft',
                                    ])
                                    ->default('active')
                                    ->required(),
                                
                                Toggle::make('tax_inclusive')
                                    ->label('Tax Inclusive')
                                    ->default(true)
                                    ->inline(false),
                            ]),
                        
                        Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->required()
                            ->maxLength(500),
                        
                        FileUpload::make('image')
                            ->label('Hotel Image')
                            ->image()
                            ->directory('hotels')
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->circular()
                    ->size(50),
                
                TextColumn::make('name')
                    ->label('Hotel Name')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('location')
                    ->label('Location')
                    ->searchable()
                    ->limit(20),
                
                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color('info'),
                
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
                Tables\Filters\SelectFilter::make('type')
                    ->label('Filter by Type')
                    ->options([
                        '5-star Luxury Hotel' => '5-star Luxury Hotel',
                        'Beach Resort' => 'Beach Resort',
                        'Hill Station Resort' => 'Hill Station Resort',
                        'Heritage Palace Hotel' => 'Heritage Palace Hotel',
                    ]),
                
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'draft' => 'Draft',
                    ]),
                
                Tables\Filters\Filter::make('price_range')
                    ->form([
                        TextInput::make('min_price')
                            ->label('Min Price (₹)')
                            ->numeric()
                            ->placeholder('Min price'),
                        
                        TextInput::make('max_price')
                            ->label('Max Price (₹)')
                            ->numeric()
                            ->placeholder('Max price'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['min_price'],
                                fn (Builder $query, $min): Builder => $query->where('price', '>=', $min),
                            )
                            ->when(
                                $data['max_price'],
                                fn (Builder $query, $max): Builder => $query->where('price', '<=', $max),
                            );
                    }),
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