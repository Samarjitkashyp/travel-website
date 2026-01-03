<?php

namespace App\Filament\Resources;

use App\Models\Package;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Illuminate\Database\Eloquent\Builder;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        $inclusionOptions = [
            'Hotel Accommodation',
            'Breakfast Included',
            'Sightseeing Tour',
            'Transportation',
            'Flight Tickets',
            'Train Tickets',
            'Guide Service',
            'Entrance Fees',
            'Travel Insurance',
            'Airport Transfer'
        ];

        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Package Title')
                                    ->required()
                                    ->maxLength(255),
                                
                                TextInput::make('duration')
                                    ->label('Duration')
                                    ->required()
                                    ->placeholder('e.g., 5 Days / 4 Nights')
                                    ->maxLength(50),
                            ]),
                        
                        TextInput::make('location')
                            ->label('Location/Destination')
                            ->required()
                            ->maxLength(255),
                        
                        Grid::make(3)
                            ->schema([
                                TextInput::make('original_price')
                                    ->label('Original Price (₹)')
                                    ->numeric()
                                    ->required()
                                    ->prefix('₹'),
                                
                                TextInput::make('discounted_price')
                                    ->label('Discounted Price (₹)')
                                    ->numeric()
                                    ->required()
                                    ->prefix('₹'),
                                
                                TextInput::make('discount_percentage')
                                    ->label('Discount %')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(100)
                                    ->suffix('%')
                                    ->readOnly()
                                    ->helperText('Auto-calculated from prices'),
                            ]),
                        
                        TagsInput::make('inclusions')
                            ->label('Package Inclusions')
                            ->placeholder('Add inclusion')
                            ->suggestions($inclusionOptions)
                            ->separator(',')
                            ->required(),
                        
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                                'draft' => 'Draft',
                            ])
                            ->default('active')
                            ->required(),
                        
                        Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->required()
                            ->maxLength(500),
                        
                        FileUpload::make('image')
                            ->label('Package Image')
                            ->image()
                            ->directory('packages')
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
                
                TextColumn::make('title')
                    ->label('Package')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('duration')
                    ->label('Duration')
                    ->badge()
                    ->color('success'),
                
                TextColumn::make('location')
                    ->label('Location')
                    ->searchable()
                    ->limit(20),
                
                TextColumn::make('original_price')
                    ->label('Original Price')
                    ->money('INR')
                    ->strikeThrough(),
                
                TextColumn::make('discounted_price')
                    ->label('Discounted Price')
                    ->money('INR')
                    ->color('success')
                    ->weight('bold'),
                
                TextColumn::make('discount_percentage')
                    ->label('Discount')
                    ->formatStateUsing(fn ($state) => $state . '%')
                    ->badge()
                    ->color(fn ($state) => $state > 20 ? 'danger' : 'warning'),
                
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
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'draft' => 'Draft',
                    ]),
                
                Tables\Filters\Filter::make('discount_range')
                    ->form([
                        TextInput::make('min_discount')
                            ->label('Min Discount %')
                            ->numeric()
                            ->placeholder('Min discount'),
                        
                        TextInput::make('max_discount')
                            ->label('Max Discount %')
                            ->numeric()
                            ->placeholder('Max discount'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['min_discount'],
                                fn (Builder $query, $min): Builder => $query->where('discount_percentage', '>=', $min),
                            )
                            ->when(
                                $data['max_discount'],
                                fn (Builder $query, $max): Builder => $query->where('discount_percentage', '<=', $max),
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