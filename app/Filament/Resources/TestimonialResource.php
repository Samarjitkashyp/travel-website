<?php

namespace App\Filament\Resources;

use App\Models\Testimonial;
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
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        $visitedLocations = [
            'Guwahati, Assam',
            'Goa',
            'Kerala',
            'Rajasthan',
            'Himachal Pradesh',
            'Uttarakhand',
            'Tamil Nadu',
            'Andaman Islands',
            'Shimla',
            'Varanasi'
        ];

        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Traveler Name')
                                    ->required()
                                    ->maxLength(100),
                                
                                Select::make('rating')
                                    ->label('Rating')
                                    ->options([
                                        1 => '1 Star',
                                        2 => '2 Stars',
                                        3 => '3 Stars',
                                        4 => '4 Stars',
                                        5 => '5 Stars',
                                    ])
                                    ->default(5)
                                    ->required(),
                            ]),
                        
                        Select::make('visited_location')
                            ->label('Visited Location')
                            ->options(array_combine($visitedLocations, $visitedLocations))
                            ->searchable()
                            ->required(),
                        
                        Textarea::make('content')
                            ->label('Testimonial Content')
                            ->rows(4)
                            ->required()
                            ->maxLength(500)
                            ->placeholder('What did the traveler say about their experience?'),
                        
                        Grid::make(2)
                            ->schema([
                                Select::make('status')
                                    ->label('Status')
                                    ->options([
                                        'active' => 'Active (Visible on website)',
                                        'inactive' => 'Inactive (Hidden)',
                                    ])
                                    ->default('active')
                                    ->required(),
                                
                                FileUpload::make('avatar')
                                    ->label('Traveler Photo')
                                    ->image()
                                    ->avatar()
                                    ->directory('testimonials/avatars')
                                    ->nullable()
                                    ->helperText('Optional: Upload traveler photo or leave empty for default avatar'),
                            ]),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Photo')
                    ->circular()
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->name) . '&background=3498db&color=fff'),
                
                TextColumn::make('name')
                    ->label('Traveler')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('visited_location')
                    ->label('Visited')
                    ->searchable()
                    ->badge()
                    ->color('info'),
                
                TextColumn::make('rating')
                    ->label('Rating')
                    ->formatStateUsing(fn ($state) => str_repeat('⭐', $state))
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        5 => 'success',
                        4 => 'warning',
                        default => 'danger',
                    }),
                
                TextColumn::make('content')
                    ->label('Testimonial')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->content),
                
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('rating')
                    ->label('Filter by Rating')
                    ->options([
                        5 => '5 Stars',
                        4 => '4 Stars',
                        3 => '3 Stars',
                    ]),
                
                Tables\Filters\SelectFilter::make('visited_location')
                    ->label('Filter by Location')
                    ->options([
                        'Guwahati, Assam' => 'Guwahati',
                        'Goa' => 'Goa',
                        'Kerala' => 'Kerala',
                        'Rajasthan' => 'Rajasthan',
                    ]),
                
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
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
        return static::getModel()::where('status', 'active')->count();
    }
}