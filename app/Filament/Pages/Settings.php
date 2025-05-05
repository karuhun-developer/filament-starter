<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class Settings extends Page
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'App';

    protected static string $view = 'filament.pages.settings';

    public ?array $data = [];

    public function mount(): void {
        $data = Setting::first();

        // If no data exists, create a new instance
        if (!$data) {
            $data = Setting::create([
                'title' => 'Example Title',
            ]);
        }
        $this->form->fill($data->toArray());
    }


    public function form(Form $form): Form {
        return $form->schema([
            Section::make()
                ->schema([
                    TextInput::make('title')
                        ->label('Title')
                        ->required(),
                    RichEditor::make('description')
                        ->label('Description')
                        ->required(),
                    RichEditor::make('about_us')
                        ->label('About Us')
                        ->required(),
                    TextInput::make('latitude')
                        ->label('Latitude')
                        ->required(),
                    TextInput::make('longitude')
                        ->label('Longitude')
                        ->required(),
                    TimePicker::make('opening_hours_at')
                        ->label('Opening Hours')
                        ->required(),
                    TimePicker::make('opening_hours_end')
                        ->label('Closing Hours')
                        ->required(),
                ]),
        ])
        ->statePath('data')
        ->model(Setting::class);
    }

    public function save(): void {
        // Update the settings in the database
        Setting::first()->update($this->form->getState());

        Notification::make()
            ->title('Settings updated successfully')
            ->success()
            ->send();
    }
}
