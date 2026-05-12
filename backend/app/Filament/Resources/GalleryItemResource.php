<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryItemResource\Pages;
use App\Models\GalleryItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class GalleryItemResource extends Resource
{
    protected static ?string $model = GalleryItem::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'System';
    protected static ?string $navigationLabel = 'Gallery';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Image Details')->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('image_url')
                    ->label('Image URL')
                    ->required()
                    ->url()
                    ->helperText('Paste a direct image URL (jpg, png, webp). Use Google Drive, Imgur, or any public host.')
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('description')
                    ->rows(2)
                    ->maxLength(500)
                    ->columnSpanFull(),

                Forms\Components\Select::make('category')
                    ->options([
                        'success_story' => '🎓 Success Story',
                        'event'         => '🎉 Event',
                        'campus'        => '🏛️ Campus',
                        'student_life'  => '👩‍🎓 Student Life',
                        'milestone'     => '🏆 Milestone',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('sort_order')
                    ->label('Sort Order')
                    ->numeric()
                    ->default(0)
                    ->helperText('Lower number = appears first'),
            ])->columns(2),

            Forms\Components\Section::make('Visibility')->schema([
                Forms\Components\Toggle::make('is_featured')
                    ->label('Featured on homepage')
                    ->helperText('Shows in the Success Stories section on the landing page')
                    ->default(false),

                Forms\Components\Toggle::make('is_active')
                    ->label('Active (visible to public)')
                    ->default(true),
            ])->columns(2),

            Forms\Components\Section::make('Preview')->schema([
                Forms\Components\Placeholder::make('image_preview')
                    ->label('')
                    ->content(fn ($record) => $record?->image_url
                        ? new \Illuminate\Support\HtmlString(
                            '<img src="' . e($record->image_url) . '" class="max-h-64 rounded-xl object-cover" onerror="this.style.display=\'none\'">'
                        )
                        : 'Save the item first to see a preview.'
                    ),
            ])->visibleOn('edit'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Image')
                    ->width(80)
                    ->height(56)
                    ->extraImgAttributes(['class' => 'object-cover rounded-lg']),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'success_story' => 'success',
                        'event'         => 'warning',
                        'campus'        => 'info',
                        'student_life'  => 'primary',
                        'milestone'     => 'danger',
                        default         => 'gray',
                    })
                    ->formatStateUsing(fn (string $state) => ucwords(str_replace('_', ' ', $state))),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->options([
                        'success_story' => 'Success Story',
                        'event'         => 'Event',
                        'campus'        => 'Campus',
                        'student_life'  => 'Student Life',
                        'milestone'     => 'Milestone',
                    ]),
                TernaryFilter::make('is_featured')->label('Featured'),
                TernaryFilter::make('is_active')->label('Active'),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListGalleryItems::route('/'),
            'create' => Pages\CreateGalleryItem::route('/create'),
            'edit'   => Pages\EditGalleryItem::route('/{record}/edit'),
        ];
    }
}
